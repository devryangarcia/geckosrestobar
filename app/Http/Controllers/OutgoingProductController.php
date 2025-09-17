<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OutgoingProductExport;
use App\Models\OutgoingProduct;
use App\Models\Product;
use App\Models\Bartender;
use App\Models\Waitress;
use Illuminate\Support\Facades\DB; // Add this line
use Illuminate\Support\Facades\Log;
use PDF;
class OutgoingProductController extends Controller
{
    public function index(){
        $outgoingproducts = OutgoingProduct::paginate(20);
        $bartenders = Bartender::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $waitresses = Waitress::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $products = Product::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        return view('admin.outgoingproducts', compact('outgoingproducts','products','bartenders','waitresses'));
    }

    public function store(Request $request)
    {
        
        // 1. Validate the incoming request data.
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'bartender_id' => 'required|exists:bartenders,id',
            'qty' => 'required|integer|min:1',
            'ld_qty' => 'nullable|integer|min:1',
            'date' => 'required|date',
        ]);

        

        // Fetch the product to check if there is enough stock.
        $product = Product::find($request->product_id);

        // 2. Check for sufficient stock before proceeding.
        if ($request->qty > $product->qty) {
            return back()->with('deleted', 'The quantity requested exceeds the available stock.');
        }

        // 3. Wrap the operations in a database transaction.
        DB::beginTransaction();

        try {
            // Save the outgoing product record.
            $outgoing = new OutgoingProduct;
            $outgoing->product_id = $request->product_id;
            $outgoing->bartender_id = $request->bartender_id;
            $outgoing->qty = $request->qty;
            $outgoing->date = $request->date;
            $outgoing->waitress_id = $request->waitress_id;
            $outgoing->ld_qty = $request->ld_qty;
            $outgoing->save();

            // Update the product's quantity.
            $totalqty = $request->qt + $request->ld_qty;
            $product->qty -= $totalqty;
            $product->save();

            // Commit the transaction.
            DB::commit();

            return redirect()->route('outgoingproducts.index')->with('success', 'Outgoing Product has been added successfully!');

        } catch (\Exception $e) {
            // Rollback the transaction on error.
            DB::rollBack();

            // Log the error and return an error message to the user.
            Log::error('Failed to create outgoing product: ' . $e->getMessage());

            return back()->with('deleted', 'There was an error adding the outgoing product. Please try again.');
        }
    }
    public function update(Request $request, $id)
{
    // 1. Validate the incoming request data.
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'bartender_id' => 'required|exists:bartenders,id',
        'waitress_id' => 'required|exists:waitresses,id',
        'qty' => 'required|integer|min:1',
        'ld_qty' => 'required|integer|min:1',
        'date' => 'required|date',
    ]);

    // Fetch the product
    $product = Product::find($request->product_id);

    // Fetch the outgoing record
    $outgoing = OutgoingProduct::findOrFail($id);

    // Previous total qty (qty + ld_qty)
    $previousTotal = $outgoing->qty + $outgoing->ld_qty;

    // New total qty (qty + ld_qty)
    $newTotal = $request->qty + $request->ld_qty;

    DB::beginTransaction();

    try {
        if ($newTotal < $previousTotal) {
            // If reducing total, add back the difference
            $difference = $previousTotal - $newTotal;
            $product->qty += $difference;
        } elseif ($newTotal > $previousTotal) {
            // If increasing total, deduct the difference
            $difference = $newTotal - $previousTotal;
            if ($difference > $product->qty) {
                return back()->with('deleted', 'The quantity requested exceeds the available stock.');
            }
            $product->qty -= $difference;
        }

        // Update outgoing product record
        $outgoing->product_id = $request->product_id;
        $outgoing->bartender_id = $request->bartender_id;
        $outgoing->waitress_id = $request->waitress_id;
        $outgoing->qty = $request->qty;
        $outgoing->ld_qty = $request->ld_qty;
        $outgoing->date = $request->date;
        $outgoing->save();

        // Save updated product stock
        $product->save();

        DB::commit();

        return redirect()->route('outgoingproducts.index')->with('success', 'Outgoing Product has been updated successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Failed to update outgoing product: ' . $e->getMessage());
        return back()->with('deleted', 'There was an error updating the outgoing product. Please try again.');
    }
}

    public function delete($id){
        $outgoing = OutgoingProduct::find($id);
        if (!empty($id)) {
            $outgoing->delete();
            return redirect()->route('outgoingproducts.index')->with('deleted',"Product has been deleted successfully!");
        } else {
            return redirect()->route('outgoingproducts.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $outgoingproducts = OutgoingProduct::all();
        $pdf = PDF::loadView('exportpdfs/outgoingproductALLPDF',compact('outgoingproducts'));
        return $pdf->download('Outgoing Products.pdf');
    }
    public function exportPDF($id){
        $outgoingproduct = OutgoingProduct::findOrfail($id);
        $pdf = PDF::loadView('exportpdfs/outgoingproductPDF',compact('outgoingproduct'));
        return $pdf->download('Outgoing Product.pdf');
    }
    public function exportExcel()
    {
        return (new OutgoingProductExport)->download('Outgoing Products.xlsx');
    }

}

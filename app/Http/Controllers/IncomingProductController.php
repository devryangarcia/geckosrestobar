<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\IncomingProductExport;
use App\Models\IncomingProduct;
use App\Models\Product;
use App\Models\Supplier;
use PDF;
class IncomingProductController extends Controller
{
    public function index(){
        $incomingproducts = IncomingProduct::paginate(20);
        $suppliers = Supplier::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $products = Product::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        return view('admin.incomingproducts', compact('incomingproducts','products','suppliers'));
    }
    public function store(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $incomingproduct = new IncomingProduct;
        $incomingproduct->product_id = $request->product_id;
        $incomingproduct->supplier_id = $request->supplier_id;
        $incomingproduct->qty = $request->qty;
        $incomingproduct->date = $request->date;

        $product = Product::findOrfail($request->product_id);
        $product->qty += $request->qty;

        $product->update();
        $incomingproduct->save();

        return redirect()->route('incomingproducts.index')->with('success',"Purchase has been added successfully!");
    }

   public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        // Retrieve the existing incoming product record and associated product
        $incomingproduct = IncomingProduct::find($id);
        $product = Product::find($request->product_id);

        // If the incoming product or the product is not found, return an error
        if (!$incomingproduct || !$product) {
            return redirect()->route('incomingproducts.index')->with('deleted', 'Product or incoming product not found!');
        }

        // Check if the product quantity is already 0
        if ($product->qty == 0) {
            return redirect()->route('incomingproducts.index')->with('deleted', 'You cannot edit this product because its quantity is already 0.');
        }

        // Store the previous quantity of the incoming product
        $previousQty = $incomingproduct->qty;

        // Update incoming product's details
        $incomingproduct->product_id = $request->product_id;
        $incomingproduct->supplier_id = $request->supplier_id;
        $incomingproduct->date = $request->date;

        // Check if the incoming product quantity is being increased or decreased
        if ($request->qty > $previousQty) {
            // The quantity is increased, so add the difference to the product's quantity
            $product->qty += ($request->qty - $previousQty);
        } elseif ($request->qty < $previousQty) {
            // The quantity is decreased, so subtract the difference from the product's quantity
            $product->qty -= ($previousQty - $request->qty);
        }

        // Update the incoming product and product records
        $incomingproduct->qty = $request->qty; // Set the new quantity
        $incomingproduct->update();
        $product->update();

        return redirect()->route('incomingproducts.index')->with('success', "Purchase has been updated successfully!");
    }
    public function delete($id){
        $incoming = IncomingProduct::find($id);
        if (!empty($id)) {
            $incoming->delete();
            return redirect()->route('incomingproducts.index')->with('deleted',"Purchase has been deleted successfully!");
        } else {
            return redirect()->route('incomingproducts.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $incomingproducts = IncomingProduct::all();
        $pdf = PDF::loadView('exportpdfs/incomingproductALLPDF',compact('incomingproducts'));
        return $pdf->download('Incoming Products.pdf');
    }
    public function exportPDF($id){
        $incomingproduct = IncomingProduct::findOrfail($id);
        $pdf = PDF::loadView('exportpdfs/incomingproductPDF',compact('incomingproduct'));
        return $pdf->download('Incoming Product.pdf');
    }
    public function exportExcel()
    {
        return (new IncomingProductExport)->download('Incoming Products.xlsx');
    }


}

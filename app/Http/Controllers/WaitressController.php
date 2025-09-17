<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\WaitressExport;
use App\Exports\LadiesDrinkExport;
use App\Models\Waitress;
use App\Models\OutgoingProduct;
use Carbon\Carbon;
use PDF;
class WaitressController extends Controller
{
    public function index()
    {
        $waitresses = Waitress::paginate(20);
        return view('admin.waitress', compact('waitresses'));
    }
     public function store(Request $request){
        $request->validate(
            [
                "name" => "required|min:2",
            ]
        );
        $waitress = new Waitress;
        $waitress->name = $request->name;
        $waitress->save();

        return redirect()->route('waitress.index')->with('success',"Waitress has been added successfully!");
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                "name" => "required|min:2",
            ]
        );
        $waitress = Waitress::find($id);
        if (!empty($id)) {
            $waitress->name = $request->name;
            $waitress->update();
            return redirect()->route('waitress.index')->with('success',"Waitress has been updated successfully!");
        } else {
            return redirect()->route('waitress.index')->with('deleted',"No data found!");
        }
    }
    public function delete($id){
        $waitress = Waitress::find($id);
        if (!empty($id)) {
            $waitress->delete();
            return redirect()->route('waitress.index')->with('deleted',"Waitress has been deleted successfully!");
        } else {
            return redirect()->route('waitress.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $waitresses = Waitress::all();
        $pdf = PDF::loadView('exportpdfs/waitressALLPDF',compact('waitresses'));
        return $pdf->download('Waitresses.pdf');
    }
    public function exportExcel()
    {
        return (new WaitressExport)->download('Waitresses.xlsx');
    }
    public function ladiesdrinks()
    {

        $waitressStats = OutgoingProduct::selectRaw('waitress_id,DATE(date) as record_date, SUM(ld_qty) as total_drinks')
        ->groupBy('waitress_id','record_date')
        ->with('waitress:id,name')
        ->paginate(10);


        return view('admin.ladiesdrinks', compact('waitressStats'));
    }
    
    public function ld_exportPDFAll(){
        $waitressStats = OutgoingProduct::selectRaw('waitress_id,DATE(date) as record_date, SUM(ld_qty) as total_drinks')
        ->groupBy('waitress_id','record_date')
        ->with('waitress:id,name')
        ->paginate(10);
        $pdf = PDF::loadView('exportpdfs/ladiesdrinksALLPDF',compact('waitressStats'));
        return $pdf->download('Ladies Drinks.pdf');
    }
    
    public function ld_exportPDF($id){
         $waitressStats = OutgoingProduct::selectRaw('waitress_id, DATE(date) as record_date, SUM(ld_qty) as total_drinks')
        ->where('waitress_id', $id)
        ->groupBy('waitress_id', 'record_date')
        ->with('waitress:id,name')
        ->orderBy('record_date', 'asc')
        ->get();

        $pdf = PDF::loadView('exportpdfs.ladiesdrinksPDF', compact('waitressStats'));
        return $pdf->download('Waitress_'.$id.'_drinks.pdf');
    }
    public function ld_exportExcel()
    {
        return (new LadiesDrinkExport)->download('Ladies Drinks.xlsx');
    }
}

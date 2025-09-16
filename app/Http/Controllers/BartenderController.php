<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BartenderExport;
use App\Models\Bartender;
use PDF;
class BartenderController extends Controller
{
    public function index()
    {
        $bartenders = Bartender::paginate(20);
        return view('admin.bartender', compact('bartenders'));
    }
    public function store(Request $request){
        $request->validate(
            [
                "name" => "required|min:2",
            ]
        );
        $bartender = new Bartender;
        $bartender->name = $request->name;
        $bartender->save();

        return redirect()->route('bartenders.index')->with('success',"Bartender has been added successfully!");
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                "name" => "required|min:2",
            ]
        );
        $bartender = Bartender::find($id);
        if (!empty($id)) {
            $bartender->name = $request->name;
            $bartender->update();
            return redirect()->route('bartenders.index')->with('success',"Bartender has been updated successfully!");
        } else {
            return redirect()->route('bartenders.index')->with('deleted',"No data found!");
        }
    }
    public function delete($id){
        $bartender = Bartender::find($id);
        if (!empty($id)) {
            $bartender->delete();
            return redirect()->route('bartenders.index')->with('deleted',"Bartender has been deleted successfully!");
        } else {
            return redirect()->route('bartenders.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $suppliers = Bartender::all();
        $pdf = PDF::loadView('exportpdfs/supplierALLPDF',compact('suppliers'));
        return $pdf->download('Bartenders.pdf');
    }
    public function exportPDF($id){
        $supplier = Bartender::findOrfail($id);
        $pdf = PDF::loadView('exportpdfs/supplierPDF',compact('supplier'));
        return $pdf->download('Bartender.pdf');
    }
    public function exportExcel()
    {
        return (new BartenderExport)->download('Bartenders.xlsx');
    }
}

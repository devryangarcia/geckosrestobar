<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SupplierExport;
use App\Models\Supplier;
use PDF;
class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(20);
        return view('admin.suppliers', compact('suppliers'));
    }
    public function store(Request $request){
        $request->validate([
            "name" => "required|min:2",
            "email" => "nullable|email",
            "contact" => "nullable|string|regex:/^\d{10,15}$/" // Allow 10 to 15 digits for the contact number
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact = $request->contact;
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success',"Supplier has been added successfully!");
    }
    public function update(Request $request, $id){
        $supplier = Supplier::find($id);
        $request->validate(
            [
                "name" => "required|min:2",
                "email" => "nullable|email",
                "contact" => "nullable|string|regex:/^\d{10,15}$/" // Allow 10 to 15 digits for the contact number
            ]
        );
        if (!empty($id)) {
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact = $request->contact;
            $supplier->update();
            return redirect()->route('suppliers.index')->with('success',"Supplier has been updated successfully!");
        } else {
            return redirect()->route('suppliers.index')->with('deleted',"No data found!");
        }
    }
    public function delete($id){
        $bartender = Supplier::find($id);
        if (!empty($id)) {
            $bartender->delete();
            return redirect()->route('suppliers.index')->with('deleted',"Supplier has been deleted successfully!");
        } else {
            return redirect()->route('suppliers.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $suppliers = Supplier::all();
        $pdf = PDF::loadView('exportpdfs/supplierALLPDF',compact('suppliers'));
        return $pdf->download('Suppliers.pdf');
    }
    public function exportPDF($id){
        $supplier = Supplier::findOrfail($id);
        $pdf = PDF::loadView('exportpdfs/supplierPDF',compact('supplier'));
        return $pdf->download('Supplier.pdf');
    }
    public function exportExcel()
    {
        return (new SupplierExport)->download('Suppliers.xlsx');
    }
}

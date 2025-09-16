<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Models\Category;
use PDF;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(20);
        return view('admin.category', compact('categories'));
    }
    public function store(Request $request){
        $request->validate(
            [
                "category" => "required|min:2",
            ]
        );
        $category = new Category;
        $category->name = $request->category;
        $category->save();

        return redirect()->route('category.index')->with('success',"Category has been added successfully!");
    }
    public function update(Request $request, $id){
        $category = Category::find($id);
        if (!empty($id)) {
            $category->name = $request->category;
            $category->update();
            return redirect()->route('category.index')->with('success',"Category has been updated successfully!");
        } else {
            return redirect()->route('category.index')->with('deleted',"No data found!");
        }
    }
    public function delete($id){
        $category = Category::find($id);
        if (!empty($id)) {
            $category->delete();
            return redirect()->route('category.index')->with('deleted',"Category has been deleted successfully!");
        } else {
            return redirect()->route('category.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $categories = Category::all();
        $pdf = PDF::loadView('exportpdfs/categoryALLPDF',compact('categories'));
        return $pdf->download('Categories.pdf');
    }
    public function exportPDF($id){
        $categorie = Category::findOrfail($id);
        $pdf = PDF::loadView('exportpdfs/categoryPDF',compact('categorie'));
        return $pdf->download('Category.pdf');
    }
    public function exportExcel()
    {
        return (new CategoryExport)->download('Categories.xlsx');
    }
}

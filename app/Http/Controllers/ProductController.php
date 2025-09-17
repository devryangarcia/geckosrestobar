<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Models\Product;
use App\Models\Category;
use Storage;
use PDF;
class ProductController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');

        $products = Product::query()
            ->when($search, function($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(10) // keep pagination
            ->withQueryString(); // keep search in pagination links

        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name','id');

        return view('admin.products', compact('products','category', 'search'));
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',  // Image validation
            'category_id' => 'required|exists:categories,id',  // Ensure the category exists
        ]);
        if ($request->hasFile('img')) {
            // Get the original filename
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $request->file('img')->getClientOriginalExtension();
    ;
            
            // Store the file with the original filename in the 'products' directory under the 'public' disk
            $imgPath = $request->file('img')->storeAs('products', $filename, 'public');
        } else {
            $imgPath = null; // No image uploaded
        }

        // Create and save the product
        $product = new Product;
        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->image = $imgPath;  // Save the image path, not the file input
        $product->category_id = $request->category_id;
        $product->save();

        // Redirect or return response
        return redirect()->route('products.index')->with('success', 'Product has been added successfully');
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',  // Image validation
            'category_id' => 'required|exists:categories,id',  // Ensure the category exists
        ]);

        // Find the existing product
        $product = Product::findOrFail($id);

        // Store the current image path
        $imgPath = $product->image;  // Default to the current image if no new one is uploaded

        // Check if a new image is uploaded
        if ($request->hasFile('img')) {
            // If a new image is uploaded, delete the old one (if it exists)
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);  // Delete the old image
            }

            // Generate a unique filename for the new image
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $request->file('img')->getClientOriginalExtension();
            
            // Store the new image with the unique filename
            $imgPath = $request->file('img')->storeAs('products', $filename, 'public');  // Save new image

            // Optionally, update the product model to store the new image path
            $product->image = $imgPath;
        }


        // Update the product
        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->image = $imgPath;  // Save the updated image path (or old one if no new image uploaded)
        $product->category_id = $request->category_id;
        $product->save();

        // Redirect or return response
        return redirect()->route('products.index')->with('success', 'Product has been updated successfully');
    }
    public function delete($id){
        $product = Product::find($id);
        if (!empty($id)) {
            $product->delete();
            return redirect()->route('products.index')->with('deleted',"Product has been deleted successfully!");
        } else {
            return redirect()->route('products.index')->with('deleted',"No data found!");
        }
    }
    public function exportPDFAll(){
        $products = Product::all();
        $pdf = PDF::loadView('exportpdfs/productALLPDF',compact('products'));
        return $pdf->download('Products.pdf');
    }
    public function exportExcel()
    {
        return (new ProductExport)->download('Products.xlsx');
    }


}

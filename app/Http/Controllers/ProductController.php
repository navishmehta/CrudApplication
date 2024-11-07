<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //This function will show products page
    public function index()
    {
        $products = Product::query()->latest()->get();
        return view("products.list", ["products" => $products]);
    }

    //This function will show create products page
    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required | min:5",
            "sku" => "required | min:3",
            "price" => "required | numeric",
            'description' => ['nullable', 'string'],
            'image' => ['sometimes', 'nullable', 'image']
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;

            $image->move(public_path('uploads/products'), $imageName);

            $data['image'] = $imageName;
        }

        Product::query()->create($data);

        return redirect()->route('products.list')->with('success', 'Product added successfully.');
    }

    //This function will show edit products page
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    //This function will update a product
    public function update(Product $product, Request $request)
    {
        $request->validate([
            "name" => "required | min:5",
            "sku" => "required | min:3",
            "price" => "required | numeric",
            'description' => ['nullable', 'string'],
            'image' => ['sometimes', 'nullable', 'image']
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {

            //delete old image
            File::delete(public_path("uploads/products" . $product->image));

            //here we will store image
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;   //unique image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.list')->with('success', 'Product updated successfully.');
    }

    //This function will delete a product
    public function destroy(Product $product)
    {               
        // dd($filePath);
        // Storage::delete($filePath);
        
        
        // $imagePath = Product::select('image')->where('id', $product->id)->get();
        $filePath = public_path() . '/uploads/products/' . $product->image;
        unlink($filePath);

        //delete product from db
        $product->delete();
        return redirect()->route('products.list')->with('success', 'Product deleted successfully.');
    }
}

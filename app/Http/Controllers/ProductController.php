<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;


class ProductController extends Controller
{
    //This function will show products page
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view("products.list", ["products" => $products]);
    }

    //This function will show create products page
    public function create()
    {
        return view("products.create");
    }

    //This function will store a product in db
    public function store(Request $request)
    {
        $rules = [
            "name" => "required | min:5",
            "sku" => "required | min:3",
            "price" => "required | numeric",
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }

        //here we will insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;   //unique image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //Save image in db
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.list')->with('success', 'Product added successfully.');
    }

    //This function will show edit products page
    public function edit($id)
    {
        $product = Product::findOrFail($id);        
        return view('products.edit', ['product' => $product]);
    }

    //This function will update a product
    public function update($id, Request $request)
    {

        $product = Product::findOrFail($id);

        $rules = [
            "name" => "required | min:5",
            "sku" => "required | min:3",
            "price" => "required | numeric",
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withErrors($validator)->withInput();
        }

        //here we will update product in db        
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {

            //delete old image
            File::delete(public_path("uploads/products" . $product->image));

            //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;   //unique image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //Save image in db
            $product->image = $imageName;
        }

        return redirect()->route('products.list')->with('success', 'Product updated successfully.');
    }

    //This function will delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //delete image
        File::delete(public_path("uploads/products" . $product->image));

        //delete product from db
        $product->delete();
        return redirect()->route('products.list')->with('success', 'Product deleted successfully.');
    }
}

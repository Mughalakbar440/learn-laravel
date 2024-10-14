<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Support\Facades\Validator; // Correct import for Validator
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products  = product::orderBy('created_at', 'DESC')->get();
        return view("products.list", ["productsData" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if ($request->image != '') {
            $rules['image'] = 'image';
        }

        // Create a validator instance with the correct rules
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withInput()
                ->withErrors($validator);
        }
        //here we insert the product in database

        $product = new product();
        $product->name = $request->name;
        $product->price  = $request->price;
        $product->sku  = $request->sku;
        $product->description  = $request->description;
        $product->save();
        if ($request->image != '') {
            //here we store an image 
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            // save image in product directry
            $image->move(public_path('uploads/products'), $imageName);

            //save image in database
            $product->image  = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product added success');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
       
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if ($request->image != '') {
            $rules['image'] = 'image';
        }

        // Create a validator instance with the correct rules
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withInput()
                ->withErrors($validator);
        }
        //here we insert the product in database

        $product->name = $request->name;
        $product->price  = $request->price;
        $product->sku  = $request->sku;
        $product->description  = $request->description;
        $product->save();
        if ($request->image != '') {
            //here we store an image 
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name
            \File::delete(public_path('uploads/products'. $imageName));
            // save image in product directry
            $image->move(public_path('uploads/products'), $imageName);

            //save image in database
            $product->image  = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        //remove file from the directory so the size is not got bigger
        $imageName = $product->image;
        
        \File::delete(public_path('uploads/products'. $imageName));
        //product delete methos
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product successfully deleted ');

    }
}

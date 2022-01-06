<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
USE Picqer;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate(10);
        return view('products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //  Product::create($request->all());// this is code when you want to add all input to database
        $product_code = $request->product_code;

        $products = new Product;

        // image section
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $file->move(public_path() . '/products/images', $file->getClientOriginalName());
            $product_image = $file->getClientOriginalName();
            $products->product_image = $product_image;
        }
        // Barcode image section
        $redColor = '255,0,0';
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);
        // file_put_contents('products/barcodes/' . $product_code . '.jpg',

        $products->product_name = $request->product_name;
        $products->product_code = $product_code;
        $products->barcode = $barcodes;
        $products->brand = $request->brand;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->alert_stock = $request->alert_stock;
        $products->description = $request->description;
        $products->save();

        return redirect()->back()->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $product->update($request->all());
        return redirect()->back()->with('Success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $products = Product::find($id);
        $products->delete();
        return redirect()->back()->with('Success', 'Product Deleted Successfully');
    }
    public function GetProductBarCodes()
    {
        $getbarcode = Product::select('barcode', 'product_code')->get();
        return view('barcodes', compact('getbarcode'));

    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.index', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'descreption' => $request->descreption,
        ]);

        return redirect()->back()->with(['Add' => 'تم اضافة منتج بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request)
    {
        Product::where('id', $request->id)->update([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'descreption' => $request->description,
        ]);
        return redirect()->back()->with(['Edit' => 'تم تعديل المنتج بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Product::destroy($request->id);
        return redirect()->back()->with(['Delete' => 'تم حذف القسم بنجاح']);
    }
}

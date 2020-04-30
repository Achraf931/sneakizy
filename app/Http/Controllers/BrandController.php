<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::all());
    }

    public function show($id)
    {
        return response()->json(Brand::findOrFail($id));
    }

    public function products($id)
    {
        return response()->json(Product::where('brand_id', $id)->paginate(2));
    }
}

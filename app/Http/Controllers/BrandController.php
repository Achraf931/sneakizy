<?php

namespace App\Http\Controllers;

use App\Brand;

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
        return response()->json(Brand::where('id', $id)->with('products')->get()->first());
    }
}

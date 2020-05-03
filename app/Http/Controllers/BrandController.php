<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $pageQuery = $request->query('page');

        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            return response()->json(Brand::paginate((int)$request->query('max')), 200);
        }

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

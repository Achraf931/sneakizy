<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->query('orderBy');

        $pageQuery = $request->query('page');

        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            if (isset($orderBy) && !empty($orderBy))
            {
                return response()->json(Brand::orderBy('created_at', $orderBy)->paginate((int)$request->query('max')), 200);
            }
                return response()->json(Brand::paginate((int)$request->query('max')), 200);
        }

        return response()->json(Brand::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Brand::findOrFail($id));
    }

    public function products($id)
    {
        return response()->json(Product::where('brand_id', $id)->paginate(2));
    }

    public function destroy($id)
    {
        $status = Brand::findOrFail($id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Brand Deleted!' : 'Error Deleting Brand'
        ]);
    }
}

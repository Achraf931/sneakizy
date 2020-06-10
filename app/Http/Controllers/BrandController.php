<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\BrandRequest;
use App\Product;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

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

    public function store(BrandRequest $request)
    {
        Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/Brands']);
        $cloundary_upload = Cloudder::getResult();
        Cloudder::upload($request->file('banner'), null, ['folder' => 'Sneakizy/Brands']);
        $cloundary_upload_banner = Cloudder::getResult();
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $cloundary_upload['url'];
        $brand->banner = $cloundary_upload_banner['url'];
        $brand->save();
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
        $brand = Brand::where('id', $id)->first();
        $status = Brand::findOrFail($id)->delete();
        Cloudder::destroyImage('Sneakizy/Brands/' . pathinfo($brand->image)['filename']);
        Cloudder::delete('Sneakizy/Brands/' . pathinfo($brand->image)['filename']);
        Cloudder::destroyImage('Sneakizy/Brands/' . pathinfo($brand->banner)['filename']);
        Cloudder::delete('Sneakizy/Brands/' . pathinfo($brand->banner)['filename']);

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Brand Deleted!' : 'Error Deleting Brand'
        ]);
    }
}

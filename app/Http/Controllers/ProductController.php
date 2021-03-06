<?php

namespace App\Http\Controllers;

use App\Events\ProductAdded;
use App\Http\Requests\ProductRequest;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->query('orderBy');

        $pageQuery = $request->query('page');

        $maxQuery = $request->query('max');

        $max = isset($maxQuery) && !empty($maxQuery) ? $maxQuery : 10;

        $search = $request->query('search');

        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            if (isset($search) && !empty($search))
            {
                return response()->json(Product::where('name', 'LIKE', '%'. $search .'%')->paginate((int)$max), 200);
            }
            if (isset($orderBy) && !empty($orderBy))
            {
                return response()->json(Product::orderBy('created_at', $orderBy)->paginate((int)$max), 200);
            }
            return response()->json(Product::paginate((int)$max), 200);
        }
        else
        {
            if (isset($search) && !empty($search))
            {
                return response()->json(Product::where('name', 'LIKE', '%'. $search .'%')->isPublished()->get(), 200);
            }
            return response()->json(Product::isPublished()->get(), 200);
        }
    }

    public function store(ProductRequest $request)
    {
        Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/Products']);
        $cloundary_upload = Cloudder::getResult();
        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->color = $request->color;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->release_date = $request->release_date;
        $product->image = $cloundary_upload['url'];
        $product->brand_id = $request->brand_id;
        $product->save();
        event(new ProductAdded($product));
        return response()->json($product);
    }

    public function show($id)
    {
        return response()->json(Product::where('id', $id)->with('images')->get()->first(), 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::where('id', $id)->first();

        if (isset($request->is_published) && $request->is_published !== 'undefined')
        {
            $product->is_published = $request->is_published;
        }
        else
        {
            if (isset($request->image) && $request->image !== 'undefined')
            {
                Cloudder::destroyImage('Sneakizy/Products/' . pathinfo($product->image)['filename']);
                Cloudder::delete('Sneakizy/Products/' . pathinfo($product->image)['filename']);

                Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/Products']);
                $cloundary_upload = Cloudder::getResult();
                $product->image = $cloundary_upload['url'];
            }

            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->color = $request->color;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->release_date = $request->release_date;
            $product->brand_id = $request->brand_id;
        }

        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        $images = Image::where('product_id', $id)->get();
        foreach ($images as $image)
        {
            Image::findOrFail($image->id)->delete();
            Cloudder::destroyImage('Sneakizy/Images/' . pathinfo($image->image)['filename']);
            Cloudder::delete('Sneakizy/Images/' . pathinfo($image->image)['filename']);
        }

        $pro = Product::where('id', $id)->first();
        $status = Product::findOrFail($id)->delete();
        Cloudder::destroyImage('Sneakizy/Products/' . pathinfo($pro->image)['filename']);
        Cloudder::delete('Sneakizy/Products/' . pathinfo($pro->image)['filename']);

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }

    public function length()
    {
        return response()->json('test');
    }
}

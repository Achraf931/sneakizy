<?php

namespace App\Http\Controllers;

use App\Events\ProductAdded;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $pageQuery = $request->query('page');

        $maxQuery = $request->query('max');

        $max = isset($maxQuery) && !empty($maxQuery) ? $maxQuery : 10;

        $search = $request->query('search');

        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            if (isset($search) && !empty($search))
            {
                return response()->json(Product::where('name', 'LIKE', '%'. $search .'%')->isPublished()->paginate((int)$max), 200);
            }
            return response()->json(Product::isPublished()->paginate((int)$max), 200);
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

        Cloudder::upload($request->file('image'));
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
    }

    public function show($id)
    {
        return response()->json(Product::isPublished()->where('id', $id)->with('images')->get()->first(), 200);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name', 'description', 'release_date', 'price', 'image', 'brand', 'is_published'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Sneaker Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Product $product)
    {
        $status = $product->delete();

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

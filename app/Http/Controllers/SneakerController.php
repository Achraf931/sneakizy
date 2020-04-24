<?php

namespace App\Http\Controllers;

use App\Events\SneakerAdded;
use App\Http\Requests\SneakerRequest;
use App\Sneaker;
use JD\Cloudder\Facades\Cloudder;

class SneakerController extends Controller
{
    public function index()
    {
        return response()->json(Sneaker::isPublished()->paginate(6), 200);
    }

    public function store(SneakerRequest $request)
    {

        Cloudder::upload($request->file('image'));
        $cloundary_upload = Cloudder::getResult();
        $sneaker = new Sneaker();
        $sneaker->name = $request->name;
        $sneaker->brand = $request->brand;
        $sneaker->color = $request->color;
        $sneaker->description = $request->description;
        $sneaker->price = $request->price;
        $sneaker->release_date = $request->release_date;
        $sneaker->image = $cloundary_upload['url'];
        $sneaker->brand_id = $request->brand_id;
        $sneaker->save();
        event(new SneakerAdded($sneaker));
    }

    public function show($id)
    {
        return response()->json(Sneaker::isPublished()->where('id', $id)->with('images')->get()->first(), 200);
    }

    public function update(SneakerRequest $request, Sneaker $sneaker)
    {
        $status = $sneaker->update(
            $request->only(['name', 'description', 'release_date', 'price', 'image', 'brand', 'is_published'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Sneaker Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Sneaker $sneaker)
    {
        $status = $sneaker->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}

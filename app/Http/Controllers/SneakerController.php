<?php

namespace App\Http\Controllers;

use App\Events\SneakerAdded;
use App\Http\Requests\SneakerRequest;
use App\Sneaker;

class SneakerController extends Controller
{
    public function index()
    {
        return response()->json(Sneaker::all(), 200);
    }

    public function store(SneakerRequest $request)
    {
        event(new SneakerAdded(Sneaker::create($request->all())));
    }

    public function show($id)
    {
        return response()->json(Sneaker::where('id', $id)->with('images')->get()->first(), 200);
    }

    public function update(SneakerRequest $request, Sneaker $sneaker)
    {
        $status = $sneaker->update(
            $request->only(['name', 'description', 'release_date', 'price', 'image', 'stock', 'is_published', 'brand_id'])
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

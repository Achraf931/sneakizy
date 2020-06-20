<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class ImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/Images']);
        $cloundary_upload = Cloudder::getResult();
        $image = new Image();
        $image->image = $cloundary_upload['url'];
        $image->product_id = (int)$request->product_id;
        $image->save();

        return response()->json(['image' => $image, 'status' => true], 200);
    }

    public function show(Image $image)
    {
        //
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $image = Image::where('id', $id)->first();
        $image->product_id = $request->product_id;
        $image->save();
    }

    public function destroy($id)
    {
        $image = Image::where('id', $id)->first();
        Cloudder::destroyImage('Sneakizy/Images/' . pathinfo($image->image)['filename']);
        Cloudder::delete('Sneakizy/Images/' . pathinfo($image->image)['filename']);
        $status = Image::findOrFail($id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Image Deleted!' : 'Error Deleting Image'
        ]);
    }
}

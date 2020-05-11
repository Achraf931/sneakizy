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
        Cloudder::upload($request->file('image'));
        $cloundary_upload = Cloudder::getResult();
        $image = new Image();
        $image->image = $cloundary_upload['url'];
        $image->product_id = $request->product_id;
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

    public function update(Request $request, Image $image)
    {
        //
    }

    public function destroy($id)
    {
        $image = Image::where('id', $id)->first();
        $test = explode('/', $image->image);
        $publicId = strtok($test[9], '.');
        Cloudder::destroyImage('Sneakizy/Images/' . $publicId);
        Cloudder::delete('Sneakizy/Images/' . $publicId);
        $status = Image::findOrFail($id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Image Deleted!' : 'Error Deleting Image'
        ]);
    }
}

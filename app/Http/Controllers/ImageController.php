<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

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
        //
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

    public function destroy(Image $image)
    {
        $status = $image->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Image Deleted!' : 'Error Deleting Image'
        ]);
    }
}

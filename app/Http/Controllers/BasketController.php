<?php

namespace App\Http\Controllers;

use App\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        return Basket::with('sneakers')->orderBy('created_at', 'desc')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $item = Basket::where('sneaker_id', $request->sneaker_id);

        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        } else {
            $item = Basket::forceCreate([
                'sneaker_id' => $request->product_id,
                'quantity' => 1,
                'size' => $request->size
            ]);
        }

        return response()->json([
            'quantity' => $item->quantity,
            'sneaker' => $item->sneaker,
            'size' => $item->size
        ]);
    }

    public function show(Basket $basket)
    {
        //
    }

    public function edit(Basket $basket)
    {
        //
    }

    public function update(Request $request, Basket $basket)
    {
        //
    }

    public function destroy($sneakerId)
    {
        $item = Basket::where('sneaker_id', $sneakerId)->delete();

        return response(null, 200);
    }

    public function destroyAll()
    {
        Basket::truncate();
    }
}

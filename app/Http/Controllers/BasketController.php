<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Mail\Mailorder;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        //
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

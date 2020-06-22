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











        $order = new Order();
        $bsk = $request->cart;
        $order->userInfo = $request->user['name'] .' '. $request->user['firstname'];
        $order->userEmail = $request->user['email'];
        $order->userAddress = $request->user['adress'] . ' ' . $request->user['city'] . ' ' . $request->user['postalCode'];
        $order->total = $bsk['total'];

        $order->save();

        $lastId = $order->id;

        foreach ($bsk['products'] as $bs){
            $orderProducts = new OrderProduct();

            $orderProducts->order_id = $lastId;
            $orderProducts->product_id = $bs['id'];
            $orderProducts->quantity = $bs['quantity'];
            // $orderProducts->color = $bs->color;
            $orderProducts->size = $bs['size'];

            $orderProducts->save();
        }

        $displayOrder = Order::find($lastId);
        $displayPrd = OrderProduct::where('order_id', $lastId)
            ->with('productsInOrder')
            ->get();

        Mail::to($request->email)->send(new Mailorder($request->email, $request->lastname . ' ' . $request->firstname, $request->object, $request->message));
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

<?php

namespace App\Http\Controllers;

use App\Mail\Mailorder;
use App\Order;
use App\OrderProduct;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with(['sneaker'])->get(),200);
    }

    public function deliverOrder(Order $order)
    {
        $order->is_delivered = true;
        $status = $order->save();

        return response()->json([
            'status'    => $status,
            'data'      => $order,
            'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
    }

    public function store(Request $request)
    {;
        $data = $request->all();
        $token = bin2hex(openssl_random_pseudo_bytes(4));

        $user = $request->id ? User::where('id', $request->id)->first() : new User();

        $user->lastname = $data['lastname'];
        $user->firstname = $data['firstname'];
        $user->email = $data['email'];
        !$request->id ? $user->password = Hash::make('passwordtest') : '';
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->zipcode = (int)$data['zipcode'];
        isset($data['additional_info']) && $data['additional_info'] != 'undefined' ? $user->additional_info = $data['additional_info'] : '';
        $user->save();

        $order = new Order();
        $order->token = $token;
        $order->user_id = $user->id;
        $order->save();

        foreach ($data['products'] as $product) {
            $order_product = new OrderProduct();
            $order_product->order_id = (int)$order->id;
            $order_product->product_id = (int)$product['product']['id'];
            $order_product->quantity = (int)$product['quantity'];
            $order_product->size = (int)$product['size'];
            $order_product->save();
        }

        Mail::to($user->email)->send(new Mailorder($user->email, $user->lastname . ' ' . $user->firstname, $data['products']));

        return true;
    }

    public function show(Order $order)
    {
        return response()->json($order,200);
    }

    public function update(Request $request, Order $order)
    {
        $status = $order->update(
            $request->only(['quantity'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Updated!' : 'Error Updating Order'
        ]);
    }

    public function destroy(Order $order)
    {
        $status = $order->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
        ]);
    }
}

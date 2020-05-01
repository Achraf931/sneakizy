<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class UserController extends Controller
{
    public function index(){
        return response()->json(User::all(), 200);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($credentials)) {
            $status = 200;
            $response = [
                'token' => Auth::user()->createToken('sneakizy')->accessToken,
                'user' => Auth::user()
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required|max:50',
            'firstname' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only(['lastname', 'firstname', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('sneakizy')->accessToken,
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user,200);
    }

    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['sneaker'])->get(),200);
    }
}

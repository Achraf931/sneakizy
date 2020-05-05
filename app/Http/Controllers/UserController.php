<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index(Request $request)
    {
        $orderBy = $request->query('orderBy');

        $pageQuery = $request->query('page');

        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            if (isset($orderBy) && !empty($orderBy))
            {
                return response()->json(User::orderBy('created_at', $orderBy)->paginate((int)$request->query('max')), 200);
            }
            return response()->json(User::paginate((int)$request->query('max')), 200);
        }

        return response()->json(User::all(), 200);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $user = User::where('email', $request->get('email'))->first();
        if ($user)
        {
            if (Hash::check($request->get('password'), $user->password))
            {
                $status = 200;
                $response = [
                    'token' => $user->createToken('sneakizy')->accessToken,
                    'user' => $user
                ];
            }
            else
            {
                $status = 401;
                $response = ['error' => 'Unauthorised'];
            }
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

    public function destroy(User $user)
    {
        $status = $user->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'User Deleted!' : 'Error Deleting User'
        ]);
    }

    public function currentUser()
    {
        return response()->json(auth()->user());
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

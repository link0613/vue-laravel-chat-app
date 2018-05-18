<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if (!$user) {
            die();
        }

        return response()->json([
            'created' => true,
        ]);
    }

    public function postLogin(LoginRequest $request)
    {
        $user = Auth::attempt($request->all());

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials',
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}

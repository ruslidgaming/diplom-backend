<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller

{
<<<<<<< HEAD
    
=======
    public function register(Request $request)
    {

        $data = $request->all();

        return response()->json(['user' => $data], 201);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Неверный email или пароль'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Успешный выход']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
>>>>>>> 727852bae08aeef1a5bdc6bc7e1aafa924198d44
}

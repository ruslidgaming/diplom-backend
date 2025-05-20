<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'number' => $request->number,
            'oldname' => $request->oldname,
            'telephon' => $request->telephon,
            'companyName' => $request->companyName,
            'companyDescription' => $request->companyDescription,
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
            'expires_in' => config('jwt.ttl') * 60 // время жизни в секундах
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required'
    ]);

    $user = User::where('email',$request->email)->first();
    if(! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'success'=> false,
            'message' => 'Unauthorized'
        ],401);
    }
    
    $user->token()->delete();
    $token=$user->createToken($request->email)->plainTextToken;
    return response()->json([
        'success'=> true,
        'message' => 'success',
        'data'=>[
            'user' => $user,
            'token' => $token
        ]
        ],200);
    }
}

<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function login(Request $request){
        $credentials = $request->only('email','password'); 
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $user = auth()->user();

            return response()->json(compact('token'));
        } catch(JWTException $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        }
    }

    public function getUser(){
        try{
            if(! $user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['error' => 'User not found!'], 404);
            } 
        } catch(JWTException $e) {
            return response()->json(['error'=> $e->getMessage()], 400);
        }

        return response()->json(compact('user'));
    }
}

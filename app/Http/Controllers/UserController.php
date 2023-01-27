<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $request){

        $validatedData = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    'data'  => $user,
                    'message' => 'succes get data',
                    'token' => $user->createToken('apitoken')->plainTextToken,
                ],200);
                
            }else{
                return response()->json([
                    'message' => 'wrong password'
                ],401);
            }

        }else{
            return response()->json([
                'message' => 'email not found'
            ],404);
        }
    }
}

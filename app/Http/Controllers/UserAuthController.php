<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserAuthController extends Controller
{
    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['result'=>"Username or Password is Incorrect","Success"=>false];
        }
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        // Return success response
        return response()->json([
            'status' => true,
            'data' => $success,
            'message' => 'User login Successfully'
        ], 201);    }


    function signup(Request $request)
    {
        // Validate input using Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create user directly (auto password hashing via 'password' => 'hashed' in model)
        $user = User::create($request->all());

        // Generate token
       $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        // Return success response
        return response()->json([
            'status' => true,
            'data' => $success,
            'message' => 'User Created Successfully'
        ], 201);
    }


}

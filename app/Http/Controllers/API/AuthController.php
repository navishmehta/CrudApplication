<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users,email',
            'password' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Check if user already exists
        // $existingUser = User::where('email', $request->email)->first();
        // if ($existingUser) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'User already exists',
        //         'user' => $existingUser,
        //     ]);
        // }


        $user = User::query()->create($data);

        return response()->json([
            'status' => true,
            'message' => 'User created Successfully',
            'user' => $user,
        ], 200);
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);

        $existingUser = User::query()->where('email', $request->email)->first();
        if (!$existingUser) {
            return response()->json([
                'status' => false,
                'message' => $request->email . " is not registered, please signup first",
            ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /**
             * @var  \App\Models\User
             */
            $authUser = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'User Logged in Successfully',
                'token' => $authUser->createToken("API Token")->plainTextToken,
                'token_type' => 'bearer',
            ], 200);

            // return view('product.list');
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email and Password does not matched',
            ], 401);

            // return view('/');
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'You have logged out Successfully',
        ], 200);

        return view('/');
    }
}

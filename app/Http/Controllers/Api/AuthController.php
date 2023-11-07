<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if ($user->role != 'admin') {
            return response([
                'message' => "You Don't have permission (not an admin)",
            ], 403);
        }
        
        if(!$user) {
            return response([
                'message' => 'There is no account with this email'
            ], 404);
        }

        if(!Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Incorrect Password'
            ], 401);
        }

        return response([
            'user' => $user,
            'token' => $user->createToken('blog')->plainTextToken
        ], 200);
    }

    public function logout() {
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'Logout'
        ]);
    }

    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        
        $token = $user->createToken('blog')->plainTextToken;
        
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}

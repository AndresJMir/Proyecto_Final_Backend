<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;

class TokenController extends Controller
{
    public function user(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 401);
        }

        return response()->json([
            "success" => true,
            "user"    => new UserResource($user),
            "roles"   => [$user->role->name],
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            "name"      => "required|string|max:255",
            "email"     => "required|string|email|max:255|unique:users",
            "password"  => "required|string|min:8"
        ]);

        $user = User::create([
            "name"      => $validatedData["name"],
            "email"     => $validatedData["email"],
            "password"  => Hash::make($validatedData["password"]),
            "role_id"   => Role::where('name', 'USUARIO')->first()->id,
        ]);

        return $this->_generateTokenResponse($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Get user
            $user = Auth::user();
            // Revoke all old tokens
            $user->tokens()->delete();
            // Generate new token
            return $this->_generateTokenResponse($user);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Revoke token used to authenticate current request...
        $request->user()->tokens()->delete();

        return response()->json([
            "success" => true,
            "message" => "Tokens revoked",
        ]);
    }

    protected function _generateTokenResponse(User $user)
    {
        $token = $user->createToken("authToken")->plainTextToken;

        return response()->json([
            "success"   => true,
            "authToken" => $token,
            "tokenType" => "Bearer"
        ], 200);
    }
}
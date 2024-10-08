<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
       
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) 
        {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']); 
    }

    /**
     * Destroy an authenticated session.
     */
    public function profile()
    {
        return response()->json(Auth::user());
    }
    public function destroy()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}

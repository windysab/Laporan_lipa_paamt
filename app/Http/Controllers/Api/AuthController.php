<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where(['email' => $request->email])->first();

        // if (!$user) {
        //     return response()->json([
        //         'message' => 'Email not found'
        //     ], 401);
        // }

        // if (!Hash::check($request->password, $user->password)) {
        //     return response()->json([
        //         'message' => 'Password not match'
        //     ], 401);
        // }

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['email incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            // 'message' => 'Login success',
            'jwt-token' => $token,
            'user' => new UserResource($user),

        ]);
    }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         throw ValidationException::withMessages([
    //             'email' => ['email incorrect']
    //         ]);
    //     }

    //     if (!Hash::check($request->password, $user->password)) {
    //         throw ValidationException::withMessages([
    //             'password' => ['password incorrect']
    //         ]);
    //     }

    //     $token = $user->createToken('api-token')->plainTextToken;

    //     return response()->json(
    //         [
    //             'jwt-token' => $token,
    //             // 'user' => new UserResource($user),

    //             'user' => $user,
    //         ]
    //     );
    // }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();

        // return response()->json([
        //     'message' => 'Logout success'
        // ]);

        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfully',
        ]);
    }
}

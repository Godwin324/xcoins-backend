<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => ['login' => ['Login credentials are invalid.']],
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => ['login' => [$e->getMessage()]],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'token' => $token,
            'user' => auth()->user(),
        ], Response::HTTP_OK);
    }

   
    public function profile()
    {
        return response()->json(Auth::guard()->user(), Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Logged out successfully'], Response::HTTP_NO_CONTENT);
    }

}

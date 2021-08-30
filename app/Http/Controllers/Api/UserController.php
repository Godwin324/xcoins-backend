<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $input = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'message' => 'User Registration successful',
                'user' => $user
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'message' => ['register' => [$e->getMessage()]],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function profile()
    {
        return response()->json(Auth::guard('api')->user(), Response::HTTP_OK);
    }


}

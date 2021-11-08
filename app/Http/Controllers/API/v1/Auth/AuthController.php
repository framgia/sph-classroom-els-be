<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse(['message' => 'Incorrect credentials'], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->authResponse($response);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'user_type_id' => $request->user_type_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $request->avatar
        ]);

        $token = $user->createToken('access_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $this->authResponse($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse(['message' => 'Logout successfully.'], 200);
    }

    public function user(Request $request)
    {
        return $this->showOne($request->user(), 200);
    }
}

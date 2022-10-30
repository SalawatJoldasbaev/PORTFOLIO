<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use App\Src\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (!$user or !Hash::check($request->password, $user->password)) {
            return Response::error('phone or password is incorrect', 401);
        }

        $token = $user->createToken($request->header('User-Agent'))->plainTextToken;

        return Response::success(payload: [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'token' => $token,
        ]);
    }
}

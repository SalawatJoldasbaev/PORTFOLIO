<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UpdateRequest;
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

    public function update(UpdateRequest $request)
    {
        $user = User::find(1);
        $data = [
            'image' => $request->image,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'about' => $request->about,
            'job' => $request->job,
            'email' => $request->email,
            'citizenship' => $request->citizenship,
            'residence' => $request->residence,
            'cv_url' => $request->cv_url,
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return Response::success();
    }

    public function show(Request $request)
    {
        $user = User::find(1);
        $data = [
            'image' => $user->image,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'address' => $user->address,
            'birth_date' => $user->birth_date,
            'about' => $user->about,
            'job' => $user->job,
            'email' => $user->email,
            'citizenship' => $user->citizenship,
            'residence' => $user->residence,
            'cv_url' => $user->cv_url,
        ];
        return Response::success(payload: $data);
    }
}

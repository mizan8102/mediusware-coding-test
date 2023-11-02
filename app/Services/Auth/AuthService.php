<?php

namespace App\Services\Auth;
use App\Http\Resources\User\UserResource;
use App\Interfaces\Auth\AuthInterface;
use Auth;

class AuthService implements AuthInterface {
  public function login($authRequest){

    if (!Auth::attempt($authRequest)) {
        return response([
            'message' => 'Email or password is incorrect'
        ], 422);
    }
    $user = Auth::user();
    $token = $user->createToken('main')->plainTextToken;
    return response([
        'user' => new UserResource($user),
        'token' => $token
    ]);
  }

}
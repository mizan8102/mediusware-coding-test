<?php

namespace App\Http\Controllers\Auth;

use App\Enums\HttpStatusCodeEnum;
use App\Http\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Interfaces\Auth\AuthInterface;
class AuthController extends Controller
{
    private $authInterface;

    use ApiResponseTrait;

    public function __construct(AuthInterface $authInerface)
    {
        $this->authInterface = $authInerface;
    }

    public function login(AuthRequest $authRequest){
        $data   = $authRequest->validated();
        $res    = $this->authInterface->login($data);
        if ($res) {
            return $this->successResponse($res, "login successfull");
        } else {
            return $this->errorResponse("login failed", HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
}

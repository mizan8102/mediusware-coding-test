<?php

namespace App\Http\Controllers\User;

use App\Enums\HttpStatusCodeEnum;
use App\Http\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserReqeust;
use App\Interfaces\User\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userInterface;

    use ApiResponseTrait;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserReqeust $userReqeust)
    {
        $data   = $userReqeust->validated();
        $res    = $this->userInterface->store($data);
        if ($res) {
            return $this->successResponse($res, "Data saved successfull");
        } else {
            return $this->errorResponse('Failed to save', HttpStatusCodeEnum::BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

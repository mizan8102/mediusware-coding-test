<?php

namespace App\Http\Controllers\Transaction;

use App\Enums\HttpStatusCodeEnum;
use App\Http\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Interfaces\Transaction\TransactionInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $transactionInterface;

    use ApiResponseTrait;

    public function __construct(TransactionInterface $transactionInterface)
    {
        $this->transactionInterface = $transactionInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res= $this->transactionInterface->index();
        if ($res) {
            return $this->successResponse($res, "Data retrive successfull", HttpStatusCodeEnum::OK);
        } else {
            return $this->errorResponse('Failed to retrive', HttpStatusCodeEnum::BAD_REQUEST);
        }
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
    public function store(Request $request)
    {
        //
    }
    public function deposit(TransactionRequest $request)
    {
        $data   = $request->validated();
        $res    = $this->transactionInterface->deposit($data);
        if ($res) {
            return $this->successResponse($res, "Deposit successfull");
        } else {
            return $this->errorResponse('Failed to Deposit', HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
    public function withdrawAmount(TransactionRequest $request)
    {
        $data   = $request->validated();
        $res    = $this->transactionInterface->withdrawAmount($data);
        if ($res) {
            return $this->successResponse($res, "withdraw successfull");
        } else {
            return $this->errorResponse('Failed to withdraw', HttpStatusCodeEnum::BAD_REQUEST);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
        $res= $this->transactionInterface->show();
        if ($res) {
            return $this->successResponse($res, "Data retrive successfull", HttpStatusCodeEnum::OK);
        } else {
            return $this->errorResponse('Failed to retrive', HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
    public function withdrawAll()
    {
        $res= $this->transactionInterface->withdrawAll();
        if ($res) {
            return $this->successResponse($res, "Data retrive successfull", HttpStatusCodeEnum::OK);
        } else {
            return $this->errorResponse('Failed to retrive', HttpStatusCodeEnum::BAD_REQUEST);
        }
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

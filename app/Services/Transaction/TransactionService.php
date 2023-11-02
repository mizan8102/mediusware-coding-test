<?php

namespace App\Services\Transaction;
use App\Interfaces\Transaction\TransactionInterface;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Illuminate\Support\Carbon;

class TransactionService implements TransactionInterface{
/**
    * Summary of index
    * @return void
    */
   public function index(){
      try {
          $transactions = Transaction::with('user')->get();
          return $transactions;
      } catch (\Exception $e) {
          return response()->json(['error' => 'An error occurred while fetching transactions.'], 500);
      }   
  }
    /**
     * Summary of create
     * @return void
     */
    public function create(){

    }
    /**
     * Summary of store
     * @param mixed $request
     * @return mixed
     */
    public function store($request){
     
    }
    /**
     * Summary of show
     * @param string $id
     * @return void
     */
    public function show(){
      try {
          $transactions = Transaction::where('transaction_type','deposit')->get();
          return $transactions;
      } catch (\Exception $e) {
          return response()->json(['error' => 'An error occurred while fetching transactions.'], 500);
      }   
    }
    public function withdrawAll(){
      try {
          $transactions = Transaction::where('transaction_type','withdrawal')->get();
          return $transactions;
      } catch (\Exception $e) {
          return response()->json(['error' => 'An error occurred while fetching transactions.'], 500);
      }   
    }
    /**
     * Summary of edit
     * @param string $id
     * @return void
     */
    public function edit(string $id){

    }

    public function deposit($data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::find($data['user_id']);
            $user->balance += $data['amount'];
            $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'amount' => $data['amount'],
                'date' => now(), 
                'fee' => 0,
            ]);

            return [
                'user_id' => $user->id,
                'new_balance' => $user->balance,
            ];
        });
    }

   public function withdrawAmount($data) {
    return DB::transaction(function () use ($data) {
        $user = User::find($data['user_id']);

        $withdrawalAmount = $data['amount'];
        $accountType = $user->account_type;

        $withdrawalFee = 0;

        if ($accountType === 'Individual') {
            if ($this->hasFreeFridayWithdrawal()) {
                $withdrawalFee = 0;
            } elseif ($withdrawalAmount > 1000) {
                $withdrawalAmount -= 1000;
                $withdrawalFee = $withdrawalAmount * 0.015 / 100;
            }

            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $totalWithdrawalsWithinLimit = Transaction::whereBetween('date', [$startDate, $endDate])
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');

            if (($totalWithdrawalsWithinLimit - 5000) < 0) {
                $withdrawalFee = 0;
            }
        } elseif ($accountType === 'Business') {
            $totalWithdrawn = $user->totalWithdrawnAmount();

            if ($totalWithdrawn >= 50000) {
                $withdrawalFee = $withdrawalAmount * 0.015 / 100; // 0.015% fee
            } else {
                $withdrawalFee = $withdrawalAmount * 0.025 / 100; // 0.025% fee
            }
        }

        $user->balance -= ($withdrawalAmount + $withdrawalFee);
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $data['amount'],
            'date' => now(),
            'fee' => $withdrawalFee,
        ]);

        return [
            'user_id' => $user->id,
            'withdrawal_amount' => $withdrawalAmount,
            'withdrawal_fee' => $withdrawalFee,
            'new_balance' => $user->balance,
        ];
    });
}


    public function hasFreeFridayWithdrawal()
    {
        $currentDate = Carbon::now();
        if ($currentDate->dayOfWeek === Carbon::FRIDAY) {
            return true;
        }
        return false;
    }

    /**
     * Summary of update
     * @param mixed $request
     * @param string $id
     * @return void
     */
    public function update($request, string $id){

    }
    /**
     * Summary of destroy
     * @param string $id
     * @return void
     */
    public function destroy(string $id){

    }
}
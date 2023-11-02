<?php

namespace App\Interfaces\Transaction;

interface TransactionInterface{
   public function index();
    public function create();
    public function store($request);
    public function show();
    public function withdrawAll();
    public function withdrawAmount($data);
    public function deposit($data);
    public function edit(string $id);
    public function update($request, string $id);
    public function destroy(string $id);
}
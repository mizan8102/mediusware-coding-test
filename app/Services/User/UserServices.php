<?php

namespace App\Services\User;
use App\DTO\UserDTO;
use App\Interfaces\User\UserInterface;
use App\Models\User;

class UserServices implements UserInterface{
   /**
    * Summary of index
    * @return void
    */
   public function index(){

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
      $user= new UserDTO($request);
      return User::create($user->toArray());
    }
    /**
     * Summary of show
     * @param string $id
     * @return void
     */
    public function show(string $id){

    }
    /**
     * Summary of edit
     * @param string $id
     * @return void
     */
    public function edit(string $id){

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
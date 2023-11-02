<?php 

namespace App\DTO;

class UserDTO
{
    public $id;
    public $name;
    public $account_type;
    public $balance;
    public $email;
    public $password;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->account_type = $data['account_type'] ?? null;
        $this->balance = $data['balance'] ?? 0;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
    }

    public function toArray()
    {
         return get_object_vars($this);
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}

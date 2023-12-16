<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'email', 'phone_number', 'first_name', 'last_name', 'role', 'profile'];

    public function countUsers()
    {
        return $this->countAll();
    }
}

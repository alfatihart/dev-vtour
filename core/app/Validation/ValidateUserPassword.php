<?php

namespace App\Validation;

use App\Models\UserModel;

class ValidateUserPassword
{
    public function validate_user_password(string $str, string $id): bool
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        return password_verify($str, $user['password']);
    }
}

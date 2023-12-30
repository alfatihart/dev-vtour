<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'first_name' => 'Restu',
            'last_name' => 'Adi Akbar',
            'username' => 'restu',
            'email' => 'yoshstd@gmail.com',
            'phone_number' => '+6281234567890',
            'password' => password_hash('12345', PASSWORD_BCRYPT),
            'profile' => 'profile-1.png',
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $this->db->table('users')->insert($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'name' => 'Rohim Muhamad',
        'id_secret_question' => 1,
        'email'    => 'rohimuhamadd@gmail.com',
        'password' => password_hash('rahasia', PASSWORD_BCRYPT),
        'created_at' => Time::now(),
      ],
      [
        'name' => 'Yantina Larasati',
        'id_secret_question' => 2,
        'email'    => 'yantina@gmail.com',
        'password' => password_hash('yantina', PASSWORD_BCRYPT),
        'created_at' => Time::now(),
      ],
    ];

    // Simple Queries
    // $this->db->query('INSERT INTO users (name, email, password, created_at) VALUES(:name:, :email:, :password:, :created_at:)', $data);

    // Using Query Builder
    $this->db->table('users')->insertBatch($data);
  }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SecretQuestionsSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'id'          => 1,
        'id_user'     => 1,
        'question'    => 'Where were you when you had your first kiss?',
        'answer'      => 'bar',
        'created_at'  => Time::now(),
      ],
      [
        'id'          => 2,
        'id_user'     => 2,
        'question'    => 'Where were you when you had your first kiss?',
        'answer'      => 'bar',
        'created_at'  => Time::now(),
      ],
    ];

    // Simple Queries
    // $this->db->query('INSERT INTO users (name, email, password, created_at) VALUES(:name:, :email:, :password:, :created_at:)', $data);

    // Using Query Builder
    $this->db->table('secret_questions')->insertBatch($data);
  }
}

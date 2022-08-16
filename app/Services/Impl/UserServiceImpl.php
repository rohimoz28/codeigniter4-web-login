<?php

namespace App\Services\Impl;

use App\Models\UserModel;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
  public function save(array $data): void
  {
    $allData = [
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => password_hash($data['password'], PASSWORD_BCRYPT),
    ];

    $user = new UserModel();
    $user->save($allData);
  }
}

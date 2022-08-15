<?php

namespace App\Services\Impl;

use App\Models\UserModel;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
  public function save(array $data): void
  {
    $user = new UserModel();
    $user->save();
  }
}

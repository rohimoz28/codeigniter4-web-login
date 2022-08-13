<?php

namespace App\Services\Impl;

use App\Services\AuthService;

class AuthServiceImpl implements AuthService
{
  public function login($email, $password): bool
  {
    $users = new \App\Models\UserModel();
    $user = $users->where('email', $email)->first();

    if(is_null($user) || !password_verify($password, $user['password'])){
      return false;
    }

    return true;
  }
}

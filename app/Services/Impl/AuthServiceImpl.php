<?php

namespace App\Services\Impl;

use App\Services\AuthService;

class AuthServiceImpl implements AuthService
{

  protected $userModel;

  public function __construct()
  {
    $this->userModel = new \App\Models\UserModel();
  }

  public function login($email, $password): bool
  {
    $user = $this->userModel->where('email', $email)->first();

    if (!password_verify($password, $user['password'])) {
      return false;
    }

    return true;
  }

  public function checkEmail($email): bool
  {
    $user = $this->userModel->where('email', $email)->first();

    if ($user) {
      return true;
    }

    return false;
  }

  public function update($email, $password): void 
  {
    $user = $this->userModel->where('email', $email)->first();
    $id = $user['id'];

    $data = [
      'password' => password_hash($password, PASSWORD_BCRYPT),
    ];

    $this->userModel->update($id, $data);
  }
}

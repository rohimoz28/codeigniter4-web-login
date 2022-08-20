<?php

namespace App\Services\Impl;

use App\Services\AuthService;

class AuthServiceImpl implements AuthService
{

  protected $userModel;
  protected $secretQuestion;
  protected $session;

  public function __construct()
  {
    $this->userModel = new \App\Models\UserModel();
    $this->secretQuestion = new \App\Models\SecretQuestionModel();
    $this->session = \Config\Services::session();
  }

  public function login($email, $password): bool
  {
    $user = $this->userModel->where('email', $email)->first();

    if (!password_verify($password, $user['password'])) {
      return false;
    }

    $data = [
      'uniqid' => uniqid(),
      'id' => $user['id'],
      'name' => $user['name'],
      'isLogin' => true,
    ];

    $this->session->set($data);
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

  public function checkAnswer(string $email, string $answer): bool
  {
    $user = $this->userModel->where('email', $email)->first();
    $is_true = $this->secretQuestion->where('id', $user['id'])->get();
    $is_true = $is_true->getFirstRow('array');

    if ($is_true['answer'] == $answer) {
      return true;
    }

    return false;
  }

  public function update(string $email, string $password): void
  {
    $user = $this->userModel->where('email', $email)->first();
    $id = $user['id'];

    $data = [
      'password' => password_hash($password, PASSWORD_BCRYPT),
    ];

    $this->userModel->update($id, $data);
  }
}

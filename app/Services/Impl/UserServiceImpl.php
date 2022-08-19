<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
  protected $userModel;
  protected $secretModel;

  public function __construct()
  {
    $this->userModel = new \App\Models\UserModel();
    $this->secretModel = new \App\Models\SecretQuestionModel();
  }
  public function save(array $data): bool
  {
    // start transaction
    $this->userModel->transStart();
    $data_user = [
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => password_hash($data['password'], PASSWORD_BCRYPT),
    ];

    $this->userModel->insert($data_user); // get inserted user id 
    $user_id = $this->userModel->insertID();

    $data_secret = [
      'id_user' => $user_id,
      'question' => $data['question'],
      'answer' => $data['answer'],
    ];

    $this->secretModel->insert($data_secret);
    $this->userModel->transComplete();
    //end transaction

    if ($this->secretModel->transStatus() === false) {
      $this->userModel->transRollback();
      return false;
    }

    $this->userModel->transCommit();
    return true;
  }
}

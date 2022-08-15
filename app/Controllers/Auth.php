<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Impl\AuthServiceImpl;
use App\Models\UserModel;

class Auth extends BaseController
{
  protected $authServiceImpl;

  public function __construct()
  {
    $this->authServiceImpl = new AuthServiceImpl();
    $this->userModel = new \App\Models\UserModel();
  }

  public function index()
  {
    return view('auth/login', [
      'title' => 'Login',
    ]);
  }

  public function doLogin()
  {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    // validation
    if (empty($email) || empty($password)) {
      return redirect()->back()->with('error', 'Email or password is required');
    }
    if ($this->authServiceImpl->login($email, $password)) {
      $user = $this->userModel->where('email', $email)->first();
      // put session here
      $data = [
        'uniqid' => uniqid(),
        'name' => $user['name'],
        'isLogin' => true,
      ];

      $this->session->set($data);

      return redirect()->to('user');
    }

    return redirect()->back()->with('error', 'Wrong email or password!');

  }

  public function doLogout()
  {
    $session = session();
    $session->destroy();

    return redirect()->to('/');
  }
}

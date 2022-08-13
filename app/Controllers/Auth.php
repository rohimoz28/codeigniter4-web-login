<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Impl\AuthServiceImpl;

class Auth extends BaseController
{
  protected $authServiceImpl;

  public function __construct()
  {
    $this->authServiceImpl = new AuthServiceImpl();
  }

  public function index()
  {
    return view('auth/login');
  }

  public function doLogin()
  {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    if ($this->authServiceImpl->login($email, $password)) {
      // put session here
      return 'auth ok';
    }

    return 'auth not ok';
  }
}

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
      $data = [
        'uniqid' => uniqid(),
        'isLogin' => true,
      ];
      $this->session->set($data);

      // echo $this->session->get('data');
      return redirect()->to('user');
    }

    return redirect()->back()->with('error', 'Wrong email or password!');
  }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Impl\AuthServiceImpl;

class Auth extends BaseController
{
  protected $authServiceImpl;
  protected $validation;

  public function __construct()
  {
    $this->authServiceImpl = new AuthServiceImpl();
    $this->validation = \config\services::validation();
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

    $findUser = $this->authServiceImpl->findUser($email);

    if (!$findUser) {
      return redirect()->back()->with('error', 'Email not registered!');
    }

    // validasi
    if (empty($email) || empty($password)) {
      return redirect()->back()->with('error', 'Email or password is required');
    }

    // login gagal
    if (!$this->authServiceImpl->login($email, $password)) {
      return redirect()->back()->with('error', 'Wrong email or password!');
    }

    // login success
    return redirect()->to('user');
  }

  public function forgot()
  {
    return view('auth/forgot', [
      'title' => 'Forgot Password',
    ]);
  }

  public function doForgot()
  {
    $data = [
      'email' => $this->request->getVar('email'),
    ];

    // validasi
    if (!$this->validation->run($data, 'forgot')) {
      return view('auth/forgot', [
        'title' => 'Forgot Password',
        'validation' => $this->validator,
      ]);
    }

    if ($this->authServiceImpl->checkEmail($data['email'])) {
      // sukses validasi
      $data = [
        'email' => $data['email'],
        'title' => 'Secret Question',
        'validation' => $this->validator,
      ];

      return view('/auth/question', $data);
    }

    // gagal validasi
    session()->setFlashdata('error', 'Email is not registered.');
    return redirect()->back();
  }

  public function question()
  {
    return view('/auth/question', [
      'title' => 'Secret Question',
      'validation' => $this->validator,
    ]);
  }

  public function checkQuestion()
  {
    $data = [
      'email' => $this->request->getVar('email'),
      'answer' => $this->request->getVar('answer'),
    ];

    // validasi
    if (!$this->validation->run($data, 'question')) {
      return view('auth/question', [
        'title' => 'Secret Question',
        'email' => $data['email'],
        'validation' => $this->validator,
      ]);
    }

    // check answer
    if (!$this->authServiceImpl->checkAnswer($data['email'], $data['answer'])) {
      // answer wrong
      return view('auth/question', [
        'title' => 'Secret Question',
        'email' => $data['email'],
        'validation' => $this->validator,
      ]);
    }

    // answer correct
    $data = [
      'email' => $data['email'],
      'title' => 'Reset Password',
    ];

    return view('/auth/reset', $data);
  }

  public function reset()
  {
    return view('auth/reset', [
      'title' => 'Reset Password',
    ]);
  }

  public function doReset()
  {
    $data = [
      'email' => $this->request->getVar('email'),
      'password' => $this->request->getVar('password'),
      'password_confirmation' => $this->request->getVar('password_confirmation'),
    ];

    // validasi
    if (!$this->validation->run($data, 'reset')) {
      // validasi gagal 
      return view('/auth/reset', [
        'title' => 'Reset Password',
        'email' => $data['email'],
        'validation' => $this->validator,
      ]);
    }

    // validasi sukses
    // reset password
    $this->authServiceImpl->update($data['email'], $data['password']);
    return redirect()->to('/auth')->with('success', 'Reset password success');
  }

  public function doLogout()
  {
    $session = session();
    $session->destroy();

    return redirect()->to('/');
  }
}

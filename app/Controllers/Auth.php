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
        'id' => $user['id'],
        'name' => $user['name'],
        'isLogin' => true,
      ];

      $this->session->set($data);

      return redirect()->to('user');
    }

    return redirect()->back()->with('error', 'Wrong email or password!');
  }

  public function forgot()
  {
    return view('auth/forgot', [
      'title' => 'Forgot Password',
    ]);
  }

  public function doForgot()
  {
    // validasi
    $rules = [
      'email' => 'required|valid_email',
    ];

    if (!$this->validate($rules)) {
      return view('auth/forgot', [
        'title' => 'Forgot Password',
        'validation' => $this->validator,
      ]);
    }

    // check email
    $email = $this->request->getVar('email');

    if ($this->authServiceImpl->checkEmail($email)) {
      $data = [
        'email' => $email,
        'title' => 'Secret Question',
      ];
      return view('/auth/question', $data);
    }

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
    $email = $this->request->getVar('email');
    $answer = $this->request->getVar('answer');

    // validasi
    $rules = [
      'answer' => 'required',
    ];

    $is_validated = $this->validate($rules);

    if (!$is_validated) {
      return view('auth/question', [
        'title' => 'Secret Question',
        'email' => $email,
        'validation' => $this->validator,
      ]);
    }

    // check answer
    $is_answer = $this->authServiceImpl->checkAnswer($email, $answer);

    if ($is_answer) {
      $data = [
        'email' => $email,
        'title' => 'Reset Password',
      ];
      return view('/auth/reset', $data);
    }
    // answer wrong
    session()->setFlashdata('error', 'Your answer is wrong.');
    return redirect()->back();
  }

  public function reset()
  {
    return view('auth/reset', [
      'title' => 'Reset Password',
    ]);
  }

  public function doReset()
  {
    $email                  = $this->request->getVar('email');
    $password               = $this->request->getVar('password');
    // $password_confirmation  = $this->request->getVar('password_confirmation');

    $rules = [
      'password' => 'required|min_length[5]',
      'password_confirmation' => 'required|matches[password]',
    ];

    $error = [
      'password_confirmation' => [
        'matches' => 'Password not match',
      ]
    ];

    if (!$this->validate($rules, $error)) {
      return view('/auth/reset', [
        'title' => 'Reset Password',
        'email' => $email,
        'validation' => $this->validator,
      ]);
    }

    $this->authServiceImpl->update($email, $password);
    return redirect()->to('/auth')->with('success', 'Reset password success');
  }

  public function doLogout()
  {
    $session = session();
    $session->destroy();

    return redirect()->to('/');
  }
}

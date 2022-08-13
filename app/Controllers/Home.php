<?php

namespace App\Controllers;

class Home extends BaseController
{
  public function index()
  {
    if ($this->session->get("user")) {
      return redirect()->to('/user');
    } else {
      return redirect()->to('/auth');
    }
  }
}

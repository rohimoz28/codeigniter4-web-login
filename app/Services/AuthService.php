<?php

namespace App\Services;

interface AuthService
{
  public function login($email, $password): bool;
}

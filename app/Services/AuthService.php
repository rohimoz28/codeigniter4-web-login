<?php

namespace App\Services;

interface AuthService
{
  public function login($email, $password): bool;

  public function checkEmail($email): bool;

  public function update($email, $password): void;
}

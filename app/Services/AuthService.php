<?php

namespace App\Services;

interface AuthService
{
  public function login(string $email, string $password): bool;

  public function checkEmail(string $email): bool;

  public function checkAnswer(string $email, string $answer): bool;

  public function update(string $email, string $password): void;
}

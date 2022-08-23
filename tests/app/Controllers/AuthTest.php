<?php

namespace CodeIgniter;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class AuthTest extends CIUnitTestCase
{
  use ControllerTestTrait;
  use DatabaseTestTrait;

  public function testAuthPage()
  {
    $result = $this->withURI('http://localhost:8080/auth')
      ->controller(\App\Controllers\Auth::class)
      ->execute('index');

    $this->assertTrue($result->isOK());
  }
}


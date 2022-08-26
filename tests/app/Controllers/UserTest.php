<?php

namespace CodeIgniter;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
// use CodeIgniter\Test\FeatureTestTrait;

class UserTest extends CIUnitTestCase
{
  use ControllerTestTrait;
  use DatabaseTestTrait;
  // use FeatureTestTrait;

  protected function setUp(): void
  {
    parent::setUp();
  }

  protected function tearDown(): void
  {
    parent::tearDown();
  }

  public function testCreateNewUserPage()
  {
    $result = $this->withURI('http://localhost:8080/user/new')
      ->controller(\App\Controllers\User::class)
      ->execute('new');

    $this->assertTrue($result->isOK());
  }

  public function testCreateNewUser()
  {
    $result = $this->call('post', 'create', [
      'name' => 'Bagus Laksana',
      'email' => 'bagus@gmail.com',
      'password' => 'password',
      'password_confirmation' => 'password',
      'question' => 'question',
      'answer' => 'answer'
    ]);

    $result->controller(App\Controllers\Auth::class)->execute('create');

    $result->assertTrue($result->isOk());
  }
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
  //--------------------------------------------------------------------
  // Setup
  //--------------------------------------------------------------------

  /**
   * Stores the classes that contain the
   * rules that are available.
   *
   * @var string[]
   */
  public $ruleSets = [
    Rules::class,
    FormatRules::class,
    FileRules::class,
    CreditCardRules::class,
  ];

  /**
   * Specifies the views that are used to display the
   * errors.
   *
   * @var array<string, string>
   */
  public $templates = [
    'list'   => 'CodeIgniter\Validation\Views\list',
    'single' => 'CodeIgniter\Validation\Views\single',
  ];

  //--------------------------------------------------------------------
  // Rules
  //--------------------------------------------------------------------
  public $signup = [
    'name' => 'required|min_length[5]',
    'email' => 'required|valid_email|is_unique[users.email]',
    'password' => 'required|min_length[5]|max_length[200]',
    'password_confirm' => 'matches[password]',
    'question' => 'required|not_in_list[0]',
    'answer' => 'required',
  ];

  public $signup_errors = [
    'password' => [
      'matches' => 'Password not matches',
    ],
    'question' => [
      'not_in_list' => 'Please choose your secret questions',
    ]
  ];
}

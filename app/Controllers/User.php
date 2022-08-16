<?php

namespace App\Controllers;

use App\Services\Impl\UserServiceImpl;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class User extends ResourceController
{
  protected $userService;

  public function __construct()
  {
    $this->userService = new UserServiceImpl();
  }
  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    $data['title'] = 'Halaman User';
    return view('user/index', $data);
  }

  /**
   * Return the properties of a resource object
   *
   * @return mixed
   */
  public function show($id = null)
  {
    //
  }

  /**
   * Return a new resource object, with default properties
   *
   * @return mixed
   */
  public function new()
  {
    return view('user/new', [
      'title' => 'Registration',
      'validation' => Services::validation(),
    ]);
  }

  /**
   * Create a new resource object, from "posted" parameters
   *
   * @return mixed
   */
  public function create()
  {
    // validasi
    $rules = [
      'name' => 'required|min_length[5]',
      'email' => 'required|valid_email|is_unique[users.email]',
      'password' => 'required|min_length[6]|max_length[200]',
      'password_confirm' => 'matches[password]',
    ];

    $errors = [
      'password' => [
        'matches' => 'Password not matches',
      ]
    ];

    if (!$this->validate($rules, $errors)) {
      return view('user/new', [
        'title' => 'Registration',
        'validation' => $this->validator,
      ]);
    }

    // logic create new data
    $this->userService->save($_POST);
    return redirect()->to('/auth')->with('success', 'Registration success. Please Login');
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return mixed
   */
  public function edit($id = null)
  {
    //
  }

  /**
   * Add or update a model resource, from "posted" properties
   *
   * @return mixed
   */
  public function update($id = null)
  {
    //
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return mixed
   */
  public function delete($id = null)
  {
    //
  }
}

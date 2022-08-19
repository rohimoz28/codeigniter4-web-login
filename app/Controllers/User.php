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
    $validation = \Config\Services::validation();

    // validasi
    if (!$validation->run($_POST, 'signup')) {
      return view('user/new', [
        'title' => 'Registration',
        'validation' => $this->validator,
      ]);
    }

    // new register action
    $create_user = $this->userService->save($_POST);

    if ($create_user) {
      return redirect()->to('/auth')->with('success', 'Registration success. Please Login');
    }

    // if fail
    return view('user/new', [
      'title' => 'Registration',
      'error' => 'Registration failed',
      'validation' => $this->validator,
    ]);
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

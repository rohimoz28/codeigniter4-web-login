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
    $this->db = \Config\Database::connect();
    $userModel = new \App\Models\UserModel();
    $secretModel = new \App\Models\SecretQuestionModel();


    $name = $this->request->getVar('name');
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');
    $question = $this->request->getVar('question');
    $answer = $this->request->getVar('answer');

    // validasi
    $rules = [
      'name' => 'required|min_length[5]',
      'email' => 'required|valid_email|is_unique[users.email]',
      'password' => 'required|min_length[5]|max_length[200]',
      'password_confirm' => 'matches[password]',
      'question' => 'required|not_in_list[0]',
      'answer' => 'required',
    ];

    $errors = [
      'password' => [
        'matches' => 'Password not matches',
      ],
      'question' => [
        'not_in_list' => 'Please choose your secret questions',
      ]
    ];

    if (!$this->validate($rules, $errors)) {
      return view('user/new', [
        'title' => 'Registration',
        'validation' => $this->validator,
      ]);
    }

    // start transaction
    $userModel->transStart();
    $data_user = [
      'name' => $name,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT),
    ];

    $userModel->insert($data_user);
    $user_id = $userModel->insertID();

    $data_secret = [
      'id_user' => $user_id,
      'question' => $question,
      'answer' => $answer,
    ];

    $secretModel->insert($data_secret);
    $userModel->transComplete();
    //end transaction

    if ($this->db->transStatus() === false) {
      $this->db->transRollback();
      echo "insert gagal";
    } else {
      $this->db->transCommit();
      return redirect()->to('/auth')->with('success', 'Registration success. Please Login');
    }
    // var_dump($_POST);
    // die;


    // logic create new data
    // $this->userService->save($_POST);
    // return redirect()->to('/auth')->with('success', 'Registration success. Please Login');
    // return 'create';
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

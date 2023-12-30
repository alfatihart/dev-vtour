<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Models\UserModel;

class Dashboard extends BaseController
{
    // private $userModel;
    public function __construct()
    {
        // $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function index(): string
    {
        // dd(session()->get('email'));

        $sceneModel = new \App\Models\SceneModel();
        $hotspotModel = new \App\Models\HotspotModel();
        $mapModel = new \App\Models\MapModel();
        $sceneCount = $sceneModel->countScenes();
        $hotspotCount = $hotspotModel->countHotspots();
        $mapCount = $mapModel->countMaps();

        $data = [
            'title' => 'Dashboard',
            'sceneCount' => $sceneCount,
            'hotspotCount' => $hotspotCount,
            'mapCount' => $mapCount
        ];

        return view('admin/pages/dashboard', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // public function checkLogin()
    // {
    //     $session = session();
    //     $username = $this->request->getVar('username');
    //     $password = $this->request->getVar('password');
    //     $user = $this->userModel->where('username', $username)->first();

    //     if ($user) {
    //         $pass = $user['password'];
    //         $verifyPassword = password_verify($password, $pass);

    //         if ($verifyPassword) {
    //             $data = [
    //                 'id' => $user['id'],
    //                 'username' => $user['username'],
    //                 'email' => $user['email'],
    //                 'phone_number' => $user['phone_number'],
    //                 'fullname' => $user['first_name'] . ' ' . $user['last_name'],
    //                 'role' => $user['role'],
    //                 'profile' => $user['profile'],
    //                 'logged_in' => TRUE
    //             ];

    //             $session->set($data);
    //             return redirect()->to('/dashboard');
    //         } else {
    //             $session->setFlashdata('fail', 'Wrong Password');
    //             return redirect()->to('/login');
    //         }
    //     } else {
    //         $session->setFlashdata('fail', 'Username not Found');
    //         return redirect()->to('/login');
    //     }
    // }

    // public function registerUser()
    // {
    //     $validation = $this->validate([
    //         'firstname' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'First name is required'
    //             ]
    //         ],
    //         'lastname' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Last name is required'
    //             ]
    //         ],
    //         'username' => [
    //             'rules' => 'required|is_unique[users.username]',
    //             'errors' => [
    //                 'required' => 'Username is required',
    //                 'is_unique' => 'Username has already registered'
    //             ]
    //         ],
    //         'email' => [
    //             'rules' => 'required|valid_email|is_unique[users.email]',
    //             'errors' => [
    //                 'required' => 'Email is required',
    //                 'valid_email' => 'Email is not valid',
    //                 'is_unique' => 'Email has already registered'
    //             ]
    //         ],
    //         'password' => [
    //             'rules' => 'required|min_length[5]|max_length[12]',
    //             'errors' => [
    //                 'required' => 'Password is required',
    //                 'min_length' => 'Password is too short',
    //                 'max_length' => 'Password is too long'
    //             ]
    //         ],
    //         'cpassword' => [
    //             'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
    //             'errors' => [
    //                 'required' => 'Confirm password is required',
    //                 'min_length' => 'Confirm password is too short',
    //                 'max_length' => 'Confirm password is too long',
    //                 'matches' => 'Confirm password is not match'
    //             ]
    //         ]
    //     ]);

    //     if (!$validation) {
    //         return view('admin/pages/register', [
    //             'validation' => $this->validator,
    //             'title' => 'Register'
    //         ]);
    //     } else {
    //         $data = [
    //             'first_name' => $this->request->getVar('firstname'),
    //             'last_name' => $this->request->getVar('lastname'),
    //             'username' => $this->request->getVar('username'),
    //             'email' => $this->request->getVar('email'),
    //             'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    //             'role' => $this->request->getVar('role')
    //         ];

    //         $this->userModel->save($data);
    //         session()->setFlashdata('success', 'User Added Successfully');
    //         return redirect()->to('/login');
    //     }
    // }


    // public function login()
    // {
    //     if (session()->get('logged_in')) {
    //         return redirect()->to('/dashboard');
    //     }

    //     $data = [
    //         'title' => 'Login',
    //         'usersCount' => $this->userModel->countUsers()
    //     ];

    //     return view('admin/pages/login', $data);
    // }

    // public function register()
    // {
    //     if (session()->get('logged_in')) {
    //         return redirect()->to('/dashboard');
    //     } else if ($this->userModel->countUsers() > 0) {
    //         return redirect()->to('/login');
    //     }

    //     $data = [
    //         'title' => 'Register'
    //     ];

    //     return view('admin/pages/register', $data);
    // }

    // public function forgotPassword()
    // {
    //     $data = [
    //         'title' => 'Forgot Password'
    //     ];

    //     return view('admin/pages/forgot-password', $data);
    // }
}

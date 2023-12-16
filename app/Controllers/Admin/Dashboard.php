<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
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

    public function checkLogin()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            $pass = $user['password'];
            $verifyPassword = password_verify($password, $pass);

            if ($verifyPassword) {
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                    'fullname' => $user['first_name'] . ' ' . $user['last_name'],
                    'role' => $user['role'],
                    'profile' => $user['profile'],
                    'logged_in' => TRUE
                ];

                $session->set($data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login');
        }
    }

    public function registerUser()
    {
        $session = session();
        $userModel = new \App\Models\UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $email = $this->request->getVar('email');
        $phone_number = $this->request->getVar('phone_number');
        $first_name = $this->request->getVar('first_name');
        $last_name = $this->request->getVar('last_name');
        $role = $this->request->getVar('role');
        $profile = $this->request->getVar('profile');
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => $role,
            'profile' => $profile
        ];

        $userModel->insert($data);
        $session->setFlashdata('msg', 'User Added Successfully');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login',
            'usersCount' => $this->userModel->countUsers()
        ];

        return view('admin/pages/login', $data);
    }

    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        } else if ($this->userModel->countUsers() > 0) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Register'
        ];

        return view('admin/pages/register', $data);
    }

    public function forgotPassword()
    {
        $data = [
            'title' => 'Forgot Password'
        ];

        return view('admin/pages/forgot-password', $data);
    }
}

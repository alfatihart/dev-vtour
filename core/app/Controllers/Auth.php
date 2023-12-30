<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function loginForm()
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

    public function loginHandler()
    {
        $session = session();

        $isValid = $this->validate([
            'username' => [
                'rules' => 'required|is_not_unique[users.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_not_unique' => 'Username is not registered',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[16]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 5 characters',
                    'max_length' => 'Password must be at most 16 characters',
                ],
            ],
        ]);

        if (!$isValid) {
            return view('admin/pages/login', [
                'title' => 'Login',
                'usersCount' => $this->userModel->countUsers(),
                'validation' => $this->validator,
            ]);
        } else {
            $userModel = new UserModel();
            $user = $userModel->where('username', $this->request->getVar('username'))->first();
            $check_password = password_verify($this->request->getVar('password'), $user['password']);

            if (!$check_password) {
                return redirect()->route('admin.login.form')->with('fail', 'Wrong password')->withInput();
            } else {
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
                return redirect()->route('admin.home');
            }
        }
    }

    public function registerForm()
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

    public function registerHandler()
    {
        $validation = $this->validate([
            'firstname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'First name is required'
                ]
            ],
            'lastname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Last name is required'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_unique' => 'Username has already registered'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid',
                    'is_unique' => 'Email has already registered'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[16]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password is too short',
                    'max_length' => 'Password is too long'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[5]|max_length[16]|matches[password]',
                'errors' => [
                    'required' => 'Confirm password is required',
                    'min_length' => 'Confirm password is too short',
                    'max_length' => 'Confirm password is too long',
                    'matches' => 'Confirm password is not match'
                ]
            ]
        ]);

        if (!$validation) {
            return view('admin/pages/register', [
                'validation' => $this->validator,
                'title' => 'Register'
            ]);
        } else {
            $data = [
                'first_name' => $this->request->getVar('firstname'),
                'last_name' => $this->request->getVar('lastname'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'role' => $this->request->getVar('role')
            ];

            $this->userModel->save($data);
            session()->setFlashdata('success', 'User Added Successfully');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function forgotPassword()
    {
        $data = [
            'title' => 'Forgot Password'
        ];

        return view('admin/pages/forgot-password', $data);
    }

    public function updateAccount($id)
    {
        // Retrieve the data from the form submission
        $data = [
            'username' => $this->request->getPost('username'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number')
        ];

        // Update the data to the database
        $this->userModel->update($id, $data);

        // Store a success message in session
        session()->setFlashdata('success', 'Account updated successfully');

        // Redirect to the settings page
        return redirect()->to('/account');
    }

    public function updatePassword($id)
    {
        $rules = [
            'currentPassword' => [
                'rules' => 'required|min_length[5]|max_length[16]|validate_user_password[' . $id . ']',
                'errors' => [
                    'required' => 'Current password is required',
                    'min_length' => 'Current password must be at least 5 characters in length',
                    'max_length' => 'Current password cannot exceed 16 characters in length',
                    'validate_user_password' => 'Current password is incorrect'
                ]
            ],
            'newPassword' => [
                'rules' => 'required|min_length[5]|max_length[16]|is_password_strong[new_password]',
                'errors' => [
                    'required' => 'New password is required',
                    'min_length' => 'New password must be at least 5 characters in length',
                    'max_length' => 'New password cannot exceed 16 characters in length',
                    'is_password_strong' => 'New password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ],
            'confirmPassword' => [
                'rules' => 'required|matches[newPassword]',
                'errors' => [
                    'required' => 'Confirm password is required',
                    'matches' => 'Confirm password must match new password'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $activeTab = 'nav-security';
            return redirect()->to('/account')->withInput()->with('activeTab', $activeTab)->with('validation', $validation);
        } else {

            // Retrieve the data from the form submission
            $password = $this->request->getVar('newPassword');
            $data = [
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ];

            // Update the data to the database
            $this->userModel->update($id, $data);

            // Store a success message in session
            session()->setFlashdata('success', 'Password updated successfully');

            // Redirect to the settings page
            return redirect()->to('/account');
        }
    }
}

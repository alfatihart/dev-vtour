<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\SceneModel;
use App\Models\UserModel;
use Kint\Zval\Value;

class Settings extends BaseController
{
    private $settingModel;
    private $sceneModel;
    private $userModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->sceneModel = new SceneModel();
        $this->userModel = new UserModel();

        helper(['form']); // Load the form helper
    }
    public function index(): string
    {
        $settings = $this->settingModel->getSettings(1);
        $scenes = $this->sceneModel->findAll();

        $data = [
            'title' => 'System Settings',
            'settings' => $settings,
            'scenes' => $scenes
        ];

        // dd($data);

        return view('admin/settings/system', $data);
    }

    public function update($id)
    {
        // Retrieve the data from the form submission
        $data = [
            'first_scene' => $this->request->getPost('first_scene'),
            'author' => $this->request->getPost('author'),
            'auto_load' => $this->request->getPost('auto_load'),
            'scene_fade' => $this->request->getPost('scene_fade'),
            'auto_rotate' => $this->request->getPost('auto_rotate'),
            'rotate_delay' => $this->request->getPost('rotate_delay'),
            'compass' => $this->request->getPost('compass'),
            'device_orientation' => $this->request->getPost('device_orientation'),
            'show_controls' => $this->request->getPost('show_controls'),
            'hotspot_debug' => $this->request->getPost('hotspot_debug')
        ];

        // Update the data to the database
        $this->settingModel->update($id, $data);

        // Store a success message in session
        session()->setFlashdata('message', 'Settings updated successfully');

        // Redirect to the settings page
        return redirect()->to('/system');
    }

    public function account(): string
    {
        $user = $this->userModel->find(session()->get('id'));

        $data = [
            'title' => 'Account Settings',
            'user' => $user,
        ];

        return view('admin/settings/account', $data);
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
        session()->setFlashdata('message', 'Account updated successfully');

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
            $password = $this->request->getVar('password');
            $data = [
                'password' => password_hash($password, PASSWORD_DEFAULT)
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

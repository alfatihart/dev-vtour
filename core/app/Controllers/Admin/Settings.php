<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\SceneModel;
use App\Models\UserModel;

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
            'user' => $user
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
        // Retrieve the data from the form submission
        $password = $this->request->getVar('password');
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        // Update the data to the database
        $this->userModel->update($id, $data);

        // Store a success message in session
        session()->setFlashdata('message', 'Password updated successfully');

        // Redirect to the settings page
        return redirect()->to('/account');
    }
}

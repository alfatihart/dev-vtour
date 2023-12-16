<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HotspotModel;
use App\Models\SceneModel;

class Hotspots extends BaseController
{
    private $hotspotModel;
    private $sceneModel;

    public function __construct()
    {
        $this->hotspotModel = new HotspotModel();
        $this->sceneModel = new SceneModel();
    }

    public function index(): string
    {
        // Retrieve all hotspots from the database
        $hotspots = $this->hotspotModel->getHotspotsWithSceneSlug();

        $data = [
            'title' => 'Hotspots List',
            'hotspots' => $hotspots
        ];

        return view('admin/hotspots/index', $data);
    }

    public function create(): string
    {
        $scenes = $this->sceneModel->findAll();

        $data = [
            'title' => 'Create New Hotspot',
            'scenes' => $scenes
        ];

        return view('admin/hotspots/create', $data);
    }

    public function store(): object
    {
        // Retrieve the data from the form submission
        if ($this->request->getPost('type') === 'scene') {
            $url = null;
            $scene = $this->request->getPost('target_scene');
        } else {
            $url = $this->request->getPost('url');
            $scene = null;
        }
        $data = [
            'main_scene' => $this->request->getPost('main_scene'),
            'type' => $this->request->getPost('type'),
            'pitch' => $this->request->getPost('pitch'),
            'yaw' => $this->request->getPost('yaw'),
            'text' => $this->request->getPost('text'),
            'style' => $this->request->getPost('style'),
            'target_scene' => $scene,
            'url' => $url
        ];

        // Insert the data to the database
        $this->hotspotModel->insert($data);

        // Store a success message in session
        session()->setFlashdata('message', 'Hotspot created successfully');

        // Redirect to the hotspot list page
        return redirect()->to('/hotspots');
    }

    public function edit($id)
    {
        $hotspot = $this->hotspotModel->getHotspots($id);
        $scenes = $this->sceneModel->findAll();

        $data = [
            'title' => 'Edit Hotspot',
            'hotspot' => $hotspot,
            'scenes' => $scenes
        ];

        return view('admin/hotspots/edit', $data);
    }

    public function update($id)
    {
        // Retrieve the data from the form submission
        if ($this->request->getPost('type') === 'scene') {
            $url = null;
            $scene = $this->request->getPost('target_scene');
        } else {
            $url = $this->request->getPost('url');
            $scene = null;
        }
        $data = [
            'main_scene' => $this->request->getPost('main_scene'),
            'type' => $this->request->getPost('type'),
            'pitch' => $this->request->getPost('pitch'),
            'yaw' => $this->request->getPost('yaw'),
            'text' => $this->request->getPost('text'),
            'style' => $this->request->getPost('style'),
            'target_scene' => $scene,
            'url' => $url
        ];

        // Update the data to the database
        $this->hotspotModel->update($id, $data);

        // Store a success message in session
        session()->setFlashdata('message', 'Hotspot updated successfully');

        // Redirect to the hotspot list page
        return redirect()->to('/hotspots');
    }

    public function delete($id)
    {
        $this->hotspotModel->delete($id);
        session()->setFlashdata('message', 'Hotspot deleted successfully!');
        return redirect()->to('/hotspots');
    }
}

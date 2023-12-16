<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapModel;
use App\Models\SceneModel;

class Maps extends BaseController
{
    protected $mapModel;
    protected $sceneModel;

    public function __construct()
    {
        $this->mapModel = new MapModel();
        $this->sceneModel = new SceneModel();
    }

    public function index(): string
    {

        $data = [
            'title' => 'Maps Pin',
            'maps' => $this->mapModel->getMapsWithScene(),
            'scenes' => $this->sceneModel->getScenes(),
        ];

        return view('admin/maps/index', $data);
    }

    public function store()
    {
        $this->mapModel->save([
            'name' => $this->request->getVar('name'),
            'scene_id' => $this->request->getVar('scene_id'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude')
        ]);

        session()->setFlashdata('message', 'New maps pin has been added');

        return redirect()->to('/maps');
    }

    public function edit($id)
    {
        $map = $this->mapModel->getMaps($id);
        echo json_encode($map);
    }

    public function update($id)
    {
        $this->mapModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'scene_id' => $this->request->getVar('scene_id'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude')
        ]);

        session()->setFlashdata('message', 'Maps pin has been updated');

        return redirect()->to('/maps');
    }

    public function delete($id)
    {
        $this->mapModel->delete($id);

        session()->setFlashdata('message', 'Maps pin has been deleted');

        return redirect()->to('/maps');
    }
}

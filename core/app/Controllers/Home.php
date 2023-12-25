<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\SceneModel;
use App\Models\MapModel;
// use App\Models\HotspotModel;


class Home extends BaseController
{
    private $settingModel;
    private $sceneModel;
    private $mapModel;
    // private $hotspotModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->sceneModel = new SceneModel();
        $this->mapModel = new MapModel();
        // $this->hotspotModel = new HotspotModel();
    }
    public function index()
    {
        // dd($this->sceneModel->getScenesWithHotspots());

        $setting = $this->settingModel->getSettings(1);
        $scenes = $this->sceneModel->getScenesWithHotspots();
        $maps = $this->mapModel->getMapsWithScene();
        // $scenes = $this->sceneModel->findAll();
        // $hotspots = $this->hotspotModel->findAll();

        $firstSceneSlug = $this->sceneModel->where('id', $setting['first_scene'])->first()['slug'];

        $data = [
            'title' => 'System Settings',
            'setting' => $setting,
            'scenes' => $scenes,
            'maps' => $maps,
            'firstSceneSlug' => $firstSceneSlug
        ];

        return view('home/index', $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class HotspotModel extends Model
{
    protected $table = 'hotspots';
    protected $useTimestamps = true;
    protected $allowedFields = ['main_scene', 'type', 'pitch', 'yaw', 'text', 'style', 'target_scene', 'url'];

    public function getHotspots($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    // public function getHotspotsWithSceneSlug()
    // {
    //     return $this->select('hotspots.*, scenes.slug AS scene_slug')
    //         ->join('scenes', 'hotspots.main_scene = scenes.id', 'left')
    //         ->findAll();
    // }

    public function getHotspotsWithSceneSlug()
    {
        return $this->select('hotspots.*, main_scenes.slug AS main_scene_slug, target_scenes.slug AS target_scene_slug')
            ->join('scenes as main_scenes', 'hotspots.main_scene = main_scenes.id', 'left')
            ->join('scenes as target_scenes', 'hotspots.target_scene = target_scenes.id', 'left')
            ->findAll();
    }

    public function countHotspots()
    {
        return $this->countAll();
    }
}

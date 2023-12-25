<?php

namespace App\Models;

use CodeIgniter\Model;

class MapModel extends Model
{
    protected $table = 'maps';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'scene_id', 'latitude', 'longitude'];

    public function getMaps($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getMapsWithScene()
    {
        $this->select('maps.*, scenes.slug AS scene_slug')
            ->join('scenes', 'scenes.id = maps.scene_id', 'left');
        return $this->findAll();
    }

    public function countMaps()
    {
        return $this->countAll();
    }
}

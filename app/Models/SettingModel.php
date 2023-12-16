<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
  protected $table = 'settings';
  protected $useTimestamps = true;
  protected $allowedFields = ['first_scene', 'author', 'auto_load', 'scene_fade', 'auto_rotate', 'rotate_delay', 'compass', 'device_orientation', 'show_controls', 'hotspot_debug'];

  public function getSettings($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }

    return $this->where(['id' => $id])->first();
  }
}

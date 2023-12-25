<?php

namespace App\Models;

use CodeIgniter\Model;

class SceneModel extends Model
{
    protected $table = 'scenes';
    protected $useTimestamps = true;
    protected $allowedFields = ['slug', 'title', 'hfov', 'pitch', 'yaw', 'north_offset', 'image'];

    public function getScenes($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    // public function getScenesWithHotspots()
    // {
    //     $db = \Config\Database::connect();

    //     $query = $db->table('my_table') // select the table
    //         ->select('column1, column2') // select the columns
    //         ->where('column1', 'some value') // add a WHERE clause
    //         ->orderBy('column2', 'DESC') // add an ORDER BY clause
    //         ->get(); // execute the query

    //     $results = $query->getResult(); // get the results

    //     $scenes = [];
    //     foreach ($results->getResult() as $row) {
    //         $scenes[] = [
    //             'id' => $row->id,
    //             'name' => $row->name,
    //             'hotspot' => json_decode($row->hotspot),
    //         ];
    //     }

    //     return $scenes;
    // }

    // public function getScenesWithHotspots()
    // {
    //     $db = \Config\Database::connect();

    //     $query = $db->table('scenes s')
    //         ->select(
    //             's.id, s.slug, s.title, s.hfov, s.pitch, s.yaw, s.image, s.north_offset, 
    //             CONCAT_WS(",", JSON_OBJECT("id", h.id, "type", h.type, "text", h.text, "pitch", h.pitch, "yaw", h.yaw, "sceneId", h.target_scene, "URL", h.url)) AS hotSpots',
    //             false
    //         ) // false is added to prevent CI4 from trying to escape the query
    //         ->join('hotspots h', 's.id = h.main_scene', 'left')
    //         ->groupBy('s.id')
    //         ->orderBy('s.id')
    //         ->get();

    //     $results = $query->getResult();

    //     return $results;
    // }

    public function getScenesWithHotspots()
    {
        $db = \Config\Database::connect();

        $query = $db->table('scenes s')
            ->select(
                's.id, s.slug, s.title, s.hfov, s.pitch, s.yaw, s.image, s.north_offset, 
            h.id as hotspot_id, h.type, h.text, h.style, h.pitch as hotspot_pitch, h.yaw as hotspot_yaw, h.target_scene, h.url, ts.slug as target_scene_slug',
                false
            )
            ->join('hotspots h', 's.id = h.main_scene', 'left')
            ->join('scenes ts', 'h.target_scene = ts.id', 'left') // join with scenes again to get the slug of the target scene
            ->orderBy('s.id')
            ->get();

        $results = $query->getResult();

        $scenes = [];
        foreach ($results as $row) {
            if (!isset($scenes[$row->id])) {
                $scenes[$row->id] = [
                    'id' => $row->id,
                    'slug' => $row->slug,
                    'title' => $row->title,
                    'hfov' => $row->hfov,
                    'pitch' => $row->pitch,
                    'yaw' => $row->yaw,
                    'image' => $row->image,
                    'north_offset' => $row->north_offset,
                    'hotSpots' => [],
                    'hotspotCount' => 0, // Initialize hotspot count
                ];
            }

            $scenes[$row->id]['hotSpots'][] = [
                'id' => $row->hotspot_id,
                'type' => $row->type,
                'text' => $row->text,
                'style' => $row->style,
                'pitch' => $row->hotspot_pitch,
                'yaw' => $row->hotspot_yaw,
                'sceneId' => $row->target_scene_slug, // use the slug of the target scene instead of its id
                'url' => $row->url,
            ];
            $scenes[$row->id]['hotspotCount']++; // Increase hotspot count
        }

        return array_values($scenes);
    }

    public function countScenes()
    {
        return $this->countAll();
    }
}

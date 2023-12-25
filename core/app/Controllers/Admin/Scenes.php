<?php

namespace App\Controllers\Admin;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\SceneModel; // Include the Scenes model
use Intervention\Image\ImageManagerStatic as Image;

class Scenes extends BaseController
{
    private $sceneModel;

    public function __construct()
    {
        $this->sceneModel = new SceneModel(); // Create an instance of the Scenes model
        helper(['form']); // Load the form helper
    }

    public function index(): string
    {
        // Retrieve all scenes from the database
        $data = [
            'title' => 'Scenes List',
            'scenes' => $this->sceneModel->getScenesWithHotspots() // Pass the scenes data to the view
        ];

        return view('admin/scenes/index', $data);
    }

    public function show(string $slug)
    {
        // Retrieve a single scene from the database
        $data = [
            'title' => 'Scene Details',
            'scene' => $this->sceneModel->getScenes($slug) // Pass the scene data to the view
        ];

        // If no scene is found, display an error message
        if (empty($data['scene'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the scene: ' . $slug);
        }

        return view('admin/scenes/detail', $data);
    }

    public function create($data = [])
    {
        if ($data == []) {
            $data['title'] = 'Create New Scene';
            $data['validation'] = \Config\Services::validation();
        }

        return view('admin/scenes/create', $data);
    }

    public function store()
    {
        $imageFile = $this->request->getFile('image'); // Get the image file
        if ($imageFile->getError() == 4) {
            $imageName = 'default.jpg';
        } else {
            // $imageName = $imageFile->getRandomName(); // Generate a random name
            $imageName = $this->request->getVar('slug') . '.' . $imageFile->getExtension(); // Get the image file name
            $imageFile->move('uploads', $imageName); // Move the image file to the uploads folderss
        }

        $rules = [
            'slug' => 'required|is_unique[scenes.slug]',
            'title' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'slug' => $this->request->getVar('slug'),
                'title' => $this->request->getVar('title'),
                'hfov' => $this->request->getVar('hfov'),
                'pitch' => $this->request->getVar('pitch'),
                'yaw' => $this->request->getVar('yaw'),
                'north_offset' => $this->request->getVar('north_offset'),
                'image' => $imageName,
                // 'image' => $this->request->getVar('image'),
            ];
            $this->sceneModel->save($data);

            session()->setFlashdata('message', 'New scene created successfully!');

            return redirect()->to('/scenes');
        } else {
            return redirect()->to('scenes/create')->withInput();
        }
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Scene',
            'validation' => \Config\Services::validation(),
            'scene' => $this->sceneModel->getScenes($slug)
        ];

        return view('admin/scenes/edit', $data);
    }

    public function update($id)
    {
        $sceneOld = $this->sceneModel->find($id);
        if ($sceneOld['slug'] == $this->request->getVar('slug')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[scenes.slug]';
        }
        $rules = [
            'slug' => $rule,
            'title' => 'required',
        ];

        if ($this->validate($rules)) {
            $imageFile = $this->request->getFile('image'); // Get the image file
            if ($imageFile->getError() == 4) {
                if (file_exists('uploads/' . $this->request->getVar('oldImage'))) {
                    $imageName = $this->request->getVar('oldImage');
                } else {
                    $imageName = 'default.jpg';
                }
            } else {
                // $imageName = $imageFile->getRandomName(); // Generate a random name
                $imageName = $this->request->getVar('slug') . '_' . $id . '.' . $imageFile->getExtension(); // Get the image file name
                $imageFile->move('uploads', $imageName); // Move the image file to the uploads folderss
                if ($this->request->getVar('oldImage') != 'default.jpg' && file_exists('uploads/' . $this->request->getVar('oldImage'))) {
                    unlink('uploads/' . $this->request->getVar('oldImage'));
                }
            }

            $data = [
                'slug' => $this->request->getVar('slug'),
                'title' => $this->request->getVar('title'),
                'hfov' => $this->request->getVar('hfov'),
                'pitch' => $this->request->getVar('pitch'),
                'yaw' => $this->request->getVar('yaw'),
                'north_offset' => $this->request->getVar('north_offset'),
                'image' => $imageName,
            ];
            $this->sceneModel->update($id, $data);

            session()->setFlashdata('message', 'Scene updated successfully!');

            return redirect()->to('/scenes');
        } else {
            // $validation = \Config\Services::validation();
            // return redirect()->to('scenes/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('scenes/edit/' . $this->request->getVar('slug'))->withInput();
        }
    }

    public function delete($id)
    {
        $scene = $this->sceneModel->find($id);
        if ($scene['image'] != 'default.jpg') {
            unlink('uploads/' . $scene['image']);
        }
        $this->sceneModel->delete($id);
        session()->setFlashdata('message', 'Scene deleted successfully!');
        return redirect()->to('/scenes');
    }

    public function thumbnail()
    {
        // Get the image name from the query parameters
        $imageName = $this->request->getGet('image');

        // Jika file cache belum ada, buat thumbnail dan simpan ke file cache
        if (!$imageName) {
            // If no image name is provided, display an error message
            header('Content-Type: text/plain');
            echo 'The image name is required.';
            exit();
        } else if ($imageName == 'default.jpg') {
            // Return default.jpg as the image
            header('Content-Type: image/jpeg');
            readfile(FCPATH . 'uploads/' . $imageName);
            exit();
        }

        // Get the image path
        $imagePath = FCPATH . 'uploads/' . $imageName;

        // Check if the image file exists
        if (!file_exists($imagePath)) {
            // If the image file doesn't exist, display an error message
            header('Content-Type: text/plain');
            echo 'The image file does not exist.';
            exit();
        }
        // dd($imagePath);

        // Get the image dimensions
        list($srcWidth, $srcHeight) = getimagesize($imagePath);

        // Calculate the scaling factor and the new dimensions
        $maxWidth = 250;
        $maxHeight = 250;
        $scale = min($maxWidth / $srcWidth, $maxHeight / $srcHeight);
        $newWidth = $srcWidth * $scale;
        $newHeight = $srcHeight * $scale;

        // Lokasi direktori cache
        $cacheDir = FCPATH . 'cache/';

        // Pastikan direktori cache ada
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        // Nama file cache berdasarkan nama file asli dan ukuran thumbnail
        $cacheFile = $cacheDir . $imageName . '_' . $newWidth . 'x' . $newHeight . '.jpg';

        // Jika file cache belum ada, buat thumbnail dan simpan ke file cache
        if (!file_exists($cacheFile)) {
            // Load the source image
            $image = imagecreatefromjpeg($imagePath);

            // Create a new true color image
            $thumbnail = imagecreatetruecolor($newWidth, $newHeight);

            // Copy and resize the source image to the thumbnail
            imagecopyresampled(
                $thumbnail,
                $image,
                0,
                0,
                0,
                0,
                $newWidth,
                $newHeight,
                $srcWidth,
                $srcHeight
            );

            // Save the thumbnail to the cache file
            imagejpeg($thumbnail, $cacheFile);

            // Free up memory
            imagedestroy($image);
            imagedestroy($thumbnail);
        }

        // Output the cache file
        header('Content-Type: image/jpeg');
        header('Content-Disposition: filename="' . basename($cacheFile) . '"');
        readfile($cacheFile);

        // Prevent CI4 from further processing
        exit();
    }

    public function render($image)
    {
        // Load the image
        $img = Image::make('uploads/' . $image);

        // Resize the image to a width of 250 and constrain aspect ratio (auto height)
        // $img->resize(250, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // });

        // Make the image a progressive JPEG
        $img->interlace();

        // Return the image
        return $img->response('jpg');
    }

    public function save()
    {
        // Validate the form data
        // $validation = $this->validate([
        //     'slug' => [
        //         'rules' => 'required|is_unique[scenes.slug]',
        //         'errors' => [
        //             'required' => 'The scene ID field is required.',
        //             'is_unique' => 'The scene ID field must contain a unique value.'
        //         ]
        //     ],
        //     'title' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The title field is required.'
        //         ]
        //     ],
        //     'hfov' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The hfov field is required.'
        //         ]
        //     ],
        //     'pitch' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The pitch field is required.'
        //         ]
        //     ],
        //     'yaw' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The yaw field is required.'
        //         ]
        //     ],
        //     'north_offset' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The north offset field is required.'
        //         ]
        //     ],
        //     'image' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'The image field is required.'
        //         ]
        //     ],
        // ]);

        // If the validation fails, display an error message
        if (!$this->validate([
            'slug' => 'required|is_unique[scenes.slug]'
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/scenes/create')->withInput();
        }

        // Retrieve the form data using the input helper
        $data = [
            'slug' => $this->request->getVar('slug'),
            'title' => $this->request->getVar('title'),
            'hfov' => $this->request->getVar('hfov'),
            'pitch' => $this->request->getVar('pitch'),
            'yaw' => $this->request->getVar('yaw'),
            'north_offset' => $this->request->getVar('north_offset'),
            'image' => $this->request->getVar('image'),
        ];

        // Save the form data to the database
        $this->sceneModel->save($data);

        session()->setFlashdata('message', 'New scene created successfully!');

        // Redirect to the scenes list page
        return redirect()->to('/scenes');
    }
}

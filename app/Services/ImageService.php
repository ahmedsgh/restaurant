<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Process and save an uploaded image
     * 
     * @param UploadedFile $file
     * @param string $directory (e.g., 'products', 'categories')
     * @param int $width
     * @param int $height
     * @return string The path to the saved image
     */
    public function processAndSave(UploadedFile $file, string $directory, int $width = 800, int $height = 600): string
    {
        // Read the uploaded image
        $image = $this->manager->read($file->getRealPath());

        // Resize and fit to dimensions
        $image->cover($width, $height);

        // Generate unique filename
        $filename = uniqid() . '.png';
        $path = storage_path("app/public/{$directory}/{$filename}");

        // Ensure directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Save as PNG
        $image->toPng()->save($path);

        return "{$directory}/{$filename}";
    }
}

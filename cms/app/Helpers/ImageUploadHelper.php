<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageUploadHelper
{
    public static function uploadImage($image, $directory = 'images')
    {
      if ($image && is_file($image)) {
        return $image->store($directory, 'public');
      }

      return null;
    }
}

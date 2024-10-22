<?php



namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageHandlerService
{

  public function uploadImage(UploadedFile $image, string $folder): string
  {
    $originalFileName = $image->getClientOriginalName();
    $fileName = uniqid() . '_' . $originalFileName;

    $path = $image->storeAs($folder, $fileName);

    return $path;
  }
}

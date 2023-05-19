<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadFiles($file, $path, $fileName,  $oldFile = "")
    {
        $file->storeAs($path, $fileName, 'public');

        $this->deleteFile($oldFile);
    }

    public function deleteFile($path)
    {
        if (Storage::url($path)) {

            Storage::disk('public')->delete($path);
        }
    }
}

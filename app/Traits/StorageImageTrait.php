<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function storageUpload($request, $fieldName, $foderName)
    {

        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $name_image = current(explode('.', $fileNameOrigin));
            $fileNameHash = $name_image . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $filePath = 'storage/' . $request->file($fieldName)->storeAs('public/' . $foderName . '', $fileNameHash);
            $dataUploadTrait = [
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;

    }
}

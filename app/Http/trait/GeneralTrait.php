<?php

namespace App\Http\trait;

use Illuminate\Support\Facades\Storage;

trait GeneralTrait
{
    public function saveFile($file,$path) {
        $fileNameWithExt = $file->getClientOriginalName();
        // Delete old file
        $exists = Storage::disk('public')->exists($path.$fileNameWithExt);

        if ($exists) {
            Storage::delete($path.$fileNameWithExt);
        }

        // Upload new file
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName.'.'.$extension;
//        storeAs('public/uploads', $file->getClientOriginalName())

        $path = $file->storeAs('public/uploads'.$path, $fileNameToStore);
//        $path = $file->move($path , $fileNameToStore);
        return $path;
    }
}

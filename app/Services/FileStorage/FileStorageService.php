<?php

namespace App\Services\FileStorage;

use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Support\Facades\File;

class FileStorageService implements FileStorageInterface
{

    public function storeFile($file, $directory): string
    {
        // TODO: Implement storeFile() method.
        return $file->storeAs($directory, $file->getClientOriginalName());

    }

    public function storeMultipleFiles($files, $directory): array
    {
        // TODO: Implement storeMultipleFiles() method.
        $paths = [];
        if ($files) {
            foreach ($files as $file) {
                $paths[] = $this->storeFile($file, $directory);
            }
        }
        return $paths;
    }

    public function getNextFolderCounter(): int
    {
        $counterFile = storage_path('app/public/uploads/folder_counter.txt');
        if (!File::exists($counterFile)) {
            File::put($counterFile, '0');
        }
        $counter = (int) File::get($counterFile);
        $counter++;
        File::put($counterFile, (string) $counter);
        return $counter;
    }
}

<?php

namespace App\Services\FileStorage\Interfaces;

interface FileStorageInterface
{
    public function storeFile($file, $directory): string;
    public function storeMultipleFiles($files, $directory): array;
    public function getNextFolderCounter(): int;

}

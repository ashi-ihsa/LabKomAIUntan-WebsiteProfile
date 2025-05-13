<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface KerjasamaService
{
    public function createKerjasama(UploadedFile $image, string $nama): void;
    public function getKerjasama(?string $search = null): array;
    public function findById(string $id): array;
    public function saveKerjasamaWithCleanup(string $id, ?string $newContent): string;
    public function updateKerjasama(
        string $id,
        ?UploadedFile $image,
        string $nama,
        ?string $content,
        bool $publish = false
    ): void;
    public function deleteKerjasama(string $id): void;
    public function setPublishStatus(string $id, bool $status): void;
}
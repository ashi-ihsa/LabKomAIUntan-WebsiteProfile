<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface DosenService
{
    public function createDosen(UploadedFile $image, string $nama, string $deskripsi): void;
    public function getDosen(): array;
    public function findById(string $id): array;
    public function saveDosenWithCleanup(string $id, string $newContent): string;
    public function updateDosen(string $id, ?UploadedFile $image, string $nama, string $deskripsi, string $content): void;
    public function deleteDosen(string $id): void;
}
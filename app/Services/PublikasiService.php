<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface PublikasiService
{
    public function createPublikasi(UploadedFile $image, string $nama, string $deskripsi, string $dosen_id, int $tahun): void;
    public function getPublikasi(): array;
    public function findById(string $id): array;
    public function savePublikasiWithCleanup(string $id, ?string $newContent): string;
    public function updatePublikasi(
        string $id,
        ?UploadedFile $image,
        string $nama,
        string $deskripsi,
        ?string $content,
        string $tahun,
        int $dosenId,
        bool $publish = false,
        bool $highlight = false
    ): void;
    public function deletePublikasi(string $id): void;
    public function setPublishStatus(string $id, bool $status): void;
    public function setHighlightStatus(string $id, bool $status): void;
}
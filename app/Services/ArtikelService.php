<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface ArtikelService
{
    public function createArtikel(UploadedFile $image, string $nama): void;
    public function getArtikel(): array;
    public function findById(string $id): array;
    public function saveArtikelWithCleanup(string $id, ?string $newContent): string;
    public function updateArtikel(
        string $id,
        ?UploadedFile $image,
        string $nama,
        ?string $content,
    ): void;
    public function deleteArtikel(string $id): void;
    public function setPublishStatus(string $id, bool $status): void;
    public function setHighlightStatus(string $id, bool $status): void;
}
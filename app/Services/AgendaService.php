<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface AgendaService
{
    public function createAgenda(UploadedFile $image, string $nama, string $deskripsi, \DateTime $tanggal): void;
    public function getAgenda(): array;
    public function findById(string $id): array;
    public function saveAgendaWithCleanup(string $id, ?string $newContent): string;
    public function updateAgenda(
        string $id,
        ?UploadedFile $image,
        string $nama,
        string $deskripsi,
        ?\DateTime $tanggal,
        ?string $content,
        bool $sudah_lewat = false
    ): void;
    public function deleteAgenda(string $id): void;
    public function setSudahLewatStatus(string $id, bool $status): void;
}
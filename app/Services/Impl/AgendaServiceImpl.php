<?php
namespace App\Services\Impl;

use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AgendaServiceImpl implements AgendaService
{
    private function extractImagePathsFromHtml(?string $html, string $id): array
    {   
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html ?: '<div></div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $paths = [];
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (str_starts_with($src, "/storage/Agenda/$id/")) {
                $paths[] = $src;
            }
        }

        return $paths;
    }

    public function createAgenda(UploadedFile $image, string $nama, string $deskripsi, \DateTime $tanggal): void
    {
        $agenda = Agenda::create([
            'nama' => $nama,
            'thumbnail' => null,
            'content' => null,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'sudah_lewat' => false
        ]);

        $extension = strtolower($image->getClientOriginalExtension());
        $filename = "thumbnail.$extension";
        $folder = "agenda/{$agenda->id}";
        $path = $image->storeAs($folder, $filename, 'public');

        $agenda->update([
            'thumbnail' => $path,
        ]);
    }

    public function getAgenda(): array
    {
        return Agenda::orderBy('tanggal','desc')
            ->get()
            ->toArray();
    }

    public function findById(string $id): array
    {
        return Agenda::findOrFail($id)->toArray();
    }

    public function saveAgendaWithCleanup(string $id, ?string $newContent): string
    {
        $agenda = Agenda::findOrFail($id);
        $oldContent = $agenda->content ?? '';

        $oldImages = $this->extractImagePathsFromHtml($oldContent, $id);
        $newImages = $this->extractImagePathsFromHtml($newContent, $id);
        $deletedImages = array_diff($oldImages, $newImages);

        foreach ($deletedImages as $src) {
            $pathInStorage = str_replace('/storage/', '', $src);
            if (Storage::disk('public')->exists($pathInStorage)) {
                Storage::disk('public')->delete($pathInStorage);
            }
        }

        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($newContent ?: '<div></div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        $today = date('Y-m-d');

        foreach ($images as $index => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = strtolower($type[1]);
                if (!in_array($imageType, ['png', 'jpg', 'jpeg', 'gif'])) continue;

                $data = base64_decode(substr($src, strpos($src, ',') + 1));
                $filename = time() . '_' . $index . '.' . $imageType;
                $folder = "agenda/$id/$today/";
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        $finalContent = $dom->saveHTML();
        $agenda->update(['content' => $finalContent]);

        return $finalContent;
    }

    public function updateAgenda(
        string $id,
        ?UploadedFile $image,
        string $nama,
        string $deskripsi,
        ?\DateTime $tanggal,
        ?string $content,
    ): void 
    {
        $agenda = Agenda::findOrFail($id);

        $data = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
        ];

        if ($tanggal) {
            $data['tanggal'] = $tanggal;
        }

        if ($content !== null) {
            $data['content'] = $this->saveAgendaWithCleanup($id, $content);
        }

        if ($image) {
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = "thumbnail.$extension";
            $folder = "agenda/$id";

            $files = Storage::disk('public')->files($folder);
            foreach ($files as $file) {
                if (preg_match('/thumbnail\.(jpg|jpeg|png|webp)$/i', $file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            $path = $image->storeAs($folder, $filename, 'public');
            $data['thumbnail'] = $path;
        }

        $agenda->update($data);
    }

    public function deleteAgenda(string $id): void
    {
        $agenda = Agenda::findOrFail($id);
        $folderPath = "agenda/$id";

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $agenda->delete();
    }

    // Opsional: Toggle publish
    public function setSudahLewatStatus(string $id, bool $status): void
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->update(['sudah_lewat' => $status]);
    }
}

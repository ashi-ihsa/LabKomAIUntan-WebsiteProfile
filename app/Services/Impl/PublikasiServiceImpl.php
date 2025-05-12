<?php
namespace App\Services\Impl;

use App\Models\Publikasi;
use App\Services\PublikasiService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PublikasiServiceImpl implements PublikasiService
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
            if (str_starts_with($src, "/storage/publikasi/$id/")) {
                $paths[] = $src;
            }
        }

        return $paths;
    }

    public function createPublikasi(
        UploadedFile $image,
        string $nama,
        string $deskripsi,
        string $tahun,
        int $dosen_id,
        bool $publish = false,
        bool $highlight = false
    ): void {
        // Buat record kosong terlebih dahulu
        $publikasi = Publikasi::create([
            'nama' => $nama,
            'thumbnail' => null,
            'deskripsi' => $deskripsi,
            'content' => null,
            'tahun' => $tahun,
            'dosen_id' => $dosen_id,
            'publish' => $publish,
            'highlight' => $highlight,
        ]);

        // Simpan thumbnail
        $extension = strtolower($image->getClientOriginalExtension());
        $filename = "thumbnail.$extension";
        $folder = "publikasi/{$publikasi->id}";
        $path = $image->storeAs($folder, $filename, 'public');

        // Update thumbnail path
        $publikasi->update([
            'thumbnail' => $path,
        ]);
    }

    public function getPublikasi(): array
    {
        return Publikasi::with('dosen')
        ->orderBy('tahun', 'desc')
        ->get()->map(function ($publikasi) {
            return [
                'id' => $publikasi->id,
                'nama' => $publikasi->nama,
                'thumbnail' => $publikasi->thumbnail,
                'deskripsi' => $publikasi->deskripsi,
                'content' => $publikasi->content,
                'tahun' => $publikasi->tahun,
                'dosen_id' => $publikasi->dosen_id,
                'dosen_nama' => $publikasi->dosen?->nama, // Gunakan null-safe operator
                'publish' => $publikasi->publish,
                'highlight' => $publikasi->highlight,
            ];
        })->toArray();
    }

    public function findById(string $id): array
    {
        $publikasi = Publikasi::with('dosen')->findOrFail($id);
        return [
            'id' => $publikasi->id,
            'nama' => $publikasi->nama,
            'thumbnail' => $publikasi->thumbnail,
            'deskripsi' => $publikasi->deskripsi,
            'content' => $publikasi->content,
            'tahun' => $publikasi->tahun,
            'dosen_id' => $publikasi->dosen_id,
            'dosen_nama' => $publikasi->dosen?->nama, // null-safe
            'publish' => $publikasi->publish,
            'highlight' => $publikasi->highlight,
        ];
    }

    public function savePublikasiWithCleanup(string $id, ?string $newContent): string
    {
        $publikasi = Publikasi::findOrFail($id);
        $oldContent = $publikasi->content ?? '';

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
                $folder = "publikasi/$id/$today/";
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        $finalContent = $dom->saveHTML();
        $publikasi->update(['content' => $finalContent]);

        return $finalContent;
    }

    public function updatePublikasi(string $id,?UploadedFile $image,string $nama,string $deskripsi,?string $content,string $tahun,int $dosenId): void 
    {
        $publikasi = Publikasi::findOrFail($id);

        $data = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'tahun' => $tahun,
            'dosen_id' => $dosenId,
            'content' => $this->savePublikasiWithCleanup($id, $content),
        ];

        if ($image) {
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = "thumbnail.$extension";
            $folder = "publikasi/$id";
            $imagePath = "$folder/$filename";

            $files = Storage::disk('public')->files($folder);
            foreach ($files as $file) {
                if (preg_match('/thumbnail\.(jpg|jpeg|png|webp)$/i', $file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            $path = $image->storeAs($folder, $filename, 'public');
            $data['thumbnail'] = $path;
        }

        $publikasi->update($data);
    }

    public function deletePublikasi(string $id): void
    {
        $publikasi = Publikasi::findOrFail($id);
        $folderPath = "publikasi/$id";

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $publikasi->delete();
    }

    // Opsional: Toggle publish
    public function setPublishStatus(string $id, bool $status): void
    {
        $publikasi = Publikasi::findOrFail($id);
        $publikasi->update(['publish' => $status]);
    }

    // Opsional: Toggle highlight
    public function setHighlightStatus(string $id, bool $status): void
    {
        $publikasi = Publikasi::findOrFail($id);
        $publikasi->update(['highlight' => $status]);
    }
}

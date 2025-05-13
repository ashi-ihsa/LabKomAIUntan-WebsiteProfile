<?php
namespace App\Services\Impl;

use App\Models\Artikel;
use App\Services\ArtikelService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArtikelServiceImpl implements ArtikelService
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
            if (str_starts_with($src, "/storage/Artikel/$id/")) {
                $paths[] = $src;
            }
        }

        return $paths;
    }

    public function createArtikel(UploadedFile $image,string $nama): void 
    {
        // Buat record kosong terlebih dahulu
        $artikel = Artikel::create([
            'nama' => $nama,
            'thumbnail' => null,
            'content' => null,
        ]);

        // Simpan thumbnail
        $extension = strtolower($image->getClientOriginalExtension());
        $filename = "thumbnail.$extension";
        $folder = "artikel/{$artikel->id}";
        $path = $image->storeAs($folder, $filename, 'public');

        // Update thumbnail path
        $artikel->update([
            'thumbnail' => $path,
        ]);
    }

    public function getArtikel(?string $search = null): array
    {
        $query = Artikel::orderBy('created_at', 'desc');

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        return $query->get()->toArray();
    }
    
    public function findById(string $id): array
    {
        return Artikel::findOrFail($id)->toArray();
    }

    public function saveArtikelWithCleanup(string $id, ?string $newContent): string
    {
        $artikel = Artikel::findOrFail($id);
        $oldContent = $artikel->content ?? '';

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
                $folder = "artikel/$id/$today/";
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        $finalContent = $dom->saveHTML();
        $artikel->update(['content' => $finalContent]);

        return $finalContent;
    }

    public function updateArtikel(
        string $id,
        ?UploadedFile $image,
        string $nama,
        ?string $content,
    ): void 
    {
        $artikel = Artikel::findOrFail($id);

        $data = [
            'nama' => $nama,
            'content' => $this->saveArtikelWithCleanup($id, $content),
        ];

        if ($image) {
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = "thumbnail.$extension";
            $folder = "artikel/$id";
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

        $artikel->update($data);
    }

    public function deleteArtikel(string $id): void
    {
        $artikel = Artikel::findOrFail($id);
        $folderPath = "artikel/$id";

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $artikel->delete();
    }

    // Opsional: Toggle publish
    public function setPublishStatus(string $id, bool $status): void
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->update(['publish' => $status]);
    }

    // Opsional: Toggle highlight
    public function setHighlightStatus(string $id, bool $status): void
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->update(['highlight' => $status]);
    }
}

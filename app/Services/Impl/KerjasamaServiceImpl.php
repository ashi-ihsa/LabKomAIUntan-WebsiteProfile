<?php
namespace App\Services\Impl;

use App\Models\Kerjasama;
use App\Services\KerjasamaService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class KerjasamaServiceImpl implements KerjasamaService
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
            if (str_starts_with($src, "/storage/kerjasama/$id/")) {
                $paths[] = $src;
            }
        }

        return $paths;
    }

    public function createKerjasama(UploadedFile $image,string $nama): void 
    {
        // Buat record kosong terlebih dahulu
        $kerjasama = Kerjasama::create([
            'nama' => $nama,
            'thumbnail' => null,
            'content' => null,
        ]);

        // Simpan thumbnail
        $extension = strtolower($image->getClientOriginalExtension());
        $filename = "thumbnail.$extension";
        $folder = "kerjasama/{$kerjasama->id}";
        $path = $image->storeAs($folder, $filename, 'public');

        // Update thumbnail path
        $kerjasama->update([
            'thumbnail' => $path,
        ]);
    }

    public function getKerjasama(?string $search = null): array
    {
        $query = Kerjasama::orderBy('created_at', 'desc');

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        return $query->get()->toArray();
    }


    public function findById(string $id): array
    {
        return Kerjasama::findOrFail($id)->toArray();
    }

    public function saveKerjasamaWithCleanup(string $id, ?string $newContent): string
    {
        $kerjasama = Kerjasama::findOrFail($id);
        $oldContent = $kerjasama->content ?? '';

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
                $folder = "kerjasama/$id/$today/";
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        $finalContent = $dom->saveHTML();
        $kerjasama->update(['content' => $finalContent]);

        return $finalContent;
    }

    public function updateKerjasama(
        string $id,
        ?UploadedFile $image,
        string $nama,
        ?string $content,
        bool $publish = false
    ): void {
        $kerjasama = Kerjasama::findOrFail($id);

        $data = [
            'nama' => $nama,
            'publish' => $publish,
            'content' => $this->saveKerjasamaWithCleanup($id, $content),
        ];

        if ($image) {
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = "thumbnail.$extension";
            $folder = "kerjasama/$id";
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

        $kerjasama->update($data);
    }

    public function deleteKerjasama(string $id): void
    {
        $kerjasama = Kerjasama::findOrFail($id);
        $folderPath = "kerjasama/$id";

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $kerjasama->delete();
    }

    // Opsional: Toggle publish
    public function setPublishStatus(string $id, bool $status): void
    {
        $kerjasama = Kerjasama::findOrFail($id);
        $kerjasama->update(['publish' => $status]);
    }
}

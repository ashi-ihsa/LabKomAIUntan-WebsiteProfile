<?php
namespace App\Services\Impl;

use App\Models\Dosen;
use App\Services\DosenService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DosenServiceImpl implements DosenService
{
    private function extractImagePathsFromHtmlDosen(string $html, string $id): array
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $paths = [];
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (str_starts_with($src, "/storage/dosen/$id/")) {
                $paths[] = $src;
            }
        }

        return $paths;
    }

    public function createDosen(UploadedFile $image, string $nama, string $deskripsi): void
    {
        // Buat record terlebih dahulu untuk dapatkan ID
        $dosen = Dosen::create([
            'nama' => $nama,
            'image' => null, // sementara kosong
            'deskripsi' => $deskripsi,
            'content' => null,
        ]);
    
        // Ambil ekstensi asli dan buat nama file
        $extension = strtolower($image->getClientOriginalExtension());
        $filename = "thumbnail.$extension";
        $folder = "dosen/{$dosen->id}";
        $imagePath = "$folder/$filename";
    
        // Simpan gambar ke folder dosen/{id}
        $path = $image->storeAs($folder, $filename, 'public');
    
        // Update path gambar ke record yang tadi dibuat
        $dosen->update([
            'image' => $path,
        ]);
    }
    

    public function getDosen(): array
    {
        return Dosen::all()->toArray();
    }

    public function findById(string $id): array
    {
        return Dosen::findOrFail($id)->toArray();
    }

    public function saveDosenWithCleanup(string $id, string $newContent): string
    {
        $dosen = Dosen::findOrFail($id);
        $oldContent = $dosen->content ?? '';

        $oldImages = $this->extractImagePathsFromHtmlDosen($oldContent, $id);
        $newImages = $this->extractImagePathsFromHtmlDosen($newContent, $id);

        $deletedImages = array_diff($oldImages, $newImages);
        foreach ($deletedImages as $src) {
            $pathInStorage = str_replace('/storage/', '', $src); // "dosen/{id}/..."
            if (Storage::disk('public')->exists($pathInStorage)) {
                Storage::disk('public')->delete($pathInStorage);
            }
        }

        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($newContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        $today = date('Y-m-d');

        foreach ($images as $index => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = strtolower($type[1]);
                if (!in_array($imageType, ['png', 'jpg', 'jpeg', 'gif'])) continue;

                $data = base64_decode(substr($src, strpos($src, ',') + 1));
                $filename = time() . '_' . $index . '.' . $imageType;
                $folder = "dosen/$id/$today/";
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        $finalContent = $dom->saveHTML();
        $dosen->update(['content' => $finalContent]);

        return $finalContent;
    }

    public function updateDosen(string $id, ?UploadedFile $image, string $nama, string $deskripsi, string $content): void
    {
        $dosen = Dosen::findOrFail($id);

        $data = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'content' => $this->saveDosenWithCleanup($id, $content),
        ];

        if ($image) {
            // Ambil ekstensi asli dan konversi ke lowercase
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = "thumbnail.$extension";
            $folder = "dosen/$id";
            $imagePath = "$folder/$filename";

            Log::info("Preparing to store image at: $imagePath");

            // Hapus semua file lama thumbnail.* di folder ini
            $files = Storage::disk('public')->files($folder);
            foreach ($files as $file) {
                if (preg_match('/thumbnail\.(jpg|jpeg|png|webp)$/i', $file)) {
                    Log::info("Deleting old thumbnail: $file");
                    Storage::disk('public')->delete($file);
                }
            }

            // Simpan gambar baru
            $path = $image->storeAs($folder, $filename, 'public');
            Log::info("Image stored at: $path");
            $data['image'] = $path;
        }

        $dosen->update($data);
        Log::info("Dosen updated with data:", $data);
    }

    public function deleteDosen(string $id): void
    {
        $dosen = Dosen::findOrFail($id);

        if ($dosen->image) {
            Storage::disk('public')->delete($dosen->image);
        }

        $dosen->delete();
    }
}
<?php
namespace App\Services\Impl;

use App\Models\Tentang;
use App\Services\TentangService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TentangServiceImpl implements TentangService
{
    private function extractImagePathsFromHtml(string $html): array
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $paths = [];
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (str_starts_with($src, '/storage/tentang/')) {
                $paths[] = $src;
            }
        }

        return $paths;
    }
    function showTentang(): string
    {
        $tentang = Tentang::first();
        return $tentang?->content;
    }
    public function saveTentangWithCleanup(string $newContent): void
    {
        // Ambil konten lama dari database
        $oldContent = $this->showTentang();

        // Ambil daftar gambar dari konten lama & baru
        $oldImages = $this->extractImagePathsFromHtml($oldContent);
        $newImages = $this->extractImagePathsFromHtml($newContent);

        // Hapus gambar yang tidak digunakan lagi (di storage)
        $deletedImages = array_diff($oldImages, $newImages);
        foreach ($deletedImages as $src) {
            // Hanya proses file dari /storage/tentang
            if (str_starts_with($src, '/storage/tentang')) {
                $pathInStorage = str_replace('/storage/', '', $src); // "tentang/..."
                if (Storage::disk('public')->exists($pathInStorage)) {
                    Storage::disk('public')->delete($pathInStorage);
                }
            }
        }

        // Proses gambar base64 dan ganti dengan path yang disimpan
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($newContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $index => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = strtolower($type[1]);
                if (!in_array($imageType, ['png', 'jpg', 'jpeg', 'gif'])) continue;

                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);

                $folder = 'tentang/' . date('Y-m-d') . '/';
                $filename = time() . '_' . $index . '.' . $imageType;
                $fullPath = $folder . $filename;

                Storage::disk('public')->put($fullPath, $data);

                // Set src to public URL via /storage
                $image->setAttribute('src', Storage::url($fullPath));
            }
        }

        // Simpan konten baru
        $finalContent = $dom->saveHTML();
        DB::table('tentang')->update(['content' => $finalContent]);
}

}

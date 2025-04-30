<?php

namespace App\Http\Controllers;

use App\Services\TentangService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TentangController extends Controller
{
    protected TentangService $tentangService;
    public function __construct(TentangService $tentangService)
    {
        $this->tentangService = $tentangService;
    }

    public function index(Request $request): Response
    {
        $tentang = $this->tentangService->showTentang();
        return response()
        -> view("admin.tentang",[
            "title" => "Tentang",
            "content" => $tentang
        ]);
    }

    public function saveTentang(Request $request): RedirectResponse
    {
        $content = $request->content;

        $dom = new \DomDocument();
        libxml_use_internal_errors(true); // Untuk menghindari error parsing HTML
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
        $images = $dom->getElementsByTagName('img');
    
        foreach ($images as $index => $image) {
            $src = $image->getAttribute('src');
    
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                // Ambil tipe file
                $imageType = strtolower($type[1]); // jpg, png, etc.
    
                // Ambil data base64
                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);
    
                // Simpan gambar
                $imageName = '/upload/tentang/' . time() . $index . '.' . $imageType;
                $path = public_path($imageName);
                file_put_contents($path, $data);
    
                // Ganti src di HTML
                $image->removeAttribute('src');
                $image->setAttribute('src', $imageName);
            }
        }
    
        $content = $dom->saveHTML();
    
        // Simpan ke database via service
        $this->tentangService->saveTentang($content);
    
        return redirect()->action([TentangController::class, 'index']);
    }
}

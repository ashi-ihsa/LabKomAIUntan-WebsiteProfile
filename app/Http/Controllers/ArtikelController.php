<?php

namespace App\Http\Controllers;

use App\Services\ArtikelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtikelController extends Controller
{
    protected ArtikelService $artikelService;
    public function __construct(ArtikelService $artikelService)
    {
        $this->artikelService = $artikelService;
    }

   public function index(Request $request): Response
    {
        $search = $request->input('search');
        $artikelData = $this->artikelService->getArtikel($search);

        return response()->view('admin.artikel', [
            'title' => 'Manajemen Artikel',
            'artikelData' => $artikelData
        ]);
    }


    public function createArtikel(Request $request): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $image = $request->file('image');

        if (empty($nama) || empty('image')) {
            $artikelData = $this->artikelService->getArtikel();
            return response()->view('admin.artikel', [
                'title' => 'Manajemen Artikel',
                'artikelData' => $artikelData,
                'error' => 'Semua Data wajib diisi.'
            ]);
        }

        $this->artikelService->createArtikel(
            image: $image,
            nama: $nama,
        );

        return redirect()->action([ArtikelController::class, 'index']);
    }

    public function editArtikelById(Request $request, string $id): Response
    {
        $artikelData = $this->artikelService->findById($id);
        return response()->view('admin.artikel_edit', [
            'title' => 'Edit Artikel',
            'artikelData' => $artikelData
        ]);
    }

    public function updateArtikel(Request $request, string $id): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $content = $request->input('content');
        $image = $request->file('image');

        if (empty($nama) ) {
            return back()->with('error', 'Semua Data Wajib Terisi');
        }

        $this->artikelService->updateArtikel(
            id: $id,
            image: $image,
            nama: $nama,
            content: $content
        );
        return redirect()->action([ArtikelController::class, 'index']);
    }

    public function deleteArtikel(Request $request, string $id): RedirectResponse
    {
        $this->artikelService->deleteArtikel($id);
        return redirect()->action([ArtikelController::class, 'index']);
    }

    public function setPublishStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->artikelService->setPublishStatus($id, $status);
        return redirect()->back();
    }

    public function setHighlightStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->artikelService->setHighlightStatus($id, $status);
        return redirect()->back();
    }
}

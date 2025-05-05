<?php

namespace App\Http\Controllers;

use App\Services\KerjasamaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KerjasamaController extends Controller
{
    protected KerjasamaService $kerjasamaService;
    public function __construct(KerjasamaService $kerjasamaService)
    {
        $this->kerjasamaService = $kerjasamaService;
    }

    public function index(Request $request): Response
    {
        $kerjasamaData = $this->kerjasamaService->getKerjasama();
        return response()->view('admin.kerjasama', [
            'title' => 'Manajemen Kerjasama',
            'kerjasamaData' => $kerjasamaData
        ]);
    }

    public function createKerjasama(Request $request): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $image = $request->file('image');

        if (empty($nama) || empty('image')) {
            $kerjasamaData = $this->kerjasamaService->getKerjasama();
            return response()->view('admin.kerjasama', [
                'title' => 'Manajemen Kerjasama',
                'kerjasamaData' => $kerjasamaData,
                'error' => 'Semua Data wajib diisi.'
            ]);
        }

        $this->kerjasamaService->createKerjasama(
            image: $image,
            nama: $nama,
        );

        return redirect()->action([KerjasamaController::class, 'index']);
    }

    public function editKerjasamaById(Request $request, string $id): Response
    {
        $kerjasamaData = $this->kerjasamaService->findById($id);
        return response()->view('admin.kerjasama_edit', [
            'title' => 'Edit Kerjasama',
            'kerjasamaData' => $kerjasamaData
        ]);
    }

    public function updateKerjasama(Request $request, string $id): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $content = $request->input('content');
        $image = $request->file('image');

        if (empty($nama) ) {
            return back()->with('error', 'Semua Data Wajib Terisi');
        }

        $this->kerjasamaService->updateKerjasama(
            id: $id,
            image: $image,
            nama: $nama,
            content: $content
        );
        return redirect()->action([KerjasamaController::class, 'index']);
    }

    public function deleteKerjasama(Request $request, string $id): RedirectResponse
    {
        $this->kerjasamaService->deleteKerjasama($id);
        return redirect()->action([KerjasamaController::class, 'index']);
    }

    public function setPublishStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->kerjasamaService->setPublishStatus($id, $status);
        return redirect()->back();
    }
}

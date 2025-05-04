<?php

namespace App\Http\Controllers;

use App\Services\DosenService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class DosenController extends Controller
{
    protected DosenService $dosenService;
    public function __construct(DosenService $dosenService)
    {
        $this->dosenService = $dosenService;
    }

    public function index(Request $request): Response
    {
        $dosenData = $this->dosenService->getDosen();
        return response()->view('admin.dosen', [
            'title' => 'Manajemen Dosen',
            'dosenData' => $dosenData
        ]);
    }

    public function createDosen(Request $request): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $image = $request->file('image'); // base64 image string

        if (empty($nama)) {
            $dosenData = $this->dosenService->getDosen();
            return response()->view('admin.dosen', [
                'title' => 'Manajemen Dosen',
                'dosenData' => $dosenData,
                'error' => 'Nama dosen wajib diisi'
            ]);
        }

        $this->dosenService->createDosen($image, $nama, $deskripsi);
        return redirect()->action([DosenController::class, 'index']);
    }

    public function editDosenById(Request $request, string $id): Response
    {
        $dosen = $this->dosenService->findById($id);
        return response()->view('admin.dosen_edit', [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ]);
    }

    public function updateDosen(Request $request, string $id): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $content = $request->input('content');
        $image = $request->file('image'); // bisa base64 baru atau kosong

        if (empty($nama)) {
            return back()->with([
                'error' => 'Nama dosen tidak boleh kosong'
            ]);
        }

        $this->dosenService->updateDosen($id, $image, $nama, $deskripsi, $content);
        return redirect()->action([DosenController::class, 'index']);
    }

    public function deleteDosen(Request $request, string $id): RedirectResponse
    {
        $this->dosenService->deleteDosen($id);
        return redirect()->action([DosenController::class, 'index']);
    }
}

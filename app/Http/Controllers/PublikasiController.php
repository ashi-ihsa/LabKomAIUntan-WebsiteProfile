<?php

namespace App\Http\Controllers;

use App\Services\DosenService;
use App\Services\PublikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublikasiController extends Controller
{
    protected DosenService $dosenService;
    protected PublikasiService $publikasiService;
    public function __construct(DosenService $dosenService, PublikasiService $publikasiService)
    {
        $this->dosenService = $dosenService;
        $this->publikasiService = $publikasiService;
    }

    public function index(Request $request): Response
    {
        $dosenData = $this->dosenService->getDosenOnlyIdAndName();
        $publikasiData = $this->publikasiService->getPublikasi();
        return response()->view('admin.publikasi', [
            'title' => 'Manajemen Publikasi',
            'dosenData' => $dosenData,
            'publikasiData' => $publikasiData
        ]);
    }

    public function createPublikasi(Request $request): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $dosen_id = $request->input('dosen_id');
        $tahun = $request->input('tahun');
        $image = $request->file('image');

        if (empty($nama) || empty($deskripsi) || empty($dosen_id) || empty($tahun) || empty('image')) {
            $dosenData = $this->dosenService->getDosenOnlyIdAndName();
            $publikasiData = $this->publikasiService->getPublikasi();
            return response()->view('admin.publikasi', [
                'title' => 'Manajemen Publikasi',
                'dosenData' => $dosenData,
                'publikasiData' => $publikasiData,
                'error' => 'Semua Data wajib diisi.'
            ]);
        }

        $this->publikasiService->createPublikasi(
            image: $image,
            nama: $nama,
            deskripsi: $deskripsi,
            dosen_id: $dosen_id,
            tahun: $tahun,
        );

        return redirect()->action([PublikasiController::class, 'index']);
    }

    public function editPublikasiById(Request $request, string $id): Response
    {
        $dosenData = $this->dosenService->getDosenOnlyIdAndName();
        $publikasiData = $this->publikasiService->findById($id);
        return response()->view('admin.publikasi_edit', [
            'title' => 'Edit Publikasi',
            'dosenData' => $dosenData,
            'publikasiData' => $publikasiData
        ]);
    }

    public function updatePublikasi(Request $request, string $id): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $content = $request->input('content');
        $image = $request->file('image');
        $dosen_id = $request->input('dosen_id');
        $tahun = $request->input('tahun');

        if (empty($nama) || empty($deskripsi) || empty($dosen_id) || empty($tahun)) {
            return back()->with('error', 'Semua Data Wajib Terisi');
        }

        $this->publikasiService->updatePublikasi(
            id: $id,
            image: $image,
            nama: $nama,
            deskripsi: $deskripsi,
            content: $content,
            dosenId: $dosen_id,
            tahun: $tahun,
        );
        return redirect()->action([PublikasiController::class, 'index']);
    }

    public function deletePublikasi(Request $request, string $id): RedirectResponse
    {
        $this->publikasiService->deletePublikasi($id);
        return redirect()->action([PublikasiController::class, 'index']);
    }

    public function setPublishStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->publikasiService->setPublishStatus($id, $status);
        return redirect()->back();
    }

    public function setHighlightStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->publikasiService->setHighlightStatus($id, $status);
        return redirect()->back();
    }
}

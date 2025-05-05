<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use App\Services\ArtikelService;
use App\Services\DosenService;
use App\Services\KerjasamaService;
use App\Services\PublikasiService;
use App\Services\TentangService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebsiteProfileController extends Controller
{
    protected DosenService $dosenService;
    protected PublikasiService $publikasiService;
    protected ArtikelService $artikelService;
    protected AgendaService $agendaService;
    protected KerjasamaService $kerjasamaService;
    protected TentangService $tentangService;

    public function __construct(
        DosenService $dosenService,
        PublikasiService $publikasiService,
        ArtikelService $artikelService,
        AgendaService $agendaService,
        KerjasamaService $kerjasamaService,
        TentangService $tentangService,
    )
    {
        $this->dosenService = $dosenService;
        $this->publikasiService = $publikasiService;
        $this->artikelService = $artikelService;
        $this->agendaService = $agendaService;
        $this->kerjasamaService = $kerjasamaService;
        $this->tentangService = $tentangService;
    }
    /* ==== Beranda ==== */
    public function index(Request $request): Response
    {
        $dosenData = $this->dosenService->getDosen();
        return response()->view('webProfile.dosen', [
            'dosenData' => $dosenData
        ]);
    }
    public function showDosenById(Request $request, string $id): Response
    {
        $dosenData = $this->dosenService->findById($id);
        return response()->view('webProfile.dosen_show', [
            'dosenData' => $dosenData
        ]);
    }
    /* ==== Publikasi ==== */
    public function indexPublikasi(Request $request): Response
    {
        $publikasiData = $this->publikasiService->getPublikasi();
        return response()->view('webProfile.publikasi', [
            'publikasiData' => $publikasiData
        ]);
    }
    public function showPublikasiById(Request $request, string $id): Response
    {
        $publikasiData = $this->publikasiService->findById($id);
        return response()->view('webProfile.publikasi_show', [
            'publikasiData' => $publikasiData
        ]);
    }
    /* ==== Artikel ==== */
    public function indexArtikel(Request $request): Response
    {
        $artikelData = $this->artikelService->getArtikel();
        return response()->view('webProfile.artikel', [
            'artikelData' => $artikelData
        ]);
    }
    public function showArtikelById(Request $request, string $id): Response
    {
        $artikelData = $this->artikelService->findById($id);
        return response()->view('webProfile.artikel_show', [
            'artikelData' => $artikelData
        ]);
    }
    /* ==== Agenda ==== */
    public function indexAgenda(Request $request): Response
    {
        $agendaData = $this->agendaService->getAgenda();
        return response()->view('webProfile.agenda', [
            'agendaData' => $agendaData
        ]);
    }
    public function showAgendaById(Request $request, string $id): Response
    {
        $agendaData = $this->agendaService->findById($id);
        return response()->view('webProfile.agenda_show', [
            'agendaData' => $agendaData
        ]);
    }
    /* ==== Kerjasama ==== */
    public function indexKerjasama(Request $request): Response
    {
        $kerjasamaData = $this->kerjasamaService->getKerjasama();
        return response()->view('webProfile.kerjasama', [
            'kerjasamaData' => $kerjasamaData
        ]);
    }
    public function showKerjasamaById(Request $request, string $id): Response
    {
        $kerjasamaData = $this->kerjasamaService->findById($id);
        return response()->view('webProfile.kerjasama_show', [
            'kerjasamaData' => $kerjasamaData
        ]);
    }
    /* ==== Tentang ==== */
    public function indexTentang(Request $request): Response
    {
        $tentangData = $this->tentangService->showTentang();
        return response()->view('webProfile.tentang', [
            'tentangData' => $tentangData
        ]);
    }
}

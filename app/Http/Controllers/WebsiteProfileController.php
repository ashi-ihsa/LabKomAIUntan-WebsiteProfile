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
use Illuminate\Pagination\LengthAwarePaginator;

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
        $search = strtolower(trim($request->input('search', '')));
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Ambil semua data
        $allPublikasi = collect($this->publikasiService->getPublikasi());

        // 1. Ambil data highlight secara terpisah, selalu ditampilkan
        $highlightPublikasi = $allPublikasi->where('highlight', true)->values();

        // 2. Filter list publikasi (non-highlight) sesuai pencarian
        $listPublikasi = $allPublikasi->where('highlight', '!=', true);

        if ($search !== '') {
            $listPublikasi = $listPublikasi->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama']),        $search) ||
                    str_contains(strtolower($item['dosen_nama']),  $search) ||
                    str_contains((string) $item['tahun'],          $search);
            });
        }

        // 3. Paginate list publikasi
        $paginated = new LengthAwarePaginator(
            $listPublikasi->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $listPublikasi->count(),
            $perPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return response()->view('webProfile.publikasi.index', [
            'publikasiData' => $paginated,
            'highlightData' => $highlightPublikasi,
        ]);
    }
    public function showPublikasiById(Request $request, string $id): Response
    {
        $publikasiData = $this->publikasiService->findById($id);
        return response()->view('webProfile.publikasi.show', [
            'publikasiData' => $publikasiData
        ]);
    }
    /* ==== Artikel ==== */
    public function indexArtikel(Request $request): Response
    {
        $search = strtolower(trim($request->input('search', '')));
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Ambil semua artikel
        $allArtikel = collect($this->artikelService->getArtikel());

        $highlightArtikel = $allArtikel->where('highlight', true)->values();

        // Filter berdasarkan judul saja
        if ($search !== '') {
            $allArtikel = $allArtikel->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama']), $search);
            });
        }

        // Paginate hasil filter
        $paginated = new LengthAwarePaginator(
            $allArtikel->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $allArtikel->count(),
            $perPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return response()->view('webProfile.artikel.index', [
            'artikelData' => $paginated,
            'highlightData' => $highlightArtikel,
        ]);
    }

    public function showArtikelById(Request $request, string $id): Response
    {
        $artikelData = $this->artikelService->findById($id);
        return response()->view('webProfile.artikel.show', [
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

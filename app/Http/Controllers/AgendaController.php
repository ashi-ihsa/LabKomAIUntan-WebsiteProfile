<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgendaController extends Controller
{
    protected AgendaService $agendaService;
    public function __construct(AgendaService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    public function index(Request $request): Response
    {
        $agendaData = $this->agendaService->getAgenda();
        return response()->view('admin.Agenda', [
            'title' => 'Manajemen Agenda',
            'agendaData' => $agendaData
        ]);
    }

    public function createAgenda(Request $request): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $image = $request->file('image');
        $deskripsi = $request->input('deskripsi');
        $tanggal = Carbon::parse($request->input('tanggal'));

        if (empty($nama) || empty('image') || empty($deskripsi)|| empty($tanggal)) {
            $agendaData = $this->agendaService->getAgenda();
            return response()->view('admin.Agenda', [
                'title' => 'Manajemen Agenda',
                'agendaData' => $agendaData,
                'error' => 'Semua Data wajib diisi.'
            ]);
        }

        $this->agendaService->createAgenda(
            image: $image,
            nama: $nama,
            deskripsi:$deskripsi,
            tanggal:$tanggal
        );

        return redirect()->action([AgendaController::class, 'index']);
    }

    public function editAgendaById(Request $request, string $id): Response
    {
        $agendaData = $this->agendaService->findById($id);
        return response()->view('admin.Agenda_edit', [
            'title' => 'Edit Agenda',
            'agendaData' => $agendaData
        ]);
    }

    public function updateAgenda(Request $request, string $id): RedirectResponse|Response
    {
        $nama = $request->input('nama');
        $content = $request->input('content');
        $image = $request->file('image');
        $deskripsi = $request->input('deskripsi');
        $tanggal = Carbon::parse($request->input('tanggal'));

        if (empty($nama) ) {
            return back()->with('error', 'Semua Data Wajib Terisi');
        }

        $this->agendaService->updateAgenda(
            id: $id,
            image: $image,
            nama: $nama,
            content: $content,
            deskripsi:$deskripsi,
            tanggal:$tanggal
        );
        return redirect()->action([AgendaController::class, 'index']);
    }

    public function deleteAgenda(Request $request, string $id): RedirectResponse
    {
        $this->agendaService->deleteAgenda($id);
        return redirect()->action([AgendaController::class, 'index']);
    }

    public function setSudahLewatStatus($id, Request $request)
    {
        $status = filter_var($request->query('status'), FILTER_VALIDATE_BOOLEAN);
        $this->agendaService->setSudahLewatStatus($id, $status);
        return redirect()->back();
    }
}

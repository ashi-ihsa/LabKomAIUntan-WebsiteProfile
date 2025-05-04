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
        $this->tentangService->saveTentangWithCleanup($request->content);

        return redirect()->action([TentangController::class, 'index']);
    }
}

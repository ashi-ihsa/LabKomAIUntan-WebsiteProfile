<?php
namespace App\Services\Impl;

use App\Models\Tentang;
use App\Services\TentangService;
use Illuminate\Support\Facades\DB;

class TentangServiceImpl implements TentangService
{
    function showTentang(): string
    {
        $tentang = Tentang::first();
        return $tentang?->content;
    }
    function saveTentang(string $content): void
    {
        DB::table('tentang')->update(['content' => $content]);
    }
}

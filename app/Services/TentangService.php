<?php
namespace App\Services;

interface TentangService
{
    function showTentang(): ?string;
    public function saveTentangWithCleanup(string $newContent): void;
}
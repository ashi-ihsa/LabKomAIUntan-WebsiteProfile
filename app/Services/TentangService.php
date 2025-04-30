<?php
namespace App\Services;

interface TentangService
{
    function showTentang(): ?string;
    function saveTentang(string $content): void;
}
<?php
namespace App\Services;

interface TagService
{
    function createTag (string $name): void;
    function getTag();
    function updateTag(string $id, string $name): void;
    function deleteTag(string $id): void;
}
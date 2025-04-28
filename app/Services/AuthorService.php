<?php
namespace App\Services;

interface AuthorService
{
    function createAuthor(string $email, string $name, string $password): void;
    function getAuthor(): array;
    function updateAuthor(string $id,string $email, string $name, string $password): void;
    function deleteAuthor(string $id): void;
}
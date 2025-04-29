<?php
namespace App\Services\Impl;

use App\Models\User;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Hash;

class AuthorServiceImpl implements AuthorService
{
    function createAuthor(string $email, string $name, string $password): void
    {
        User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'role' => 'author'
        ]);
    }
    function getAuthor(): array
    {
        return User::query()
        ->where('role', 'author')
        ->get(['id','email', 'name', 'password']) // hanya ambil kolom email, name, password
        ->toArray();
    }
    function updateAuthor(string $id,string $email, string $name, ?string $password): void
    {
        $author = User::query()
            ->where('id', $id)
            ->where('role', 'author')
            ->firstOrFail(); // cari author, kalau tidak ketemu 404

        $author->name = $name;
        $author->email = $email;
    
        if (!empty($password)) {
            $author->password = Hash::make($password);
        }
    
        $author->save();
    }
    function deleteAuthor(string $id): void
    {
        $author = User::query()
            ->where('id', $id)
            ->where('role', 'author')
            ->firstOrFail();
        $author->delete();
    }
    function findById(string $id): array
    {
        return User::query()
            ->where('id', $id)
            ->where('role', 'author')
            ->firstOrFail()->toArray();
    }
}
<?php
namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{
    // public function register(string $name, string $email, string $password, string $role): bool
    // {
    //     if (!in_array($role, ['admin', 'author'])) {
    //         return false; // Role tidak valid
    //     }

    //     if ($role === 'admin' && User::where('role', 'admin')->exists()) {
    //         return false; // Hanya boleh ada satu admin
    //     }

    //     User::create([
    //         'name' => $name,
    //         'email' => $email,
    //         'password' => bcrypt($password),
    //         'role' => $role, // Tentukan role yang dipilih
    //     ]);

    //     return true;
    // }

    public function login (string $name, string $password, string $role): bool
    {
        if (Auth::attempt(['email' => $name, 'password' => $password])) {
            $user = Auth::user();

            if ($user->role === $role) {
                return true; 
            }
            return false;
        }
        return false;
    }
}
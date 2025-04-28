<?php
namespace App\Services;

interface UserService
{
    // function register(string $name, string $email, string $password, string $role):bool;
    function login(string $name, string $password, string $role): bool;
}
<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login() : Response 
    {
        return response()
        -> view("user.login",[
            "title" => "Login"
        ]);    
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input("user");
        $password = $request->input("password");
        $role = $request->input("role"); // Mendapatkan role dari form

        // Validasi input
        if (empty($user) || empty($password) || empty($role)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "Email, Password, and Role are required"
            ]);
        }

        if ($this->userService->login($user, $password, $role)) {
            request()->session()->put("user", $user);
            request()->session()->put("role", $role);

            if ($role === 'admin') {
                return redirect('/admin/dosen');
            } elseif ($role === 'author') {
                return redirect('/author/artikel');
            }
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Invalid Email, Password, or Role"
        ]);
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget(["user", "role"]);
        return redirect('/login');
    }
}

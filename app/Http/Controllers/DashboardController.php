<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(Request $request): RedirectResponse
    {
        if ($request->session()->exists('user')) {
            $role = $request->session()->get('role');
            if ($role === 'admin') {
                return redirect('/admin/author');
            } elseif ($role === 'author') {
                return redirect('/author');
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }
}

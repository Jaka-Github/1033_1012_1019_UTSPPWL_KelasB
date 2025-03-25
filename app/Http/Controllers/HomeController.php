<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Cek apakah user memiliki role 'User'
        if (auth()->user()->hasRole('User')) {
            // Jika iya, arahkan ke borrow.index
            return redirect()->route('borrow.index');
        }

        // Jika bukan role 'user', tampilkan halaman home default
        return view('home');
    }
}

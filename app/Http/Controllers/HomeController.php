<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $title = "Login";
        return view('home', compact('title'));
    }

    public function auth()
    {
        $title = "Dashboard";

        if (Auth::check()) {
            $now = new DateTime();
            $now->modify('-1 day');

            $agenda_baru = Agenda::with('users')
                ->where('tanggal', '>', $now)
                ->orderBy('updated_at', 'DESC')
                ->get();

            return view('home', compact('title', 'agenda_baru'));
        }
        return view('auth.login', compact('title'));
    }
}

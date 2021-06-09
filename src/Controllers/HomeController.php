<?php

namespace AporteWeb\Dashboard\Controllers;

use Illuminate\Http\Request;

class HomeController extends \AporteWeb\Dashboard\Controllers\Controller
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
        return view('Dashboard::admin.home', [
            '__admin_active' => 'admin.home'
        ]);
    }
    public function home()
    {
        return redirect()->route('home');
    }
}

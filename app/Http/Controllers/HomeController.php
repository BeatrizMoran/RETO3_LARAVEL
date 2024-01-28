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
        return view('home');
    }

    public function modoClaroOscuro()
    {
        // Obtiene el estado actual del modo oscuro del usuario (podría ser almacenado en la sesión)
        $darkMode = session('dark_mode', false);

        // Cambia el estado del modo oscuro
        session(['dark_mode' => !$darkMode]);

        return response()->json(['success' => true]);
    }


}

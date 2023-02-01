<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        $productos= Producto::all()->where('activo','=',1);
        $cant_productos=count($productos);
        return view('home',compact('cant_productos'));
    }
    public function perfil()
    {
        return view('perfil');
    }
}

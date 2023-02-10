<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if(session()->has('gestion_id')){

        }else{
        session(['gestion_id'=>-1]);
        }
        return view('home',compact('cant_productos'));
    }
    public function perfil()
    {
        return view('perfil');
    }
}

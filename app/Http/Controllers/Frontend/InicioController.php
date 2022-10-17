<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Slider;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        $sliders = Slider::where('estado', '0')->get();
        $productos = Producto::limit(10)->get();

        return view('frontend.inicio.inicio', compact('sliders', 'productos'));
    }
}

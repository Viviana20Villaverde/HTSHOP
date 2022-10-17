<?php

namespace App\Http\Livewire\Frontend\Productos;

use Livewire\Component;

class SliderProducto extends Component
{
    public $productos;

    public function render()
    {
        return view('livewire.frontend.productos.slider-producto');
    }
}

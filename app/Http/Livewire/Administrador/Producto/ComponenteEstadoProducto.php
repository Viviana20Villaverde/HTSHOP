<?php

namespace App\Http\Livewire\Administrador\Producto;

use Livewire\Component;

class ComponenteEstadoProducto extends Component
{
    public $producto, $estado;

    public function mount(){
        $this->estado = $this->producto->estado;
    }

    public function actualizarEstadoProducto(){
        $this->producto->estado = $this->estado;
        $this->producto->save();

        $this->emit('mensajeProductoEstado');
    }

    public function render()
    {
        return view('livewire.administrador.producto.componente-estado-producto');
    }
}

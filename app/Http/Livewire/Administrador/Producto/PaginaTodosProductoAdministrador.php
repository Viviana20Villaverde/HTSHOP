<?php

namespace App\Http\Livewire\Administrador\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class PaginaTodosProductoAdministrador extends Component
{
    use WithPagination;

    public $buscarProducto;

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%' . $this->buscarProducto . '%')->paginate(10);

        return view('livewire.administrador.producto.pagina-todos-producto-administrador', compact('productos'))->layout('layouts.administrador.administrador');
    }
}

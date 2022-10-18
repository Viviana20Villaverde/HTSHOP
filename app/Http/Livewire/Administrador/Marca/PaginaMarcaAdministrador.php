<?php

namespace App\Http\Livewire\Administrador\Marca;

use Livewire\Component;
use App\Models\Marca;

class PaginaMarcaAdministrador extends Component
{
    public $marcas, $marca;

    protected $listeners = ['eliminarMarca'];

    public $crearFormulario = [
        'nombre' => null
    ];

    public $editarFomulario = [
        'abierto' => false,
        'nombre' => null
    ];

    public $rules = [
        'crearFormulario.nombre' => 'required'
    ];

    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre',
        'editarFomulario.nombre' => 'nombre'
    ];

    public function mount()
    {
        $this->traerMarcas();
    }

    public function traerMarcas()
    {
        $this->marcas = Marca::all();
    }

    public function crearMarca()
    {
        $this->validate();

        Marca::create($this->crearFormulario);
        $this->traerMarcas();

        $this->emit('crearMarcaMensaje', $this->crearFormulario['nombre']);
        $this->reset('crearFormulario');

    }
    public function editarMarca(Marca $marca)
    {
        $this->marca = $marca;

        $this->editarFomulario['abierto'] = true;
        $this->editarFomulario['nombre'] = $marca->nombre;
    }

    public function actualizarMarca()
    {
        $this->validate([
            'editarFomulario.nombre' => 'required'
        ]);

        $this->marca->update($this->editarFomulario);
        
        $this->traerMarcas();
        $this->reset('editarFomulario');
    }

    public function eliminarMarca(Marca $marca)
    {
        $marca->delete();
        $this->traerMarcas();
    }

    public function render()
    {
        return view('livewire.administrador.marca.pagina-marca-administrador')->layout('layouts.administrador.administrador');
    }
}

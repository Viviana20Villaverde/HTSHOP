<?php

namespace App\Http\Livewire\Cliente\Perfil;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaginaPerfilCliente extends Component
{
    use WithFileUploads;

    public $nombre, $apellido, $celular, $imagen_ruta;

    public $nueva_imagen_ruta;

    public function mount()
    {
        $this->nombre = Auth::user()->cliente ? Auth::user()->cliente->nombre : "";
        $this->apellido = Auth::user()->cliente ? Auth::user()->cliente->apellido : "";
        $this->celular = Auth::user()->cliente ? Auth::user()->cliente->celular : "";
        $this->imagen_ruta = Auth::user()->cliente ? Auth::user()->cliente->imagen_ruta : "";
    }

    public function editarPerfilCliente()
    {

        if ($this->nueva_imagen_ruta) {
            $imagenNombre = $this->nueva_imagen_ruta->store('perfiles/clientes');

            if ($this->imagen_ruta) {
                Storage::delete($this->imagen_ruta);
            }
        }

        Auth::user()->cliente->update(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'celular' => $this->celular,
                'imagen_ruta' => $this->nueva_imagen_ruta ? $imagenNombre  : $this->imagen_ruta,
            ]
        );
    }
    public function render()
    {
        $cliente = Cliente::where('user_id', Auth::user()->id)->first();

        if (!$cliente) {
            $nuevoCliente = new Cliente();
            $nuevoCliente->user_id = Auth::user()->id;
            $nuevoCliente->correo = Auth::user()->email;
            $nuevoCliente->save();
        }

        $usuario = User::find(Auth::user()->id);

        return view('livewire.cliente.perfil.pagina-perfil-cliente', ['usuario' => $usuario])->layout('layouts.frontend.frontend');
    }
}

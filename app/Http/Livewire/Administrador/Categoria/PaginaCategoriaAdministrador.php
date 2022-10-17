<?php

namespace App\Http\Livewire\Administrador\Categoria;

use Livewire\Component;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class PaginaCategoriaAdministrador extends Component
{
    //Carga básica de archivos
    use WithFileUploads;
    public $marcas, $categorias, $categoria, $aleatorio, $editarImagen;

    //Los detectores de eventos
    protected $listeners = ['eliminarCategoria'];

    public $crearFormulario = [
        'nombre' => null,
        'slug' => null,
        'icono' => null,
        'imagen_ruta' => null,
        'marcas' => [],
    ];

    public $editarFormulario = [
        'abierto' => false,
        'nombre' => null,
        'slug' => null,
        'icono' => null,
        'imagen_ruta' => null,
        'marcas' => [],
    ];

    //propiedad para establecer reglas de validación por componente
    protected $rules = [
        'crearFormulario.nombre' => 'required',
        'crearFormulario.slug' => 'required|unique:categorias,slug',
        'crearFormulario.icono' => 'required',
        'crearFormulario.imagen_ruta' => 'required|image|max:1024',
        'crearFormulario.marcas' => 'required',
    ];

    //personalizar los mensajes de validación utilizados por un componente de Livewire
    protected $validationAttributes = [
        'crearFormulario.nombre' => 'nombre',
        'crearFormulario.slug' => 'slug',
        'crearFormulario.icono' => 'icono',
        'crearFormulario.imagen_ruta' => 'imagen_ruta',
        'crearFormulario.marcas' => 'marcas',

        'editarFormulario.nombre' => 'nombre',
        'editarFormulario.slug' => 'slug',
        'editarFormulario.icono' => 'icono',
        'editarImagen' => 'imagen_ruta',
        'editarFormulario.marcas' => 'marcas',
    ];

    //solo se llama cuando el componente se monta por primera vez y no se volverá a llamar incluso cuando el componente se actualice o se vuelva a renderizar.
    public function mount()
    {
        $this->traerMarcas();
        $this->traerCategorias();
        $this->aleatorio = rand();
    }

    //Detecta un cambio o una actualización en un campo
    public function updatedCrearFormularioNombre($value)
    {
        $this->crearFormulario['slug'] = Str::slug($value);
    }

    //Detecta un cambio o una actualización en un campo
    public function updatedEditarFormularioNombre($value)
    {
        $this->editarFormulario['slug'] = Str::slug($value);
    }

    public function traerMarcas()
    {
        $this->marcas = Marca::all();
    }

    public function traerCategorias()
    {
        $this->categorias = Categoria::all();
    }

    public function crearCategoria()
    {
        //Método para validar las propiedades de un componente usando esas reglas.
        $this->validate();

        $imagen = $this->crearFormulario['imagen_ruta']->store('categorias');

        $categoria = Categoria::create([
            'nombre' => $this->crearFormulario['nombre'],
            'slug' => $this->crearFormulario['slug'],
            'icono' => $this->crearFormulario['icono'],
            'imagen_ruta' => $imagen
        ]);

        $categoria->marcas()->attach($this->crearFormulario['marcas']);

        $this->aleatorio = rand();

        $this->reset('crearFormulario');

        $this->traerCategorias();

        //Emitir eventos a los padres y no a los componentes secundarios o hermanos.
        $this->emit('crearCategoriaMensaje');
    }

    public function editarCategoria(Categoria $categoria)
    {
        //Reinicia el valor de la variable
        $this->reset(['editarImagen']);
        //Borrar los errores de las claves
        $this->resetValidation();

        $this->categoria = $categoria;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['nombre'] = $categoria->nombre;
        $this->editarFormulario['slug'] = $categoria->slug;
        $this->editarFormulario['icono'] = $categoria->icono;
        $this->editarFormulario['imagen_ruta'] = $categoria->imagen_ruta;
        $this->editarFormulario['marcas'] = $categoria->marcas->pluck('id');
    }

    public function actualizarCategoria()
    {
        $rules = [
            'editarFormulario.nombre' => 'required',
            'editarFormulario.slug' => 'required|unique:categorias,slug,' . $this->categoria->id,
            'editarFormulario.icono' => 'required',
            'editarFormulario.marcas' => 'required',
        ];

        if ($this->editarImagen) {
            $rules['editarImagen'] = 'required|image|max:1024';
        }

        $this->validate($rules);

        if ($this->editarImagen) {
            Storage::delete($this->editarFormulario['imagen_ruta']);
            $this->editarFormulario['imagen_ruta'] = $this->editarImagen->store('categorias');
        }

        $this->categoria->update($this->editarFormulario);

        $this->categoria->marcas()->sync($this->editarFormulario['marcas']);

        $this->reset(['editarFormulario', 'editarImagen']);

        $this->traerCategorias();
    }


    public function eliminarCategoria(Categoria $categoria)
    {
        $categoria->delete();
        $this->traerCategorias();
    }

    public function render()
    {
        return view('livewire.administrador.categoria.pagina-categoria-administrador')->layout('layouts.administrador.administrador');
    }
}

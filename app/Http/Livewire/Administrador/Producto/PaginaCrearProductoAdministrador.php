<?php

namespace App\Http\Livewire\Administrador\Producto;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PaginaCrearProductoAdministrador extends Component
{
    use WithFileUploads;

    public $categorias, $subcategorias = [], $marcas = [], $imagenes = [];

    public $categoria_id = "",  $subcategoria_id = "", $marca_id = "";
    public $nombre = null, $slug = null,  $sku = null,  $precio = 1, $descripcion = null,
        $informacion = null, $puntos_ganar = 0, $puntos_tope = 0,
        $tiene_detalle = false, $detalle = null,  $stock_total = 0, $estado = 1;

    protected $rules = [
        'categoria_id' => 'required',
        'subcategoria_id' => 'required',
        'marca_id' => 'required',
        'nombre' => 'required',
        'slug' => 'required|unique:productos',
        'sku' => 'required|unique:productos',
        'precio' => 'required',
        'descripcion' => 'required',
        'informacion' => 'required',
        'puntos_ganar' => 'required',
        'puntos_tope' => 'required',
        'tiene_detalle' => 'required',
        'estado' => 'required',
    ];
    
    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function updatedCategoriaId($value)
    {
        $this->subcategorias = Subcategoria::where('categoria_id', $value)->get();

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) use ($value) {
            $query->where('categoria_id', $value);
        })->get();

        $this->reset(['subcategoria_id', 'marca_id']);
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
        $this->sku = strtoupper(substr($value, 0, 2)) . "-" . "C" . rand(1, 500) . strtoupper(substr($value, -2));
    }

    //Propiedad computada
    public function getSubcategoriaProperty()
    {
        return Subcategoria::find($this->subcategoria_id);
    }

    public function crearProducto()
    {
        $rules = $this->rules;

        if ($this->subcategoria_id) {
            if (!$this->subcategoria->tiene_color && !$this->subcategoria->medida) {
                $rules['stock_total'] = 'required';
            }
        }

        if ($this->tiene_detalle) {
            $rules['detalle'] = 'required';
        } else {
            $this->detalle = null;
        }

        $this->validate($rules);

        $producto = new Producto();

        $producto->subcategoria_id  = $this->subcategoria_id;
        $producto->marca_id  = $this->marca_id;
        $producto->nombre = $this->nombre;
        $producto->slug = $this->slug;
        $producto->sku = $this->sku;
        $producto->precio = $this->precio;
        $producto->descripcion = $this->descripcion;
        $producto->informacion = $this->informacion;
        $producto->puntos_ganar = $this->puntos_ganar;
        $producto->puntos_tope = $this->puntos_tope;
        $producto->tiene_detalle = $this->tiene_detalle;
        $producto->detalle = $this->detalle;
        $producto->estado  = $this->estado;

        if ($this->subcategoria_id) {
            if (!$this->subcategoria->tiene_color && !$this->subcategoria->tiene_medida) {
                $producto->stock_total = $this->stock_total;
            }
        }

        $producto->save();

        $this->validate([
            'imagenes.*' => 'image|max:1024',
        ]);

        foreach ($this->imagenes as $imagen) {
            $urlImagen = Storage::put('productos', $imagen);

            $producto->imagenes()->create([
                'imagen_ruta' => $urlImagen
            ]);
        }
        return dump($producto);

        //return redirect()->route('admin.productos.editar', $producto);
    }

    public function render()
    {
        return view('livewire.administrador.producto.pagina-crear-producto-administrador')->layout('layouts.administrador.administrador');
    }
}

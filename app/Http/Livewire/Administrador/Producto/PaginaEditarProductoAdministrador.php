<?php

namespace App\Http\Livewire\Administrador\Producto;

use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class PaginaEditarProductoAdministrador extends Component
{
    protected $listeners = ['dropImagenes', 'eliminarProducto'];

    public $producto, $categorias, $subcategorias, $marcas, $slug, $sku;
    public $categoria_id;

    protected $rules = [
        'categoria_id' => 'required',
        'producto.subcategoria_id' => 'required',
        'producto.marca_id' => 'required',
        'producto.nombre' => 'required',
        'slug' => 'required|unique:productos,slug',
        'sku' => 'required|unique:productos,sku',
        'producto.precio' => 'required',
        'producto.descripcion' => 'required',
        'producto.informacion' => 'required',
        'producto.stock_total' => 'numeric',
        'producto.puntos_ganar' => 'numeric',
        'producto.puntos_tope' => 'numeric',
        'producto.tiene_detalle' => 'required',
    ];

    public function mount(Producto $producto)
    {
        $this->producto = $producto;

        $this->categorias = Categoria::all();

        $this->categoria_id = $producto->subcategoria->categoria->id;

        $this->subcategorias = Subcategoria::where('categoria_id', $this->categoria_id)->get();

        $this->slug = $this->producto->slug;

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) {
            $query->where('categoria_id', $this->categoria_id);
        })->get();
    }
  
    public function updatedCategoriaId($value)
    {
        $this->subcategorias = Subcategoria::where('categoria_id', $value)->get();

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) use ($value) {
            $query->where('categoria_id', $value);
        })->get();

        /* $this->reset(['subcategory_id', 'brand_id']); */
        $this->producto->subcategoria_id  = "";
        $this->producto->marca_id  = "";
    }

    public function updatedProductoNombre($value)
    {
        $this->slug = Str::slug($value);
        $this->sku = strtoupper(substr($value, 0, 2)) . "-" . "C" . rand(1, 500) . strtoupper(substr($value, -2));
    }  

    public function getSubcategoriaProperty()
    {
        return Subcategoria::find($this->producto->subcategoria_id);
    }


    public function dropImagenes()
    {
        $this->producto = $this->producto->fresh();
    }

    public function editarProducto()
    {
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:productos,slug,' . $this->producto->id;

        if ($this->producto->subcategoria_id) {
            if (!$this->subcategoria->tiene_color && !$this->subcategoria->tiene_medida) {
                $rules['producto.stock_total'] = 'required|numeric';
            }
        }

        $this->validate($rules);

        $this->producto->slug = $this->slug;

        $this->producto->save();

        $this->emit('mensajeProductoCreado');
    }

    public function eliminarImagen(Imagen $imagen)
    {
        Storage::delete([$imagen->imagen_ruta]);
        $imagen->delete();

        $this->producto = $this->producto->fresh();
    }

    public function eliminarProducto(){

        $imagenes = $this->producto->imagenes;

        foreach ($imagenes as $imagen) {
            Storage::delete($imagen->imagen_ruta);
            $imagen->delete();
        }

        $this->producto->delete();

        return redirect()->route('administrador.producto.index');
    }

    public function render()
    {
        return view('livewire.administrador.producto.pagina-editar-producto-administrador')->layout('layouts.administrador.administrador');
    }
}

<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            //'imagen_ruta' => 'categorias/' . $this->faker->image('public/storage/categorias', 640, 480, null, false)
            'imagen_ruta' => 'imagenes/producto/sin_foto_producto.png',
        ];
    }
}

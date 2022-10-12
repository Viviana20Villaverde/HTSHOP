<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoriaFactory extends Factory
{
    public function definition()
    {
        return [
            //'imagen_ruta' => 'subcategorias/' . $this->faker->image('public/storage/subcategorias', 640, 480, null, false) //imagen1.jpg
            'imagen_ruta' => 'imagenes/producto/sin_foto_producto.png',
        ];
    }
}

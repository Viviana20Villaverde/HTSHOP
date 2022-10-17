<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenFactory extends Factory
{
    public function definition()
    {
        return [
            //'imagen_ruta' => 'productos/' . $this->faker->image('public/storage/productos', 640, 480, null, false)
            'imagen_ruta' => 'imagenes/producto/sin_foto_producto.png',
        ];
    }
}

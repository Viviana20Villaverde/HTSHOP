<?php

namespace Database\Factories;

use App\Models\Subcategoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition()
    {
        $nombre = $this->faker->sentence(2);

        $subcategoria = Subcategoria::all()->random();
        $categoria = $subcategoria->categoria;

        $marca = $categoria->marcas->random();

        if ($subcategoria->tiene_color) {
            $stock = null;
        } else {
            $stock = 15;
        }

        return [
            'subcategoria_id' => $subcategoria->id,
            'marca_id' => $marca->id,
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'sku' => $this->faker->unique()->randomNumber(),
            'precio' => $this->faker->randomElement([1000, 500, 50, 3000, 15000]),
            'stock_total' => $stock,
            'descripcion' => $this->faker->text(),
            'informacion' => $this->faker->text(),
            'puntos_ganar' => $this->faker->randomElement([10, 20, 30, 40, 50]),
            'puntos_tope' => $this->faker->randomElement([500, 600, 700, 800, 1000]),
            'link_video' => "https://youtu.be/8UlX4a_zYNk",
            'tiene_detalle' => false,
            'estado' => 2,
        ];
    }
}

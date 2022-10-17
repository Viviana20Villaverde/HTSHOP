<?php

namespace Database\Seeders;

use App\Models\Imagen;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        Producto::factory(100)->create()->each(function (Producto $producto) {
            Imagen::factory(1)->create([
                'imagenable_id' => $producto->id,
                'imagenable_type' => Producto::class
            ]);
        });
    }
}

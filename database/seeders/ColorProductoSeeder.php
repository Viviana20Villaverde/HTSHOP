<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorProductoSeeder extends Seeder
{
    public function run()
    {
        $productos = Producto::whereHas('subcategoria', function (Builder $query) {
            $query->where('tiene_color', 1)
                ->where('tiene_medida', 0);
        })->get();

        foreach ($productos as $producto) {
            $producto->colores()->attach([
                1 => [
                    'stock' => 10
                ],
                2 => [
                    'stock' => 10
                ],
                3 => [
                    'stock' => 10
                ],
                4 => [
                    'stock' => 10
                ]
            ]);
        }
    }
}

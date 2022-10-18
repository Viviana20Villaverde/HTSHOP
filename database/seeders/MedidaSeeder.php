<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    public function run()
    {
        $productos = Producto::whereHas('subcategoria', function (Builder $query) {
            $query->where('tiene_color', true)
                ->where('tiene_medida', true);
        })->get();

        $medidas = ['Ø98x10', 'Ø98x12', 'Ø98x14'];

        foreach ($productos as $producto) {

            foreach ($medidas as $medida) {
                $producto->medidas()->create([
                    'nombre' => $medida
                ]);
            }
        }
    }
}

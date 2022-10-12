<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorMedidaSeeder extends Seeder
{
    public function run()
    {
        $medidas = Medida::all();
        foreach ($medidas as $itemMedida) {
            $itemMedida->colores()->attach(([
                1 => ['stock' => 10],
                2 => ['stock' => 10],
                3 => ['stock' => 10],
                4 => ['stock' => 10]
            ]));
        }
    }
}

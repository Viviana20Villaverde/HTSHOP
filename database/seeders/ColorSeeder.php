<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $colores = ['white', 'blue', 'red', 'black', 'none'];

        foreach ($colores as $color) {
            Color::create([
                'nombre' => $color
            ]);
        }
    }
}

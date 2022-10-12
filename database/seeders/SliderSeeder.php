<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $sliders = [
            [
                'imagen_ruta' => 'imagenes/slider/slider1.jpg',
                'link' => Str::slug('Equipos intraorales'),
                'estado' => 0,
                'posicion' => 1,
            ],
            [
                'imagen_ruta' => 'imagenes/slider/slider2.jpg',
                'link' => Str::slug('Materiales'),
                'estado' => 0,
                'posicion' => 2,
            ],
            [
                'imagen_ruta' => 'imagenes/slider/slider3.jpg',
                'link' => Str::slug('Implantes'),
                'estado' => 0,
                'posicion' => 3,
            ],
        ];

        foreach ($sliders as $slider) {

            Slider::create($slider);
        }
    }
}

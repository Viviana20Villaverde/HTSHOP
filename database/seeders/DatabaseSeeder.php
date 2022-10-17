<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Storage::deleteDirectory('categorias');
        Storage::deleteDirectory('subcategorias');
        Storage::deleteDirectory('productos');
        
        Storage::makeDirectory('categorias');
        Storage::makeDirectory('subcategorias');
        Storage::makeDirectory('productos');

        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ColorProductoSeeder::class);
        $this->call(MedidaSeeder::class);
        $this->call(ColorMedidaSeeder::class);
    }
}

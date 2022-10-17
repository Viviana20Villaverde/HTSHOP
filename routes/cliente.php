<?php

use App\Http\Livewire\Cliente\Perfil\PaginaPerfilCliente;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'cliente/perfil');

Route::get('perfil', PaginaPerfilCliente::class)->name('perfil');

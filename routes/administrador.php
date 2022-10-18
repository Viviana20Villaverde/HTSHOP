<?php

use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\PermisoController;
use App\Http\Controllers\Administrador\ProductoController;
use App\Http\Controllers\Administrador\RolController;
use App\Http\Livewire\Administrador\Administrador\PaginaAdministradorAdministrador;
use App\Http\Livewire\Administrador\Perfil\PaginaPerfilAdministrador;
use App\Http\Livewire\Administrador\Categoria\PaginaCategoriaAdministrador;
use App\Http\Livewire\Administrador\Subcategoria\PaginaSubcategoriaAdministrador;
use App\Http\Livewire\Administrador\Marca\PaginaMarcaAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaCrearProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaEditarProductoAdministrador;
use App\Http\Livewire\Administrador\Producto\PaginaTodosProductoAdministrador;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'administrador/perfil');

Route::get('perfil', PaginaPerfilAdministrador::class)->middleware('can:Ver panel')->name('perfil');

Route::controller(RolController::class)->middleware('can:Roles y permisos')->group(function () {
    Route::get('rol', 'index')->name('rol.index');
    Route::get('rol/crear', 'create')->name('rol.crear');
    Route::post('rol/crear', 'store')->name('rol.store');
    Route::get('rol/{rol}/editar', 'edit')->name('rol.editar');
    Route::put('rol/{rol}/editar', 'update')->name('rol.update');
    Route::delete('rol/{rol}', 'destroy')->name('rol.eliminar');
});

Route::controller(PermisoController::class)->group(function () {
    Route::get('permiso', 'index')->name('permiso.index');
    Route::get('permiso/crear', 'create')->name('permiso.crear');
    Route::post('permiso/crear', 'store')->name('permiso.store');
    Route::get('permiso/{permiso}/editar', 'edit')->name('permiso.editar');
    Route::put('permiso/{permiso}/editar', 'update')->name('permiso.update');
    Route::delete('permiso/{permiso}', 'destroy')->name('permiso.eliminar');
});

Route::get('administrador', PaginaAdministradorAdministrador::class)->middleware('can:Roles y permisos')->name('administrador.index');
Route::controller(AdministradorController::class)->middleware('can:Roles y permisos')->group(function () {
    Route::get('administrador/crear', 'create')->name('administrador.crear');
    Route::post('administrador/crear', 'store')->name('administrador.store');
    Route::get('administrador/{usuario}/editar', 'edit')->name('administrador.editar');
    Route::put('administrador/{usuario}/editar', 'update')->name('administrador.update');
    Route::delete('administrador/{usuario}', 'destroy')->name('administrador.eliminar');
});

Route::get('categoria', PaginaCategoriaAdministrador::class)->name('categoria');
Route::get('subcategoria/{categoria}', PaginaSubcategoriaAdministrador::class)->name('subcategoria');
Route::get('marca', PaginaMarcaAdministrador::class)->name('marca');

Route::get('producto', PaginaTodosProductoAdministrador::class)->name('producto.index');
Route::get('producto/crear', PaginaCrearProductoAdministrador::class)->name('producto.crear');
Route::get('producto/{producto}/editar', PaginaEditarProductoAdministrador::class)->name('producto.editar');
Route::post('producto/{producto}/files', [ProductoController::class, 'files'])->name('producto.files');

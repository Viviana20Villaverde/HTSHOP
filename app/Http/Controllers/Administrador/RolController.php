<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('administrador.rol.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permission::all();
        return view('administrador.rol.crear', compact('permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $rol = Role::create([
            'name' => $request->nombre
        ]);

        $rol->permissions()->attach($request->permisos);

        return redirect()->route('administrador.rol.index')->with('crear', 'El Rol se creo correctamente.');
    }

    public function show(Role $rol)
    {
        return view('administrador.rol.mostrar', compact('rol'));
    }

    public function edit(Role $rol)
    {
        $permisos = Permission::all();
        $rol->load('permissions');

        return view('administrador.rol.editar', compact('rol', 'permisos'));
    }

    public function update(Request $request, Role $rol)
    {
        $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $rol->update([
            'name' => $request->nombre,
        ]);

        $rol->permissions()->sync($request->permisos);

        return back()->with('editar', 'El Rol se edito correctamente.');
    }

    public function destroy(Role $rol)
    {
        $rol->delete();
        
        return redirect()->route('administrador.rol.index')->with('eliminar', 'El Rol se eliminó correctamente.');
    }
}

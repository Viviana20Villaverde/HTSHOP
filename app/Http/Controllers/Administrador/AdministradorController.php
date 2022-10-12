<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function create()
    {
        return view('administrador.administrador.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min_digits:8',
        ]);

        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = 'administrador';
        $usuario->save();

        $usuario->administrador()->create(
            [
                'nombre' => $request->nombre,
                'correo' => $request->email,
                'rol' => 'administrador',
            ]
        );

        return redirect()->route('administrador.administrador.index')->with('crear', 'El Administrador se creo correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('administrador.administrador.editar', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);
        return back()->with('editar', 'Se agrego Rol correctamente.');
    }

    public function destroy(User $usuario)
    {
    }
};

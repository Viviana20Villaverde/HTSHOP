<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'almacen']);
        $role3 = Role::create(['name' => 'vendedor']);

        Permission::create(['name' => 'Roles y permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Ver panel'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'Crear productos'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Editar productos'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Eliminar productos'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Actualizar productos'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'Ver ordenes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Ver orden'])->syncRoles([$role1, $role2]);
    }
}

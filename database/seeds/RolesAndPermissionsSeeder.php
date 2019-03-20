<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions
        Permission::create(['name' => 'cadastrar']);
        Permission::create(['name' => 'visualizar']);
        Permission::create(['name' => 'atualizar']);
        Permission::create(['name' => 'excluir']);
        
        // create roles and assign created permissions
        
        // this can be done as separate statements
        $role = Role::create(['name' => 'Editor']);
        $role->givePermissionTo('atualizar');
        
        // or may be done by chaining
        $role = Role::create(['name' => 'Moderador'])
        ->givePermissionTo(['atualizar', 'excluir']);
        
        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo(Permission::all());
        
        //Create user
        $user = User::create([
            'name' => 'Daniel Oliveira',
            'email' => 'rangeldor@gmail.com',
            'password' => bcrypt('master19'),
            ]);
            
            // Adding permissions via a role
            $user->assignRole('Administrador');
            
        }
    }
    
    
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
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);
        
        // create roles and assign created permissions
        
        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('update');
        
        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
        ->givePermissionTo(['create', 'delete']);
        
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        
        //Create user
        $user = User::create([
            'name' => 'Daniel Oliveira',
            'email' => 'rangeldor@gmail.com',
            'password' => bcrypt('master19'),
            ]);
            
            // Adding permissions via a role
            $user->assignRole('super-admin');
            
        }
    }
    
    
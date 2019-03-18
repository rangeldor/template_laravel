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
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        
        // create roles and assign created permissions
        
        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');
        
        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
        ->givePermissionTo(['publish articles', 'unpublish articles']);
        
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
    
    
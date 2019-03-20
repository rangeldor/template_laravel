<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    private $user;
    private $role;
    private $permission;
    
    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'Perfil';
        
        $perfis = DB::select("  select distinct
        roles.id as role_id,
        roles.name as role_name           
        
        from role_has_permissions
        
        inner join permissions on role_has_permissions.permission_id = permissions.id
        inner join roles on role_has_permissions.role_id = roles.id"
    );
    
    $permissoes = DB::select("  select 
    roles.id as role_id,
    roles.name as role_name,
    permissions.name as permission_name
    
    from role_has_permissions
    
    inner join permissions on role_has_permissions.permission_id = permissions.id
    inner join roles on role_has_permissions.role_id = roles.id"
);

return view('panel.perfil.index', compact('title', 'perfis', 'permissoes'));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $title = 'Perfil';
    
    return view('panel.perfil.create', compact('title'));
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{      
    if($this->role->where('name',$request->name)->count() > 0 )
    {
        dd('erro, existe');
    }
    else
    {
        if(!is_null($request->cadastrar) || !is_null($request->visualizar) || !is_null($request->atualizar) || !is_null($request->excluir))
        {
            $insert_role = $this->role->create(['name' => $request->name]);
            $insert_permission = $insert_role->givePermissionTo($request->cadastrar);
            $insert_permission = $insert_role->givePermissionTo($request->visualizar);
            $insert_permission = $insert_role->givePermissionTo($request->atualizar);
            $insert_permission = $insert_role->givePermissionTo($request->excluir);
            
            return redirect()
                    ->route('perfil.index')
                    ->with('success', 'Cadastro realizado com sucesso!');
        } 
        else 
        {
            dd('devolve erro de função do perfil vazia');
        }
        
    }
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    //
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    //
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    //
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    //
}
}

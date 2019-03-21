<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    if ($this->role->where('name', $request->name)->count() > 0) {
        
        return redirect()
        ->back()
        ->with('error', 'Nome do perfil já existe!');
        
    } else {
        if (!is_null($request->cadastrar) || !is_null($request->visualizar) || !is_null($request->atualizar) || !is_null($request->excluir)) {
            
            $cadastrar = $request->cadastrar ? 'cadastrar' : '';
            $visualizar = $request->visualizar ? 'visualizar' : '';
            $atualizar = $request->atualizar ? 'atualizar' : '';
            $excluir = $request->excluir ? 'excluir' : '';
            
            $this->role->create(['name' => $request->name])->givePermissionTo(["$cadastrar", "$visualizar", "$atualizar", "$excluir"]);
            
            return redirect()
            ->route('perfil.index')
            ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            
            return redirect()
            ->back()
            ->with('error', 'Um perfil precisa ter uma função!');
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
    $role = $this->role->find($id);
    if (!$role) {
        return redirect()->back();
    }
    
    $title = "Detalhes do Perfil: {$role->name}";
    
    return view('panel.perfil.show', compact('title', 'role'));
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $cadastrar = false;
    $visualizar = false;
    $atualizar = false;
    $excluir = false;
    
    $role = $this->role->find($id);
    if (!$role) 
    {
        return redirect()->back();
    }
    
    $title = "Editar Usuário: {$role->name}";
    
    $permissoes = DB::select("  select
    roles.id as role_id,
    roles.name as role_name,
    permissions.name as permission_name
    
    from role_has_permissions
    
    inner join permissions on role_has_permissions.permission_id = permissions.id
    inner join roles on role_has_permissions.role_id = roles.id
    
    where roles.id = $id"
);

foreach($permissoes as $p)
{
    if( $p->permission_name == 'cadastrar')
    $cadastrar = true;
    if( $p->permission_name == 'visualizar')
    $visualizar = true;
    if( $p->permission_name == 'atualizar')
    $atualizar = true;
    if( $p->permission_name == 'excluir')
    $excluir = true;
}

return view('panel.perfil.edit', compact('title', 'role', 'permissoes', 'cadastrar', 'visualizar', 'atualizar', 'excluir'));
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
    $role = $this->role->find($id);
    if (!$role) {
        return redirect()->back();
    }
    
    //Edita se os nomes dos perfis forem iguais
    if($role->name == $request->name)
    {   
        if (!is_null($request->cadastrar) || !is_null($request->visualizar) || !is_null($request->atualizar) || !is_null($request->excluir)) 
        {   
            $cadastrar = $request->cadastrar ? 'cadastrar' : '';
            $visualizar = $request->cadastrar ? 'visualizar' : '';
            $atualizar = $request->atualizar ? 'atualizar' : '';
            $excluir = $request->excluir ? 'excluir' : '';
            
            $role->syncPermissions(["$cadastrar", "$visualizar", "$atualizar", "$excluir"]);
            
            return redirect()
            ->route('perfil.index')
            ->with('success', 'Atualizado com sucesso!');
        } 
        else 
        {            
            return redirect()
            ->back()
            ->with('error', 'Um perfil precisa ter uma função!');
        }        
    }
    //Edita se os nomes dos perfis forem diferentes
    else 
    {
        if ($role->where('name', $request->name)->count() > 0) 
        {            
            return redirect()
            ->back()
            ->with('error', 'Nome do perfil já existe!');            
        }
        else
        {
            if (!is_null($request->cadastrar) || !is_null($request->visualizar) || !is_null($request->atualizar) || !is_null($request->excluir)) 
            {   
                $cadastrar = $request->cadastrar ? 'cadastrar' : '';
                $visualizar = $request->cadastrar ? 'visualizar' : '';
                $atualizar = $request->atualizar ? 'atualizar' : '';
                $excluir = $request->excluir ? 'excluir' : '';
                
                $role->syncPermissions(["$cadastrar", "$visualizar", "$atualizar", "$excluir"]);
                
                return redirect()
                ->route('perfil.index')
                ->with('success', 'Atualizado com sucesso!');
            } 
            else 
            {            
                return redirect()
                ->back()
                ->with('error', 'Um perfil precisa ter uma função!');
            }  
        }
        
    }    
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    $role = $this->role->find($id);
        if (!$role) {
            return redirect()->back();
        }

        if ($role->delete()) {
            return redirect()
                ->route('perfil.index')
                ->with('success', 'Deletado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao deletar!');
        }
}
}

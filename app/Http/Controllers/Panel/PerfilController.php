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
            dd('erro, existe');
        } else {
            if (!is_null($request->cadastrar) || !is_null($request->visualizar) || !is_null($request->atualizar) || !is_null($request->excluir)) {

                $cadastrar = $request->cadastrar ? 'cadastrar' : '';
                $visualizar = $request->cadastrar ? 'visualizar' : '';
                $atualizar = $request->atualizar ? 'atualizar' : '';
                $excluir = $request->excluir ? 'excluir' : '';

                $insert_role = $this->role->create(['name' => $request->name])->givePermissionTo(["$cadastrar", "$visualizar", "$atualizar", "$excluir"]);

                return redirect()
                    ->route('perfil.index')
                    ->with('success', 'Cadastro realizado com sucesso!');
            } else {
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
        $role = $this->role->find($id);
        if (!$role) {
            return redirect()->back();
        }

        $title = "Editar Usuário: {$role->name}";

        return view('panel.perfil.edit', compact('title', 'role'));

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

        $role->name = $request->name;        

        if ($role->save()) {
            return redirect()
                ->back()
                ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar!');
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
        //
    }
}

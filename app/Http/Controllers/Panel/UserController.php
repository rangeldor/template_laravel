<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Http\Requests\UpdateProfileUserFormRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $user;
    private $role;
    private $permission;
    private $totalPage = 20;

    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;

      /*  if (Gate::denies('adm')) {
            return abort(403, 'Não Autorizado!');
        }
        */

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Usuários';

        $users = DB::select("select 

                            users.id,
                            users.name,
                            users.email,
                            model_has_roles.role_id,
                            roles.name as role_name

                            from users

                            inner join model_has_roles on users.id = model_has_roles.model_id
                            inner join roles on roles.id = model_has_roles.role_id");

        return view('panel.users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Usuário';

        $roles = $this->role->pluck( 'name', 'id');

        return view('panel.users.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        $role = $this->role->find($request->role);

        if(empty($request->password))
        {
            return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar! Senha não pode ser vazia!');
        }

        if($request->password == $request->confirm_password)
        {
            $user = User::create([
                'name' => "$request->name",
                'email' => "$request->email",
                'password' => bcrypt("$request->password"),
                ]);            

            if ($user) 
            {
                $user->assignRole("$role->name");
                
                return redirect()
                    ->route('users.index')
                    ->with('success', 'Cadastro realizado com sucesso!');
            } 
            else 
            {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao cadastrar!');
            }
        }
        else 
        {
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao cadastrar! Senha e confirmar Senha não são iguais!');
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
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back();
        }

        $title = "Detalhes do Usuário: {$user->name}";

        return view('panel.users.show', compact('title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back();
        }

        $select = DB::select("  select
                                model_has_roles.role_id as id
                                
                                from users

                                inner join model_has_roles on users.id = model_has_roles.model_id
                                                        
                                where users.id = $id"); 

        $roles = $this->role->pluck( 'name', 'id');
        $role_id = $select[0]->id;
       
        $title = "Editar Usuário: {$user->name}";

        return view('panel.users.edit', compact('title', 'user', 'role_id','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {        
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back();
        }

        $role = $this->role->find($request->role);
       
        if ($user->updateUser($request)) {
            $user->syncRoles(["$role->name"]);
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
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back();
        }

        if ($user->delete()) {
            return redirect()
                ->route('users.index')
                ->with('success', 'Deletado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao deletar!');
        }

    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $users = $this->user->search($request->key_search, $this->totalPage);

        $title = "Users, filtros para: {$request->key_search}";

        return view('panel.users.index', compact('title', 'users', 'dataForm'));
    }

    public function myProfile()
    {
        $title = 'Meu Perfil';

        return view('site.users.profile', compact('title'));
    }

    public function updateProfile(UpdateProfileUserFormRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if ($user->image) {
                $nameFile = $user->image;
            } else {
                $nameFile = kebab_case($user->name) . '.' . $request->image->extension();
            }

            $user->image = $nameFile;

            if (!$request->image->storeAs('users', $nameFile)) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload.');
            }

        }

        if ($user->save()) {
            return redirect()
                ->route('my.profile')
                ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao alterar os dados!');
        }

    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }

}

@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="" class="bred pl-0">Usuários</a>
</div>

@stop

@section('content')

<div class="card" >
    <div class="card-body rounded bg-light" style="padding: 0.5rem; box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(0,192,239,.4);">         
        
        <div class="col-12">
            <div class="messages">
                @include('panel.includes.alerts')
            </div>
        </div>
        
        <table id="datatable" class="table table-striped table-bordered" style="width:100%; ">
            <thead>
                <tr>
                    <!--  <th>Imagem</th> -->
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th width="250">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    {{--  <td>
                        @if($user->image)
                        <img src="{{url("storage/users/{$user->image}")}}" alt="{{$user->id}}" style="max-width: 60px;">
                        @else
                        <img src="{{url('assets/panel/imgs/no-image.png')}}" alt="{{$user->id}}" style="max-width: 100px;">
                        @endif
                    </td> --}}
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                       {{ $user->role_name }}
                    </td>
                    <td>
                        @can('atualizar')
                            <a href="{{route('users.edit', $user->id)}}" class="edit rounded"><i class="fas fa-edit"></i> Editar</a>
                        @endcan
                        
                        @can('excluir')
                            <a href="{{route('users.show', $user->id)}}" class="delete rounded"><i class="fas fa-eye"></i> Visualizar</a>
                        @endcan
                    </td>
                </tr>
                @empty
                
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <!--  <th>Imagem</th> -->
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th width="250">Ações</th>
                </tr>
            </tfoot>
        </table>
      
    </div>     
</div>
<!--Content Dinâmico-->

@endsection
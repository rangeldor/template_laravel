@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="" class="bred pl-0">Controle de Perfis</a>
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
                    <th>Perfil</th>
                    <th>Permissões</th>
                    <th width="250">Ações</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $teste = "";
                @endphp
                @forelse($perfis as $key => $perfil)
                <tr>
                    {{--  <td>
                        @if($user->image)
                        <img src="{{url("storage/users/{$user->image}")}}" alt="{{$user->id}}" style="max-width: 60px;">
                        @else
                        <img src="{{url('assets/panel/imgs/no-image.png')}}" alt="{{$user->id}}" style="max-width: 100px;">
                        @endif
                    </td> --}}
                    <td>
                        {{ $perfil->role_name }}
                    </td>
                    <td>
                       @foreach ($permissoes as $key2 => $per)
                          @if($perfil->role_id != $per->role_id)
                             @continue;
                          @endif    
                            @php
                             $teste .= $per->permission_name . "|";   
                            @endphp                                          
                       @endforeach
                       @php
                        $teste = substr($teste,0,strlen($teste)-1)
                       @endphp
                       {{ $teste }}
                    </td>
                    <td>
                        <a href="{{route('perfil.edit', $perfil->role_id)}}" class="edit rounded"><i class="fas fa-edit"></i> Editar</a>
                        <a href="{{route('perfil.show', $perfil->role_id)}}" class="delete rounded"><i class="fas fa-eye"></i> Visualizar</a>
                    </td>
                </tr>
                 @php
                  $teste = "";   
                 @endphp
                @empty
                
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <!--  <th>Imagem</th> -->
                    <th>Nome</th>
                    <th>Permissões</th>
                    <th width="250">Ações</th>
                </tr>
            </tfoot>
        </table>                
    </div>
</div>
<!--Content Dinâmico-->

@endsection
@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')

<div class="bred">    
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="{{route('perfil.index')}}" class="bred text-info pr-0">Controle de Perfis /</a>
    <a href="" class="bred pl-0">{{$role->name}}</a>
</div>

<div>
    <h1>Detalhes do Perfil: {{$role->name}}</h1>
</div>

<div class="container-fluid">
<div class="row card">
    <div class="card-body rounded shadow bg-light">
    <ul>
      {{--  <li>
            @if($user->image)
                <img src="{{url("storage/users/{$user->image}")}}" alt="{{$user->id}}" style="max-width: 60px;">
            @else
                <img src="{{url('assets/panel/imgs/no-image.png')}}" alt="{{$user->id}}" style="max-width: 100px;">
            @endif
        </li> --}}
        <li>
            <i class="fas fa-signature"></i> Nome: <strong>{{$role->name}}</strong>
        </li>   
    </ul>

@include('panel.includes.alerts')
@can('excluir')
{!! Form::open(['route' => ['perfil.destroy', $role->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
    <div class="form-group">
        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Perfil {{$role->name}}</button>
    </div>
{!! Form::close() !!}
@endcan
</div>
</div>
</div><!--Content Dinâmico-->

@endsection
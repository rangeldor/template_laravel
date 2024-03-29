@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    @role('Administrador')
    <a href="{{route('users.index')}}" class="bred text-info pr-0">Usuários /</a>
    @endrole
    <a href="" class="bred pl-0">Editar</a>
</div>

<div>
    <h1>Editar Usuário: {{ $user->name }}</h1>
</div>

<div class="container-fluid">
<div class="row card">
    <div class="card-body rounded shadow bg-light">
        <div class="col-12">
            <div class="messages">
                @include('panel.includes.alerts')
            </div>
        </div>

@include('panel.includes.errors')

{!! Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
    @include('panel.users.form')
{!! Form::close() !!}
</div>
</div>
</div><!--Content Dinâmico-->

@endsection
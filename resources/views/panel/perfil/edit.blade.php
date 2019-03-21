@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="{{route('perfil.index')}}" class="bred text-info pr-0">Perfis /</a>
    <a href="" class="bred pl-0">Editar</a>
</div>

<div>
    <h1>Editar Perfil: {{ $role->name }}</h1>
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

{!! Form::model($role, ['route' => ['perfil.update', $role->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
    @include('panel.perfil.form')
{!! Form::close() !!}
</div>
</div>
</div><!--Content Dinâmico-->

@endsection
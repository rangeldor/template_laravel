@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="{{route('users.index')}}" class="bred text-info pr-0">Usuários /</a>
    <a href="" class="bred pl-0">Cadastrar</a>
</div>

<div>
    <h1>Cadastrar Usuário</h1>
</div>

<div class="container-fluid">
<div class="row card">
    <div class="card-body rounded shadow bg-light">

@include('panel.includes.errors')

{!! Form::open(['route' => 'users.store', 'class' => 'was-validated col-lg-12 pt-4']) !!}
    @include('panel.users.form')
{!! Form::close() !!}
</div>
</div>
</div><!--Content Dinâmico-->


@endsection
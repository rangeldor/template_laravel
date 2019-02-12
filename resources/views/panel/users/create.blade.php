@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="{{route('users.index')}}" class="bred text-info pr-0">Usuários /</a>
    <a href="" class="bred pl-0">Cadastrar</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Cadastrar Usuário</h1>
</div>

<div class="">

@include('panel.includes.errors')

{!! Form::open(['route' => 'users.store', 'class' => 'form form-search form-ds']) !!}
    @include('panel.users.form')
{!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection
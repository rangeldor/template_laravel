@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home</a>
</div>

<div>
    <h1>Cadastrar Perfis</h1>
</div>

<div class="container-fluid">
    <div class="row card " >
        <div class="card-body rounded bg-light" style="box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(0,192,239,.4);">
            
            @include('panel.includes.errors')
            
            <div class="col-12">
                <div class="messages">
                    @include('panel.includes.alerts')
                </div>
            </div>
            
            {!! Form::open(['route' => 'perfil.store', 'class' => 'was-validated col-lg-12 pt-4']) !!}
            @include('panel.perfil.form')
            {!! Form::close() !!}
        </div>
    </div>
</div><!--Content Dinâmico-->

@endsection
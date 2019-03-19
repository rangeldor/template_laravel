@extends('site.layouts.app')

@section('content-site')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Acesso Negado</h3>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    Você não tem PERMISSÃO para acessar o conteúdo solicitado. <a href="{{ url('/') }}">Voltar</a>.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
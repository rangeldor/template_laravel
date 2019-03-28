@extends('adminlte::page')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card" >
                <div class="card-body rounded bg-light" style="padding: 0.5rem; box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(0,192,239,.4);">  
                    <h3>A página não existe</h3>                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content text-center">
    <img src="{{ url('assets/site/images/error-404.png') }}" alt="404">
</div>

@endsection

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="" class="bred pl-0">Dashboard</a>
</div>
@stop

@section('content')



@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


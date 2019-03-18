
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <div class="bred">
    <a href="{{route('panel')}}" class="bred text-info pr-0">Home /</a>
    <a href="" class="bred pl-0">Dashboard</a>
</div>
@stop

@section('content')

@role('super-admin')
    I am a super-admin!
@else
    I am not a super-admin...
@endrole

@can('edit articles')
teste permissao
@endcan

@endsection



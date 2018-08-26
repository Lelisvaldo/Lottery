@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>You are logged in!</p>
    <a class="btn btn-info" href="{{route('cliente.index')}}">Clientes</a>
@stop
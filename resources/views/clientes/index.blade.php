@extends('adminlte::page')

@section('title', 'Clientes Cadastrados')

@section('content_header')
    <h1>Clientes Cadastrados</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    {{ $dataTable->scripts() }}
@stop
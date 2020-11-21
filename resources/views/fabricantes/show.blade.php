@extends('adminlte::page')

@section('title', 'Fabricante.')

@section('content_header')
    <h1>Fabricante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Deseja mesmo excluir este fabricante?</h1>
            <h2>{{$fabricante->nome}}</h2>
            {!! Form::model($fabricante, ['route'=> ['fabricantes.destroy', $fabricante],'method'=> 'delete']) !!}
            {!! Form::submit('Sim', ['class' => 'btn btn-danger']) !!}
            {!! link_to_route('fabricantes.index', 'Cancelar',[],['class'=> 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
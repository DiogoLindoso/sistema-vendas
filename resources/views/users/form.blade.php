@extends('adminlte::page')

@section('title', 'Cadastrado de Usuário.')

@section('content_header')
    <h1>Cadastrado de Usuário.</h1>
@stop

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        {!! Form::open(['route' => 'users.store']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                @error('email')
                   <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                {!! Form::password('password',['class' => 'form-control']) !!}
                @error('password')
                   <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('type', 'Tipo de Usuário') !!}
                {!! Form::select('type', ['0'=>'Vendedor', '1'=>'Administrador'], null, ['class' => 'form-control']) !!}
                @error('type')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
          <!-- /.card-body -->
            <div class="card-footer">
                {!! Form::submit('Salvar',['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
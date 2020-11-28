@extends('adminlte::page')

@section('title', 'Cadastrado de Usuário.')

@section('content_header')
    <h1>Cadastrado de Usuário.</h1>
@stop

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        @if (isset($produto))
        {!!Form::model($produto, ['route' => ['produtos.update', $produto], 'method'=>'put'])!!}
        @else
        {!! Form::open(['route' => 'produtos.store']) !!}
        @endif
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('descricao', 'Descrição') !!}
                {!! Form::text('descricao', null, ['class' => 'form-control']) !!}
                @error('descricao')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('estoque', 'Estoque') !!}
                        {!! Form::number('estoque', null, ['class' => 'form-control']) !!}
                        @error('estoque')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('preco', 'Preco') !!}
                        {!! Form::text('preco', null, ['class' => 'form-control']) !!}
                        @error('preco')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('fabricante_id', 'Fabricante') !!}
                {!! Form::select('fabricante_id', [], null, ['class' => 'form-control']) !!}
                @error('fabricante_id')
                    <small class="form-text text-danger">{{$message}}</small>
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
<script>
    var selecionado = []
    @isset($produto)
        var produto = {
            id: '{{$produto->fabricante->id}}',
            text: '{{$produto->fabricante->nome}}',
            selected: true
        }
    selecionado.push(produto)
    @endisset
    $("#fabricante_id").select2({
        data: selecionado,
        ajax:{
            url: '{{route('fabricantes.select')}}',
            data: function(params) {
                return {pesquisa: params.term}
            },
            processResults: function(data){
                return{
                    results: data
                }
            }
        }
    });

</script>
@stop
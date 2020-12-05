@extends('adminlte::page')

@section('title', 'Cadastrado de Usuário.')

@section('content_header')
    <h1>Cadastrado de Venda.</h1>
@stop

@section('content')
    <div class="card card-primary">
        <!-- form start -->
        {!! Form::open(['route' => 'vendas.store','id'=>'formVenda']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('cliente_id', 'Cliente') !!}
                {!! Form::select('cliente_id',[], null, ['class' => 'form-control']) !!}
                @error('cliente_id')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('observacao', 'Observacao') !!}
                {!! Form::textarea('observacao', null, ['class' => 'form-control','rows' => 2]) !!}
                @error('observacao')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('forma_pagamento', 'Formas de pagamento') !!}
                {!! Form::select('forma_pagamento',$formasPagamento, null, ['class' => 'form-control']) !!}
                @error('forma_pagamento')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3>Total: <span id="txt-total">0.00</span></h3>
                </div>
                <div class="col-md-4">
                    <h3>Com Desconto: <span id="txt-desconto">0.00</span></h3>
                </div>
                <div class="col-md-4">
                    <h3>Com Acréscimo: <span id="txt-acrescimo">0.00</span></h3>
                </div>
            </div>            

        {!! Form::submit('Finalizar Venda',['class' => 'btn btn-primary']) !!}

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('produto', 'Produto') !!}
                    {!! Form::select('produto', [], null, ['class' => 'form-control']) !!}
                    @error('produto')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('qtd', 'Quantidade') !!}
                    {!! Form::number('qtd', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <label>Ação</label>
                <button class="btn btn-success" onclick="adicionarItem()">Adicionar Produto</button>
            </div>
    </div>
    <table class="table table-sm">
        <thead class="thead-dark">
          <tr>
            <th >Produto</th>
            <th >Quantidade</th>
            <th >Preço Unitario</th>
            <th >Total</th>
          </tr>
        </thead>
        <tbody id="tabelaItensVenda">
        </tbody>
      </table>

        {!! Form::close() !!}
    </div>
@stop

@section('css')
@stop

@section('js')
<script>
    $("#cliente_id").select2({
        ajax:{
            url: '{{route('clientes.select')}}',
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
    $("#produto").select2({
        ajax:{
            url: '{{route('produtos.select')}}',
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

    $('#formVenda').submit(function(e) {
        e.preventDefault()
    })

    var itemsVenda = []

    function adicionarItem() {
        let produtoId = $('#produto').val()
        let quantidade = $('#qtd').val()
        if (produtoId && quantidade) {
            let urlBase = '{{route('produtos.index')}}'

            axios.get(`${urlBase}/${produtoId}`)
            .then( ({data})=> {
                itemsVenda.push({
                    id: data.id,
                    descricao: data.descricao,
                    preco: data.preco,
                    quantidade: quantidade
                })
                atualizarTabela()
            }).catch(()=>{
                Swal.fire('Ops!','Erro ao selecionar o produto', 'error')
            })
        }else{
            Swal.fire('Ops!','Selecione o produto e informe a quantidade', 'error')
        }
    }

    var totalGeral = 0

    function atualizarTabela() {
        $('#tabelaItensVenda').empty()
        itemsVenda.forEach((produto, index)=>{
            let total = produto.preco * produto.quantidade
            totalGeral += total
            $('#tabelaItensVenda').append(`
            <tr>
                <th>
                    <input type="text" class="form-control" value="${produto.descricao}" disabled>
                    <input type="hidden" name="produto_id[]" value="${produto.id}" readonly>
                </th>
                <td>
                    <input type="text" class="form-control" name="quantidade[]" value="${produto.quantidade}" readonly>
                </td>
                <td><input type="text" class="form-control" value="${produto.preco}" disabled></td>
                <td><input type="text" class="form-control" value="${total.toFixed(2)}" disabled></td>
            </tr>`
            )
        })
    }

</script>
@stop
<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DataTables\ClienteDatatable;
use App\Fabricante;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /* Display a listing of the resource.
     *
     *@return \Illuminate\Http\Response
     */

    public function index(ClienteDatatable $clienteDataTable)
    {
        return $clienteDataTable->render('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = ClienteService::store($request);
        if ($cliente) {
            return redirect()->route('clientes.index')->withSucesso('Salvo com sucesso');
        }
        return redirect()->route('clientes.index')->withErro('Ocorreu um erro ao salvar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = ClienteService::update($request->all(), $cliente);
        if ($cliente) {
            return redirect()->route('clientes.index')->withSucesso('Atualizado com sucesso');
        }
        return redirect()->route('clientes.edit')->withErro('Ocorreu um erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente = ClienteService::destroy($cliente);
        return response($cliente, $cliente ? 200 : 400);
    }
}

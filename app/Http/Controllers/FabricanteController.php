<?php

namespace App\Http\Controllers;

use App\DataTables\FabricanteDatatable;
use App\Fabricante;
use App\Http\Requests\StoreFabricante;
use Illuminate\Http\Request;
use App\Services\FabricanteService;

class FabricanteController extends Controller
{
    /* Display a listing of the resource.
     *
     *@return \Illuminate\Http\Response
     */

    public function index(FabricanteDatatable $fabricanteDataTable)
    {
        return $fabricanteDataTable->render('fabricantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabricantes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFabricante $request)
    {
        $fabricante = FabricanteService::store($request);
        if ($fabricante) {
            return redirect()->route('fabricantes.index')->withSucesso('Salvo com sucesso');
        }
        return redirect()->route('fabricantes.index')->withErro('Ocorreu um erro ao salvar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante)
    {
        return view('fabricantes.show', compact('fabricante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.form', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFabricante $request, Fabricante $fabricante)
    {
        $fabricante = FabricanteService::update($request->all(), $fabricante);
        if ($fabricante) {
            return redirect()->route('fabricantes.index')->withSucesso('Atualizado com sucesso');
        }
        return redirect()->route('fabricantes.edit')->withErro('Ocorreu um erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabricante $fabricante)
    {
        $fabricante = FabricanteService::destroy($fabricante);
        if ($fabricante) {
            return redirect()->route('fabricantes.index')->withSucesso('Atualizado com sucesso');
        }
        return redirect()->route('fabricantes.index')->withErro('Ocorreu um erro ao atualizar');
    }
}

<?php

namespace App\DataTables;

use App\Venda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($user) {
                $acoes = link_to_route('users.edit', 'editar', $user, ['class' => 'btn btn-primary btn-sm']);
                $acoes .= link_to_route('users.show', 'excluir', $user, ['class' => 'btn btn-danger btn-sm ml-1']);
            return $acoes;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\VendaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Venda $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('vendadatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
            Column::make('cliente_id'),
            Column::make('forma_pagamento'),
            Column::make('total'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Venda_' . date('YmdHis');
    }
}

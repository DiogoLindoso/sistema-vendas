<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $fillable = [
        'venda_id', 'produto_id', 'quantidade', 'valor_unitario', 'valor_total'
    ];
}

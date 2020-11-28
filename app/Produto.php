<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'stoque', 'preco', 'fabricante_id',
    ];

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }
}

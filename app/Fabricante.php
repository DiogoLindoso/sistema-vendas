<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $fillable = [
        'nome', 'site'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}

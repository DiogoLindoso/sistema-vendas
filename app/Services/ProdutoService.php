<?php

namespace App\Services;

use App\Produto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ProdutoService
{

    public static function store($request)
    {
        try {
            return Produto::create($request->all());
        } catch (Throwable $th) {
            
            Log::error($th->getMessage(), [
                'HashId' => (string) Str::uuid(),
                'message' => 'Erro ao salvar'
            ]);
            return null;
        }
    }
    public static function update($request, $fabricante)
    {
        try {
            return $fabricante->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
    public static function destroy($fabricante)
    {
        try {
            return $fabricante->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
}

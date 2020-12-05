<?php

namespace App\Services;

use App\Venda;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class VendaService
{

    public static function store($request)
    {
        try {
            return Venda::create($request->all());
        } catch (Throwable $th) {
            Log::error($th->getMessage(), [
                'HashId' => (string) Str::uuid(),
                'message' => 'Erro ao salvar'
            ]);
            return null;
        }
    }
    public static function update($request, $venda)
    {
        try {
            return $venda->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
    public static function destroy($venda)
    {
        try {
            return $venda->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
}

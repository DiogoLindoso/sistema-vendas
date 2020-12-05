<?php

namespace App\Services;

use App\Cliente;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ClienteService
{

    public static function store($request)
    {
        try {
            return Cliente::create($request->all());
        } catch (Throwable $th) {
            Log::error($th->getMessage(), [
                'HashId' => (string) Str::uuid(),
                'message' => 'Erro ao salvar'
            ]);
            return null;
        }
    }
    public static function update($request, $user)
    {
        try {
            return $user->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
    public static function destroy($user)
    {
        try {
            return $user->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
}

<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserService
{

    public static function store($request)
    {
        try {
            return User::create($request->all());
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'HashId' => (string) Str::uuid(),
                'message' => 'Erro ao salvar'
            ]);
            return null;
        }
    }
}

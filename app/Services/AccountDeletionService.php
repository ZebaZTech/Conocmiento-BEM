<?php

namespace App\Services;

use App\Models\AccountDeletion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AccountDeletionService
{
    /**
     * Elimina la cuenta del usuario y sus datos personales conforme a la
     * Ley 1581 de 2012.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user): void {
            $user->testimonials()->update([
                'name' => 'Usuario eliminado',
                'initials' => 'UE',
                'user_id' => null,
            ]);

            $user->contactMessages()->update([
                'name' => 'Usuario eliminado',
                'email' => 'eliminado-'.$user->id.'@anonimo.invalid',
                'message' => '[contenido eliminado por solicitud del titular]',
                'user_id' => null,
            ]);

            AccountDeletion::create([
                'user_hash' => hash('sha256', mb_strtolower($user->email)),
                'deleted_at' => now(),
            ]);

            $user->delete();
        });
    }
}

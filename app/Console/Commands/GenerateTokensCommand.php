<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateTokensCommand extends Command
{
    protected $signature = 'tokens:generate';

    protected $description = 'Genera tokens para un usuario admin y un usuario normal';

    public function handle()
    {
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->first();

        if (!$admin || !$user) {
            $this->error('No se encontraron usuarios con los roles especificados.');
            return;
        }

        $adminToken = $admin->createToken('AdminToken')->plainTextToken;
        $userToken = $user->createToken('UserToken')->plainTextToken;

        $this->info("Admin Token: $adminToken");
        $this->info("User Token: $userToken");
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {email} {password}';
    protected $description = 'Réinitialiser le mot de passe d\'un administrateur';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $admin = User::where('email', $email)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            $this->error('Administrateur non trouvé !');
            return 1;
        }

        $admin->password = Hash::make($password);
        $admin->save();

        $this->info('Mot de passe administrateur mis à jour avec succès !');
        return 0;
    }
} 
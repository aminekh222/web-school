<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SetupDefaultAvatar extends Command
{
    protected $signature = 'setup:default-avatar';
    protected $description = 'Configure l\'avatar par défaut pour les utilisateurs';

    public function handle()
    {
        // Créer le dossier profile-photos s'il n'existe pas
        if (!Storage::disk('public')->exists('profile-photos')) {
            Storage::disk('public')->makeDirectory('profile-photos');
        }

        // Copier l'image par défaut depuis resources vers storage/app/public
        $sourcePath = resource_path('images/default-avatar.jpg');
        $destinationPath = storage_path('app/public/profile-photos/default-avatar.jpg');

        if (!File::exists($sourcePath)) {
            $this->error('L\'image default-avatar.jpg n\'existe pas dans le dossier resources/images !');
            return 1;
        }

        File::copy($sourcePath, $destinationPath);
        $this->info('Avatar par défaut configuré avec succès !');

        return 0;
    }
} 
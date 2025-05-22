<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Création d'un étudiant par défaut
        User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        // L'administrateur est déjà créé dans la base de données
        // Pas besoin de le recréer ici

        $this->call([
            ClassroomSeeder::class,
        ]);
    }
}

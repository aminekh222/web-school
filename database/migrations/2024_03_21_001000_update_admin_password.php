<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'admin@gmail.com')
            ->update([
                'password' => Hash::make('password')
            ]);
    }

    public function down(): void
    {
        // Pas de rollback nécessaire pour cette migration
    }
}; 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attestations', function (Blueprint $table) {
            $table->id();
            $table->string('numero_attestation')->unique();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('type_attestation'); // scolarité, réussite, etc.
            $table->text('contenu');
            $table->date('date_emission');
            $table->string('statut')->default('en_attente'); // en_attente, validée, rejetée
            $table->string('fichier_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->enum('day_of_week', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']);
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('semester', ['1', '2']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}; 
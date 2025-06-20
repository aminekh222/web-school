<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('type')->after('value'); // exemple: "exam", "test", etc.
            $table->tinyInteger('semester')->after('type'); // 1, 2, etc.
        });
    }

    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn(['type', 'semester']);
        });
    }
};

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
    Schema::table('entretiens', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(); // pas de contrainte pour l'instant
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entretiens', function (Blueprint $table) {
            //
        });
    }
};

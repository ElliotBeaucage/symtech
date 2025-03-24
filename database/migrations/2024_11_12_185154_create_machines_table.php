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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->nullable();
            $table->string("type")->nullable();
            $table->string("marque")->nullable();
            $table->string("modele")->nullable();
            $table->string("serie")->nullable();
            $table->string("courroie")->nullable();
            $table->string("filtres")->nullable();
            $table->string("freon")->nullable();
            $table->string("description")->nullable();
            $table->foreignId('building_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};


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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();

            $table->boolean('f1')->default(false);
            $table->boolean('v1')->default(false);
            $table->boolean('v2')->default(false);
            $table->boolean('v3')->default(false);
            $table->boolean('v4')->default(false);
            $table->boolean('v5')->default(false);
            $table->string('description')->nullable();
            $table->string('image'); // Chemin de la signature (image)
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
        Schema::dropIfExists('entretiens');
    }
};

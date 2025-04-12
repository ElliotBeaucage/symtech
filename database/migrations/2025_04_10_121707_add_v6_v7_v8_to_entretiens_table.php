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
            $table->boolean('v6')->default(false)->after('v5');
            $table->boolean('v7')->default(false)->after('v6');
            $table->boolean('v8')->default(false)->after('v7');
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

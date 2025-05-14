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
        Schema::create('orario_prestazioni', function(Blueprint $table){
            $table->foreign('tipologia_prestazione')->references('tipologia')->on('prestazione');
            $table->foreign('orario')->references('valore_orario')->on('orari');
            $table->primary(['tipologia_prestazione','orario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orario_prestazioni');
    }
};

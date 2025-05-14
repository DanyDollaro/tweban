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
        Schema::create('giorni_prestazioni', function(Blueprint $table){
            $table->foreign('tipologia_prestazione')->references('tipologia')->on('prestazione');
            $table->foreign('giorno')->references('valore_giorno')->on('giorni_settimana');
            $table->primary(['tipologia_prestazione','giorno']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giorni_prestazioni');
    }
};

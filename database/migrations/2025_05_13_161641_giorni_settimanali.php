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
        Schema::create('giorni_settimana', function(Blueprint $table){
            $table->enum('valore_giorno', ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì','Venerdì'])->primary();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giorni_settimana');
    }
};

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
        Schema::create('medico', function(Blueprint $table){
            $table->string('codice_fiscale', 16)->primary();
            $table->string('nome',30);
            $table->string('cognome',30);
            $table->string('email',100)->unique();
            $table->string('password',255);
            $table->string('prestazione_assegnata',100)->nullable();
            $table->foreign('prestazione_assegnata')->references('tipologia')->on('prestazione')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico');
    }
};
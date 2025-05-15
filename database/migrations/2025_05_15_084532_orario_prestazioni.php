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
            $table->string('tipologia_prestazione',100);
            $table->foreign('tipologia_prestazione')->references('tipologia')->on('prestazione')->onUpdate('cascade')->onDelete('cascade');
            $table->time('orario');
            $table->foreign('orario')->references('valore_orario')->on('orari')->onUpdate('cascade')->onDelete('cascade');
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
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
        Schema::create('prenotazione', function(Blueprint $table){
            $table->id();
            $table->date('data_prenotazione')->nullable();
            $table->time('orario_prenotazione')->nullable();
            $table->enum('giorno_escluso', ['lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi'])->nullable();
             // Cliente
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // Staff
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('tipologia_prestazione',100);
            $table->foreign('tipologia_prestazione')->references('tipologia')->on('prestazione')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('stato', ['in_attesa', 'accettata', 'rifiutata'])->default('in_attesa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenotazione');
    }
};

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
            $table->date('data_prenotazione');
            $table->enum('giorno_escluso', ['lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi']);
            $table->string('cf_cliente',16);
            $table->foreign('cf_cliente')->references('codice_fiscale')->on('cliente')->onUpdate('cascade')->onDelete('cascade');
            $table->string('mail_staff',100)->nullable();
            $table->foreign('mail_staff')->references('business_mail')->on('membro_staff')->onUpdate('cascade')->onDelete('set null');
            $table->string('tipologia_prestazione',100);
            $table->foreign('tipologia_prestazione')->references('tipologia')->on('prestazione')->onDelete('cascade')->onUpdate('cascade');
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

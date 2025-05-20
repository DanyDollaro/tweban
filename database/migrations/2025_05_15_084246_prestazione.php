<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('prestazione', function(Blueprint $table){
            $table->string('tipologia', 100)->primary();
            $table->string('prescrizione',1000);
            $table->string('descrizione',2000);
            $table->string('sp_dipartimento',100);
            $table->foreign('sp_dipartimento')->references('specializzazione')->on('dipartimento')->onDelete('cascade')->onUpdate('cascade');
            $table->string('mail_staff',100)->nullable();
            $table->foreign('mail_staff')->references('business_mail')->on('membro_staff');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('prestazione');
    }
};

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
            $table->string('descrizione',2000);
            $table->foreign('sp_dipartimento')->references('specializzazione')->on('dipartimento');
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

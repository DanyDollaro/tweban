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
        Schema::create('users', function (Blueprint $table){
            $table->id();
            $table->string('username')->unique();
            $table->string('nome');
            $table->string('cognome');
            $table->string('codice_fiscale')->unique();
            $table->date('data_nascita');
            $table->string('telefono')->unique();
            $table->string('email')->unique();
            $table->string('indirizzo');
            $table->string('password');
            $table->enum('ruolo',['cliente','staff','admin'])->default('cliente'); // 👈 Campo ruolo con valore predefinito
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

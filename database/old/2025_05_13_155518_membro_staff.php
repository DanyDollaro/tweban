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
        Schema::create('membro_staff', function (Blueprint $table){
            $table->string('business_mail',100)->primary();
            $table->string('nome', 30);
            $table->string('cognome',30);
            $table->string('username', 50)->unique();
            $table->string('password',255);
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('membro_staff');
    }
};

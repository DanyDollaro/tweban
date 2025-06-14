<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // destinatario notifica
        // Chiave esterna verso 'prenotazione' (al singolare)
        $table->unsignedBigInteger('prenotazione_id')->nullable();
        $table->foreign('prenotazione_id')
                ->references('id')
                ->on('prenotazione') // <- usa il nome corretto
                ->onDelete('set null'); // se la prenotazione viene cancellata, la notifica non viene eliminata ma il campo prenotazione_id diventa null
        $table->string('type'); // tipo notifica, es: "prenotazione_modificata"
        $table->text('message'); // testo notifica
        $table->boolean('is_read')->default(false); // flag per lettura (default: non letta)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // Contoh: Meeting Klien Laundry
            $table->string('location')->nullable(); // Contoh: Warkop A
            $table->time('time');               // Contoh: 14:00
            $table->date('date');               // Tanggal agenda
            $table->enum('priority', ['normal', 'high', 'critical'])->default('normal');
            $table->boolean('is_completed')->default(false); // Status selesai/belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};

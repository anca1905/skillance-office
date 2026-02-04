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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nama Project
            $table->string('platform');             // Android, Web GIS, dll
            $table->string('client_name');          // Putri, Nurliana
            $table->string('client_contact');       // No HP untuk WA
            $table->string('client_institution')->nullable(); // PT Damai Jaya / Mahasiswa
            $table->date('deadline');
            $table->string('status');               // Development, Testing, Selesai
            $table->string('payment_status');       // DP, Lunas, Belum Bayar
            $table->string('demo_link')->nullable(); // Link demo (bisa kosong)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

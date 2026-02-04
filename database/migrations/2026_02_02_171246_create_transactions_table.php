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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date');
            $table->string('description');          // Pelunasan Sistem Pakar
            $table->string('category')->nullable(); // Klien: Andi, Hosting, dll
            $table->enum('type', ['income', 'expense']); // Pemasukan / Pengeluaran
            $table->bigInteger('amount');           // Nominal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

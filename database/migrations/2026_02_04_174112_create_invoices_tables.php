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
        // Tabel Kepala Invoice
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number'); // No. INV/2026/001
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null'); // Opsional, bisa invoice lepas
            $table->string('client_name');    // Nama Klien (Backup jika project dihapus)
            $table->string('client_address')->nullable();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('status')->default('UNPAID'); // UNPAID, PAID
            $table->timestamps();
        });

        // Tabel Item Invoice
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->string('description'); // Cth: Jasa Pembuatan Web
            $table->integer('qty');
            $table->bigInteger('price');   // Harga Satuan
            $table->bigInteger('total');   // qty * price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_tables');
    }
};

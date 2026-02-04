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
        Schema::create('project_documentations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('title');        // Misal: Halaman Login
            $table->string('image_path');   // Lokasi file screenshot
            $table->text('description');    // Penjelasan (Fungsi & Cara Kerja)
            $table->integer('sort_order')->default(0); // Urutan halaman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_documentations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_certificate', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->date('tanggal_terbit')->nullable();
            $table->string('diterbitkan_oleh')->nullable();
            $table->string('gambar_serti')->nullable();
            $table->string('id_kredensial')->nullable();
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('data_alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_certificate');
    }
};

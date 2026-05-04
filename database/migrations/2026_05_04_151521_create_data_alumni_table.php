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
        Schema::create('data_alumni', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('email')->unique();
            $table->string('no_telepon')->nullable();
            $table->string('lama_tunggu_kerja')->nullable();
            $table->date('tahun_lulus')->nullable();
            $table->string('jabatan_sekarang')->nullable();
            $table->string('foto_profile')->nullable();
            $table->string('foto_sampul')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alumni');
    }
};

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
        Schema::create('data_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama_perusahaan');
            $table->string('status_pekerjaan');
            $table->string('jobdesk')->nullable();
            $table->date('tahun_masuk')->nullable();
            $table->date('tahun_selesai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('logo_perusahaan')->nullable();
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('data_alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pekerjaan');
    }
};

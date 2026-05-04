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
        Schema::create('media_sosial', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama_platform');
            $table->string('link_medsos');
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('data_alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_sosial');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambah kolom show_email dan show_telepon ke tabel data_alumni
     * agar alumni bisa mengatur visibilitas kontak di halaman publik (biodata).
     */
    public function up(): void
    {
        Schema::table('data_alumni', function (Blueprint $table) {
            $table->boolean('show_email')->default(false)->after('email')
                  ->comment('Apakah email ditampilkan ke publik');
            $table->boolean('show_telepon')->default(false)->after('no_telepon')
                  ->comment('Apakah no HP ditampilkan ke publik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_alumni', function (Blueprint $table) {
            $table->dropColumn(['show_email', 'show_telepon']);
        });
    }
};
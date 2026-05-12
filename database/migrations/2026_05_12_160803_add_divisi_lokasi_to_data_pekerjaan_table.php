<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pekerjaan', function (Blueprint $table) {
            $table->string('divisi')->nullable()->after('jobdesk');
            $table->string('lokasi')->nullable()->after('divisi');
        });
    }

    public function down(): void
    {
        Schema::table('data_pekerjaan', function (Blueprint $table) {
            $table->dropColumn(['divisi', 'lokasi']);
        });
    }
};

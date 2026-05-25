<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Index untuk query filter prodi (sering dipakai di semua controller)
        Schema::table('data_alumni', function (Blueprint $table) {
            if (!$this->indexExists('data_alumni', 'data_alumni_prodi_index')) {
                $table->index('prodi', 'data_alumni_prodi_index');
            }
            if (!$this->indexExists('data_alumni', 'data_alumni_angkatan_index')) {
                $table->index('angkatan', 'data_alumni_angkatan_index');
            }
        });

        // Index untuk join dan filter di data_pekerjaan
        Schema::table('data_pekerjaan', function (Blueprint $table) {
            if (!$this->indexExists('data_pekerjaan', 'data_pekerjaan_nim_index')) {
                $table->index('nim', 'data_pekerjaan_nim_index');
            }
            if (!$this->indexExists('data_pekerjaan', 'data_pekerjaan_tahun_masuk_index')) {
                $table->index('tahun_masuk', 'data_pekerjaan_tahun_masuk_index');
            }
        });

        // Index untuk users
        Schema::table('users', function (Blueprint $table) {
            if (!$this->indexExists('users', 'users_role_index')) {
                $table->index('role', 'users_role_index');
            }
        });
    }

    public function down(): void
    {
        Schema::table('data_alumni', function (Blueprint $table) {
            $table->dropIndexIfExists('data_alumni_prodi_index');
            $table->dropIndexIfExists('data_alumni_angkatan_index');
        });

        Schema::table('data_pekerjaan', function (Blueprint $table) {
            $table->dropIndexIfExists('data_pekerjaan_nim_index');
            $table->dropIndexIfExists('data_pekerjaan_tahun_masuk_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndexIfExists('users_role_index');
        });
    }

    private function indexExists(string $table, string $index): bool
    {
        return collect(\Illuminate\Support\Facades\DB::select("SHOW INDEX FROM `{$table}`"))
            ->pluck('Key_name')
            ->contains($index);
    }
};

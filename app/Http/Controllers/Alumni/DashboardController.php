<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $nim = Auth::user()->username;

        $relations = [
            'pekerjaan'         => fn($q) => $q->orderByRaw('tahun_masuk IS NULL ASC')->orderBy('tahun_masuk', 'desc'),
            'riwayatPendidikan' => fn($q) => $q->orderByRaw('tahun_masuk IS NULL ASC')->orderBy('tahun_masuk', 'desc'),
            'sertifikasi'       => fn($q) => $q->orderBy('tanggal_terbit', 'desc'),
            'mediaSosial',
        ];

        $alumni = DataAlumni::with($relations)->firstOrCreate(
            ['nim' => $nim],
            ['nama' => Auth::user()->username]
        );

        // Jika baru dibuat (firstOrCreate), relasi belum ter-load — load sekali saja
        if (!$alumni->relationLoaded('pekerjaan')) {
            $alumni->load($relations);
        }

        return response(view('Alumni.dashboard', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
}
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

        $alumni = DataAlumni::with([
            'pekerjaan',
            'riwayatPendidikan',
            'sertifikasi',
            'mediaSosial',
        ])->firstOrCreate(
            ['nim' => $nim],
            ['nama' => Auth::user()->username]
        );

        $alumni->load(['pekerjaan', 'riwayatPendidikan', 'sertifikasi', 'mediaSosial']);

        return response(view('Alumni.dashboard', compact('alumni')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
}

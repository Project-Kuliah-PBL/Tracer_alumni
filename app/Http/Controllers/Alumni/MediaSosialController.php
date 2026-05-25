<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use App\Models\DataAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaSosialController extends Controller
{
    /**
     * Tampilkan daftar media sosial alumni.
     * (Biasanya diload via dashboard/profil, bisa juga sebagai standalone)
     */
    public function index()
    {
        $nim       = Auth::user()->username;
        $alumni    = DataAlumni::where('nim', $nim)->firstOrFail();
        $mediaSosial = MediaSosial::where('nim', $nim)->get();

        return response(view('Alumni.dashboard', compact('alumni', 'mediaSosial')))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }

    /**
     * Simpan media sosial baru.
     */
    public function store(Request $request)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'link_medsos'   => 'required|url|max:500',
        ], [
            'nama_platform.required' => 'Nama platform tidak boleh kosong.',
            'link_medsos.required'   => 'Link media sosial tidak boleh kosong.',
            'link_medsos.url'        => 'Link media sosial harus berupa URL yang valid (contoh: https://...).',
        ]);

        MediaSosial::create([
            'nim'           => $nim,
            'nama_platform' => $request->nama_platform,
            'link_medsos'   => $request->link_medsos,
        ]);
        cache()->forget('alumni_filter_options');
        return redirect()->back()->with('success', 'Media sosial berhasil ditambahkan.');
    }

    /**
     * Update media sosial.
     */
    public function update(Request $request, int $id)
    {
        $nim = Auth::user()->username;

        $request->validate([
            'nama_platform' => 'required|string|max:100',
            'link_medsos'   => 'required|url|max:500',
        ], [
            'nama_platform.required' => 'Nama platform tidak boleh kosong.',
            'link_medsos.url'        => 'Link media sosial harus berupa URL yang valid.',
        ]);

        $medsos = MediaSosial::where('id', $id)->where('nim', $nim)->firstOrFail();
        $medsos->update($request->only(['nama_platform', 'link_medsos']));
        cache()->forget('alumni_filter_options');
        return redirect()->route('alumni.dashboard')->with('success_popup', 'Media sosial berhasil diperbarui.');
    }

    /**
     * Hapus media sosial.
     */
    public function destroy(int $id)
    {
        $nim    = Auth::user()->username;
        $medsos = MediaSosial::where('id', $id)->where('nim', $nim)->firstOrFail();
        $medsos->delete();
        cache()->forget('alumni_filter_options');
        return redirect()->back()->with('success', 'Media sosial berhasil dihapus.');
    }

    /**
     * Bulk update 4 platform tetap (LinkedIn, GitHub, Portfolio, Instagram).
     * Dipanggil dari form modal social di dashboard.
     *
     * Payload: platforms[linkedin][id], platforms[linkedin][link], dst.
     */
    public function bulkUpdate(Request $request)
    {
        $nim = Auth::user()->username;

        // Map: key form => nama_platform yang akan disimpan ke DB
        $platformMap = [
            'linkedin'  => 'LinkedIn',
            'github'    => 'GitHub',
            'portfolio' => 'Portfolio',
            'instagram' => 'Instagram',
            'tiktok'    => 'TikTok',
            'x'         => 'X',
        ];

        $request->validate([
            'platforms.linkedin.link'  => 'nullable|url|max:500',
            'platforms.github.link'    => 'nullable|url|max:500',
            'platforms.portfolio.link' => 'nullable|url|max:500',
            'platforms.instagram.link' => 'nullable|url|max:500',
            'platforms.tiktok.link'    => 'nullable|url|max:500',
            'platforms.x.link'         => 'nullable|url|max:500',
        ], [
            '*.url' => 'Link harus berupa URL yang valid (contoh: https://...).',
        ]);

        foreach ($platformMap as $key => $label) {
            $data = $request->input("platforms.$key");
            $link = trim($data['link'] ?? '');
            $id   = !empty($data['id']) ? (int) $data['id'] : null;

            if ($id) {
                $medsos = MediaSosial::where('id', $id)->where('nim', $nim)->first();
                if ($medsos) {
                    if ($link === '') {
                        // Link dikosongkan → hapus record
                        $medsos->delete();
                    } else {
                        $medsos->update(['link_medsos' => $link]);
                    }
                }
            } elseif ($link !== '') {
                // Record belum ada, buat baru
                MediaSosial::create([
                    'nim'           => $nim,
                    'nama_platform' => $label,
                    'link_medsos'   => $link,
                ]);
            }
        }

        cache()->forget('alumni_filter_options');
        return redirect()->route('alumni.dashboard')->with('success_popup', 'Media sosial berhasil diperbarui.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportAlumniController extends Controller
{
    public function store(Request $request)
    {
        // Naikkan memory dan hapus time limit untuk proses import
        ini_set('memory_limit', '512M');
        set_time_limit(0); // import bisa memakan waktu lebih dari 30 detik untuk file besar

        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv,text/plain|max:10240',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.mimes'    => 'Format file harus xlsx, xls, atau csv.',
            'file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $import = new AlumniImport();

        Excel::import($import, $request->file('file'));

        // Hitung lama tunggu kerja setelah semua baris selesai diproses
        // (dipisah dari loop import agar tidak boros memori)
        $import->recalculateLamaTunggu();

        $pesan = "Import selesai: {$import->imported} data baru, {$import->updated} diperbarui, {$import->skipped} dilewati.";

        if (!empty($import->errors)) {
            $pesan .= ' Beberapa baris gagal: ' . implode('; ', array_slice($import->errors, 0, 3));
        }
        cache()->forget('alumni_filter_options');
        return redirect()->route('admin.kelola_akun')->with('success', $pesan);
        
    }
}

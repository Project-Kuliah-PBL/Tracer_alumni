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
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.mimes'    => 'Format file harus xlsx, xls, atau csv.',
            'file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $import = new AlumniImport();

        Excel::import($import, $request->file('file'));

        $pesan = "Import selesai: {$import->imported} data baru, {$import->updated} diperbarui, {$import->skipped} dilewati.";

        if (!empty($import->errors)) {
            $pesan .= ' Beberapa baris gagal: ' . implode('; ', array_slice($import->errors, 0, 3));
        }

        return redirect()->route('admin.kelola_akun')->with('success', $pesan);
    }
}

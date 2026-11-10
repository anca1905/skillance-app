<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        // Validasi form HTML biasa
        $request->validate([
            'nik' => 'required|numeric|digits:16',
            'nama' => 'required|string|max:150',
            'whatsapp' => 'required|string|max:20',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string|max:500',
        ]);

        $kodeUnik = 'SRT-' . date('Y') . '-' . rand(1000, 9999);

        // Simulasi sukses & redirect ke halaman tracking
        return redirect()->route('surat.track', ['resi' => $kodeUnik])
            ->with('success', 'Permohonan surat berhasil dikirim! Kode resi Anda: ' . $kodeUnik);
    }

    public function track(Request $request)
    {
        $resi = $request->input('resi');
        return view('surat.track', compact('resi'));
    }

    public function downloadPdf($id)
    {
        // Contoh download / stream PDF via dompdf
        return view('pdf.surat_keterangan_domisili');
    }
}

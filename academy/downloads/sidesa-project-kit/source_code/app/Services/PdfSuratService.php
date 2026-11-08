<?php

namespace App\Services;

use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PdfSuratService
{
    /**
     * Generate Surat Resmi Format PDF dengan QR Code dan Tanda Tangan Digital
     */
    public function generate(PengajuanSurat $surat)
    {
        $penduduk = $surat->penduduk;
        $kk = $penduduk->kartuKeluarga;
        $jenis = $surat->jenisSurat;

        // Generate QR Code data URL
        $verifyUrl = route('surat.verifikasi-qr', ['token' => $surat->qr_token]);
        $qrCodeBase64 = base64_encode(QrCode::format('svg')->size(120)->errorCorrection('H')->generate($verifyUrl));

        $viewName = match ($jenis->kode_surat) {
            'SKD' => 'pdf.surat_keterangan_domisili',
            'SKU' => 'pdf.surat_keterangan_usaha',
            default => 'pdf.surat_keterangan_domisili'
        };

        $pdf = Pdf::loadView($viewName, [
            'surat' => $surat,
            'penduduk' => $penduduk,
            'kk' => $kk,
            'jenis' => $jenis,
            'qrCode' => $qrCodeBase64,
            'verifyUrl' => $verifyUrl,
            'kadesName' => 'H. Suryadi, S.Sos',
            'tglCetak' => date('d F Y')
        ])->setPaper('a4', 'portrait');

        $fileName = 'surat_' . strtolower($jenis->kode_surat) . '_' . $surat->kode_tracking . '.pdf';
        $path = 'public/surat/' . $fileName;
        Storage::put($path, $pdf->output());

        $surat->update([
            'pdf_file' => $fileName,
            'tanggal_selesai' => now(),
            'status' => 'selesai'
        ]);

        return $fileName;
    }
}

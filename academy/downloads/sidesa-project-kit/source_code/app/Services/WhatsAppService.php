<?php

namespace App\Services;

use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WhatsAppService
{
    /**
     * Kirim notifikasi pengajuan masuk ke warga
     */
    public static function kirimNotifPengajuan(PengajuanSurat $surat)
    {
        $warga = $surat->penduduk;
        if (empty($warga->whatsapp)) return;

        $msg = "Halo Kak {$warga->nama}! 👋

Permohonan *{$surat->jenisSurat->nama_surat}* Anda telah berhasil diajukan dengan Kode Tracking:
*{$surat->kode_tracking}*

Anda dapat memantau status surat secara realtime di: " . url('/tracking/' . $surat->kode_tracking) . "

Terima kasih! - Pemerintah Desa Sukamaju.";
        self::kirim($warga->whatsapp, $msg, $surat->kode_tracking);
    }

    /**
     * Kirim notifikasi surat telah selesai ditandatangani
     */
    public static function kirimNotifSelesai(PengajuanSurat $surat)
    {
        $warga = $surat->penduduk;
        if (empty($warga->whatsapp)) return;

        $msg = "Halo Kak {$warga->nama}! 🎉

Kabar baik! Permohonan *{$surat->jenisSurat->nama_surat}* dengan Nomor Resmi:
*{$surat->nomor_surat_resmi}*
telah SELESAI ditandatangani oleh Kepala Desa.

Dokumen PDF resmi ber-QR Code dapat langsung Anda unduh di:
" . url('/surat/download-pdf/' . $surat->kode_tracking) . "

Salam hangat, Kantor Desa Sukamaju.";
        self::kirim($warga->whatsapp, $msg, $surat->kode_tracking);
    }

    public static function kirim($noWa, $pesan, $kodeTracking = null)
    {
        $gatewayUrl = env('WA_GATEWAY_URL', 'http://127.0.0.1:3000/send');
        $status = 'simulasi';

        try {
            $resp = Http::timeout(3)->post($gatewayUrl, [
                'phone' => $noWa,
                'message' => $pesan
            ]);
            if ($resp->successful()) {
                $status = 'terkirim';
            }
        } catch (\Exception $e) {
            Log::warning("WA Gateway Offline: " . $e->getMessage());
        }

        // Catat di wa_logs
        DB::table('wa_logs')->insert([
            'no_wa' => $noWa,
            'nama_penerima' => 'Warga',
            'kode_tracking' => $kodeTracking,
            'pesan' => $pesan,
            'status' => $status,
            'sent_at' => now()
        ]);
    }
}

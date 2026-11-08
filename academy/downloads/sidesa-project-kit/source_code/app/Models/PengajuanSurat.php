<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'kode_tracking',
        'nik',
        'jenis_surat_id',
        'keperluan',
        'keterangan_tambahan',
        'status',
        'nomor_surat_resmi',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'petugas_id',
        'catatan_petugas',
        'pdf_file',
        'qr_token'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public static function generateTrackingCode()
    {
        return 'TRX-DS-' . date('Y') . '-' . mt_rand(1000, 9999);
    }
}

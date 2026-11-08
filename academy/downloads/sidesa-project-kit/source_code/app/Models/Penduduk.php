<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'status_kawin',
        'pekerjaan',
        'kewarganegaraan',
        'golongan_darah',
        'status_hubungan',
        'status_hidup',
        'status_tinggal',
        'whatsapp'
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'nik', 'nik');
    }
}

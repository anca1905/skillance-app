<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Domisili</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.5; margin: 30px 45px; }
        .kop-table { width: 100%; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 18px; }
        .kop-logo { width: 75px; text-align: center; }
        .kop-text { text-align: center; }
        .kop-pemerintah { font-size: 14pt; font-weight: bold; text-transform: uppercase; margin: 0; }
        .kop-desa { font-size: 16pt; font-weight: bold; text-transform: uppercase; margin: 0; }
        .kop-alamat { font-size: 9.5pt; font-style: italic; margin-top: 3px; }
        .judul-surat { text-align: center; margin-bottom: 20px; }
        .judul-surat h3 { font-size: 13pt; text-decoration: underline; margin: 0; text-transform: uppercase; }
        .judul-surat p { font-size: 11pt; margin: 2px 0 0 0; }
        .tabel-isi { width: 100%; margin: 15px 0; border-collapse: collapse; }
        .tabel-isi td { padding: 4px 6px; vertical-align: top; }
        .ttd-table { width: 100%; margin-top: 35px; }
        .ttd-qr { text-align: center; width: 45%; }
        .ttd-pejabat { text-align: center; width: 55%; }
        .qr-box { display: inline-block; padding: 5px; border: 1px dashed #999; margin: 8px 0; }
        .watermark { font-size: 8pt; color: #888; text-align: center; margin-top: 25px; border-top: 1px solid #ccc; padding-top: 4px; }
    </style>
</head>
<body>
    <!-- KOP SURAT PEMERINTAH DESA -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Lambang_Kabupaten_Kolaka.png/120px-Lambang_Kabupaten_Kolaka.png" width="70" alt="Logo Garuda/Pemda">
            </td>
            <td class="kop-text">
                <div class="kop-pemerintah">PEMERINTAH KABUPATEN SEJAHTERA<br>KECAMATAN MAKMUR</div>
                <div class="kop-desa">KANTOR KEPALA DESA SUKAMAJU</div>
                <div class="kop-alamat">Alamat: Jl. Poros Desa Sukamaju No. 01, Kode Pos 93561 &bull; Email: pemdes@sukamaju.desa.id</div>
            </td>
        </tr>
    </table>

    <!-- JUDUL SURAT RESMI -->
    <div class="judul-surat">
        <h3>SURAT KETERANGAN DOMISILI</h3>
        <p>Nomor: {{ $surat->nomor_surat_resmi ?? '470 / 042 / DS-SM / 2026' }}</p>
    </div>

    <!-- ISI SURAT -->
    <p>Yang bertanda tangan di bawah ini, Kepala Desa Sukamaju, Kecamatan Makmur, Kabupaten Sejahtera, menerangkan dengan sebenarnya bahwa:</p>

    <table class="tabel-isi">
        <tr>
            <td style="width: 28%;">Nama Lengkap</td>
            <td style="width: 2%;">:</td>
            <td><strong>{{ strtoupper($penduduk->nama) }}</strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><strong>{{ $penduduk->nik }}</strong></td>
        </tr>
        <tr>
            <td>Nomor Kartu Keluarga</td>
            <td>:</td>
            <td>{{ $kk->no_kk ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $penduduk->tempat_lahir }}, {{ date('d F Y', strtotime($penduduk->tgl_lahir)) }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $penduduk->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $penduduk->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $penduduk->agama }}</td>
        </tr>
        <tr>
            <td>Alamat Domisili</td>
            <td>:</td>
            <td>{{ $kk->alamat ?? 'RT 001 RW 001 Dusun Melati' }}, Desa Sukamaju, Kec. Makmur</td>
        </tr>
    </table>

    <p style="text-indent: 30px; text-align: justify;">
        Bahwa nama tersebut di atas benar-benar adalah warga yang berdomisili dan bertempat tinggal menetap di Desa Sukamaju, Kecamatan Makmur, Kabupaten Sejahtera. Surat Keterangan Domisili ini diberikan kepada yang bersangkutan untuk keperluan: <strong>{{ $surat->keperluan }}</strong>.
    </p>

    <p style="text-indent: 30px; text-align: justify;">
        Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    <!-- TANDA TANGAN RESMI & VALIDASI QR CODE -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-qr">
                <div style="font-size: 8.5pt; color: #555;">Pindai QR-Code untuk Verifikasi Keaslian Surat:</div>
                <div class="qr-box">
                    <img src="data:image/svg+xml;base64,{{ $qrCode }}" width="100" height="100" alt="QR Validasi">
                </div>
                <div style="font-size: 7.5pt; color: #777;">ID: {{ $surat->qr_token }}</div>
            </td>
            <td class="ttd-pejabat">
                <div>Sukamaju, {{ $tglCetak }}</div>
                <div>Kepala Desa Sukamaju,</div>
                <div style="height: 60px;"></div>
                <div><strong><u>{{ $kadesName }}</u></strong></div>
                <div style="font-size: 10pt;">NIP. 19780512 200501 1 004</div>
            </td>
        </tr>
    </table>

    <div class="watermark">
        Dokumen Resmi Diterbitkan oleh Sistem Informasi Desa Mandiri (SIDESA) &bull; Tanda Tangan Sah Terverifikasi Kriptografi QR-Code
    </div>
</body>
</html>

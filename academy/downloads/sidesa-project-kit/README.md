# SISTEM INFORMASI DESA MANDIRI & LAYANAN SURAT WARGA (SIDESA)
### Master Project Kit: Full Source Code (Laravel 11 & Vue.js 3) + E-Book Panduan 8 Bab (PDF)
**Penerbit:** Skillance Academy Digital Indonesia  
**Penanggung Jawab Kurikulum:** Muh Arsyad Ramsi  
**Lisensi:** Full Commercial & Academic/Skripsi License (Bebas Dipakai, Dimodifikasi & Dikembangkan)

---

## 📁 Struktur Isi Paket Proyek

Paket ini dirancang secara rapi ke dalam 2 sub-folder utama:

```
sidesa-project-kit/
│
├── README.md                                    <-- Panduan ini
│
├── ebook_pdf/                                   <-- SUB-FOLDER BUKU PANDUAN LENGKAP (PDF)
│   ├── SIDESA_Panduan_Lengkap_Full_Edisi_2026.pdf (Master Handbook 8 Bab Lengkap)
│   ├── Bab_1_Analisis_Kebutuhan_dan_ERD.pdf
│   ├── Bab_2_Setup_Laravel11_Vue3_Tailwind.pdf
│   ├── Bab_3_Otentikasi_Multi_Role.pdf
│   ├── Bab_4_Modul_Kependudukan_dan_KK.pdf
│   ├── Bab_5_Layanan_Surat_Online_dan_Generator_PDF.pdf
│   ├── Bab_6_Infografis_APBDes_ChartJS.pdf
│   ├── Bab_7_Integrasi_WhatsApp_Gateway.pdf
│   └── Bab_8_Panduan_Deployment_VPS_Ubuntu.pdf
│
└── source_code/                                 <-- SUB-FOLDER SOURCE CODE LENGKAP
    ├── database/
    │   └── sidesa_master_database.sql           <-- Database Master (7 Tabel + Dummy Data Desa)
    ├── app/
    │   ├── Models/                              <-- Eloquent Models (Penduduk, Surat, KK, APBDes)
    │   ├── Http/Controllers/                    <-- Controller Warga, Admin, & Surat
    │   └── Services/                            <-- Generator PDF Ber-QR Code & WA Service
    ├── resources/
    │   ├── views/pdf/                           <-- Template Resmi Kop Surat Desa (Blade)
    │   └── js/Pages/                            <-- Komponen Frontend Inertia + Vue 3
    ├── routes/
    │   ├── web.php                              <-- Rute Web & Portal Surat
    │   └── api.php                              <-- Endpoint API Tracking & Chart
    ├── index.php                                <-- Launcher Preview Interaktif Cepat
    ├── composer.json & package.json
    └── .env.example
```

---

## 🚀 Panduan Menjalankan Proyek (Quick Start)

### 1. Menjalankan Preview Instan (Tanpa Setup Berat)
Jika Anda menggunakan **Laragon** atau **XAMPP**:
1. Pastikan folder ini berada di dalam direktori root server lokal (`C:\laragon\www\...` atau `htdocs`).
2. Buka browser dan akses:  
   `http://localhost/skillance/academy/downloads/sidesa-project-kit/source_code/`
3. Anda langsung dapat menguji permohonan surat mandiri, melacak tracking surat secara realtime, dan melihat grafik infografis APBDes interaktif.

---

### 2. Import Database Master ke MySQL
1. Buka **phpMyAdmin** atau HeidiSQL di komputer Anda.
2. Buat database baru bernama: `sidesa_db` (Collation: `utf8mb4_unicode_ci`).
3. Pilih tab **Import**, lalu pilih file:
   `source_code/database/sidesa_master_database.sql`
4. Klik **Go / Kirim**. Seluruh 7 tabel master dan relasinya akan otomatis terbuat beserta data contoh penduduk desa.

---

### 3. Menjalankan Fullstack Laravel 11 (Development Mode)
1. Buka terminal di dalam folder `source_code/`:
   ```bash
   cp .env.example .env
   composer install
   php artisan key:generate
   ```
2. Sesuaikan kredensial database di file `.env`:
   ```env
   DB_DATABASE=sidesa_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Install dependensi frontend dan jalankan Vite:
   ```bash
   npm install
   npm run dev
   ```
4. Di terminal kedua, jalankan server Laravel:
   ```bash
   php artisan serve
   ```
5. Akses di browser: `http://localhost:8000`

---

## 🔑 Akun Demo Default (Admin & Petugas)

| Peran (Role) | Email | Password | Hak Akses |
|---|---|---|---|
| **Kepala Desa** | `kades@sidesa.desa.id` | `password123` | Approval Tanda Tangan QR-Code & APBDes |
| **Kasi Pelayanan** | `operator@sidesa.desa.id` | `password123` | Verifikasi Berkas & Penomoran Surat |
| **Warga (Contoh NIK)** | `7401012304990001` | *Tanpa Password* | Permohonan Surat Online & Tracking |

---

## 📲 Integrasi Notifikasi WhatsApp Gateway
Sistem SIDESA telah terhubung dengan service `App\Services\WhatsAppService`.
- Pengaturan URL Gateway ada di `.env`: `WA_GATEWAY_URL=http://127.0.0.1:3000/send`
- Kompatibel dengan gateway lokal Node.js (`whatsapp-web.js`) maupun vendor API cloud (Fonnte / Wablas).
- Setiap ada surat yang selesai ditandatangani oleh Kades, sistem akan otomatis mengirimkan pesan WhatsApp ke nomor HP pemohon beserta link download PDF resminya.

---
**Pusat Bantuan & Konsultasi:**  
WhatsApp Admin Skillance: `0822-9170-0778`  
Website: [https://skillance.my.id/academy/](https://skillance.my.id/academy/)

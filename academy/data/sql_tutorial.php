<?php
/**
 * Silabus Lengkap Tutorial SQL - Skillance Academy Indonesia
 * Semua Materi & Contoh Kode Menggunakan Kueri Murni SQL Standard & MySQL 8.0
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "SQL Tutorial": {
      "sql_home": {
        "title": "SQL HOME",
        "summary": "Selamat Datang di Tutorial SQL Skillance Academy. SQL adalah bahasa standar untuk mengakses dan memanipulasi database relasional.",
        "content": "<p class=\"lead\">Selamat datang di <strong>Tutorial SQL Lengkap</strong> Skillance Academy resmi dari Skillance Academy Indonesia. SQL (Structured Query Language) adalah bahasa standar internasional (ANSI/ISO) yang digunakan oleh seluruh sistem database dunia seperti MySQL, PostgreSQL, Oracle, SQL Server, dan SQLite.</p>\n    <div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n        <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-database text-info me-2\"></i>Kemampuan Utama SQL:</h6>\n        <ul class=\"mb-0 ps-3 small\" style=\"line-height: 1.8;\">\n            <li><strong>Membaca Data</strong>: Mengambil record data spesifik dengan filter, pengurutan, dan pengelompokan (SELECT).</li>\n            <li><strong>Manipulasi Data (DML)</strong>: Menyisipkan (INSERT), mengubah (UPDATE), dan menghapus (DELETE) data transaksi.</li>\n            <li><strong>Definisi Struktur (DDL)</strong>: Membuat database, merancang tabel, indeks, view, dan relasi kunci asing (Foreign Key).</li>\n        </ul>\n    </div>",
        "example_title": "Contoh Kueri SQL SQL HOME",
        "example_code": "SELECT CustomerName, City, Country FROM Customers;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_intro": {
        "title": "SQL Intro",
        "summary": "Pengenalan dasar SQL: Mengapa SQL sangat dibutuhkan oleh semua pengembang perangkat lunak dan analis data.",
        "content": "<p class=\"lead\">Meskipun SQL adalah standar ANSI, berbagai sistem database memiliki dialek sintaks unik masing-masing (seperti T-SQL pada Microsoft SQL Server, PL/SQL pada Oracle). Namun, perintah dasar seperti SELECT, UPDATE, DELETE, INSERT selalu sama di semua database.</p>",
        "example_title": "Contoh Kueri SQL SQL Intro",
        "example_code": "SELECT CustomerName, City, Country FROM Customers;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_syntax": {
        "title": "SQL Syntax",
        "summary": "Sintaks kueri SQL: Klausa kata kunci huruf kapital, nama tabel/kolom, dan tanda titik koma (;).",
        "content": "<p class=\"lead\">Kata kunci SQL <strong>tidak case-sensitive</strong> (klausa <code>select</code> sama dengan <code>SELECT</code>), tetapi secara konvensi industri kata kunci selalu ditulis <strong>HURUF KAPITAL</strong> agar kueri mudah dibaca.</p>",
        "example_title": "Contoh Kueri SQL SQL Syntax",
        "example_code": "SELECT * FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_select": {
        "title": "SQL Select",
        "summary": "Mengambil kolom data tertentu atau seluruh kolom (*) dari sebuah tabel.",
        "content": "<p class=\"lead\">Pernyataan <code>SELECT kolom1, kolom2 FROM nama_tabel;</code> mengambil data dari satu atau beberapa kolom tertentu.</p>",
        "example_title": "Contoh Kueri SQL SQL Select",
        "example_code": "SELECT NamaLengkap, Email, NoHP FROM Pengguna;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_distinct": {
        "title": "SQL Select Distinct",
        "summary": "Menampilkan hanya nilai-nilai unik yang berbeda dan menghilangkan baris data duplikat.",
        "content": "<p class=\"lead\">Gunakan <code>SELECT DISTINCT Country FROM Customers;</code> untuk mengambil daftar negara unik tanpa menampilkan negara yang sama berulang kali.</p>",
        "example_title": "Contoh Kueri SQL SQL Select Distinct",
        "example_code": "SELECT CustomerName, City, Country FROM Customers;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_where": {
        "title": "SQL Where",
        "summary": "Memfilter baris data yang memenuhi kondisi kriteria tertentu.",
        "content": "<p class=\"lead\">Klausa <code>WHERE</code> digunakan untuk mengekstrak hanya record data yang memenuhi kondisi yang ditentukan. Klausa ini juga berlaku pada UPDATE dan DELETE!</p>",
        "example_title": "Contoh Kueri SQL SQL Where",
        "example_code": "SELECT * FROM Produk WHERE Harga >= 100000;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_orderby": {
        "title": "SQL Order By",
        "summary": "Mengurutkan hasil kueri secara menaik (ASC / Ascending) atau menurun (DESC / Descending).",
        "content": "<p class=\"lead\">Secara default, <code>ORDER BY</code> mengurutkan data dari A ke Z atau dari kecil ke besar (ASC). Gunakan <code>DESC</code> untuk membalik urutan.</p>",
        "example_title": "Contoh Kueri SQL SQL Order By",
        "example_code": "SELECT * FROM Siswa ORDER BY TanggalDaftar DESC, Nama ASC;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_and": {
        "title": "SQL And",
        "summary": "Menggabungkan dua atau lebih kondisi di mana SEMUA kondisi harus bernilai benar.",
        "content": "<p class=\"lead\">Operator <code>AND</code> menampilkan baris jika kondisi pertama DAN kondisi kedua sama-sama terpenuhi.</p>",
        "example_title": "Contoh Kueri SQL SQL And",
        "example_code": "SELECT * FROM Karyawan WHERE Divisi = 'IT' AND Gaji > 8000000;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_or": {
        "title": "SQL Or",
        "summary": "Menggabungkan dua atau lebih kondisi di mana SALAH SATU kondisi bernilai benar.",
        "content": "<p class=\"lead\">Operator <code>OR</code> menampilkan baris jika salah satu kondisi bernilai benar.</p>",
        "example_title": "Contoh Kueri SQL SQL Or",
        "example_code": "SELECT * FROM Siswa WHERE Kota = 'Kolaka' OR Kota = 'Kendari';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_not": {
        "title": "SQL Not",
        "summary": "Membalikkan nilai logika kondisi (menampilkan record yang TIDAK memenuhi kriteria).",
        "content": "<p class=\"lead\">Operator <code>NOT</code> digunakan bersama klausa WHERE untuk mengecualikan baris data tertentu.</p>",
        "example_title": "Contoh Kueri SQL SQL Not",
        "example_code": "SELECT * FROM Produk WHERE NOT Kategori = 'Elektronik';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_insert": {
        "title": "SQL Insert Into",
        "summary": "Menyisipkan baris record data baru ke dalam tabel.",
        "content": "<p class=\"lead\">Sintaks: <code>INSERT INTO nama_tabel (kolom1, kolom2) VALUES (nilai1, nilai2);</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL Insert Into",
        "example_code": "INSERT INTO Kursus (Judul, Level) VALUES ('SQL Database', 'Dasar ke Mahir');",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_null_values": {
        "title": "SQL Null Values",
        "summary": "Bekerja dengan nilai NULL (data kosong/tidak ada nilai) menggunakan IS NULL dan IS NOT NULL.",
        "content": "<p class=\"lead\">Nilai <code>NULL</code> berbeda dengan angka nol (0) atau string kosong (\"\"). NULL berarti tidak ada data yang tersimpan. Gunakan <code>IS NULL</code> (bukan <code>= NULL</code>).</p>",
        "example_title": "Contoh Kueri SQL SQL Null Values",
        "example_code": "SELECT * FROM Siswa WHERE NoHP IS NULL;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_update": {
        "title": "SQL Update",
        "summary": "Memperbarui nilai data pada baris yang sudah ada di dalam tabel.",
        "content": "<p class=\"lead\">Peringatan: <strong>Klausa WHERE menentukan baris mana yang akan diperbarui</strong>. Jika Anda menghilangkan WHERE, seluruh baris di tabel akan berubah!</p>",
        "example_title": "Contoh Kueri SQL SQL Update",
        "example_code": "UPDATE Siswa SET Email = 'budi_baru@mail.com' WHERE ID = 15;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_delete": {
        "title": "SQL Delete",
        "summary": "Menghapus baris record dari tabel database.",
        "content": "<p class=\"lead\">Sintaks: <code>DELETE FROM nama_tabel WHERE ID = 10;</code>. Selalu gunakan klausa WHERE agar tidak menghapus seluruh data tabel!</p>",
        "example_title": "Contoh Kueri SQL SQL Delete",
        "example_code": "DELETE FROM Pesanan WHERE ID = 1002;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_top": {
        "title": "SQL Select Top",
        "summary": "Membatasi jumlah baris data yang dikembalikan (SELECT TOP / LIMIT / ROWNUM).",
        "content": "<p class=\"lead\">Di MySQL/PostgreSQL menggunakan klausa <code>LIMIT 5</code>, sedangkan di SQL Server menggunakan <code>SELECT TOP 5</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL Select Top",
        "example_code": "SELECT * FROM Siswa ORDER BY Nilai DESC LIMIT 5;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_aggregate_functions": {
        "title": "SQL Aggregate Functions",
        "summary": "Pengenalan fungsi agregat untuk melakukan kalkulasi pada sekumpulan nilai dan menghasilkan nilai tunggal.",
        "content": "<p class=\"lead\">Fungsi agregat SQL paling sering digunakan: <code>MIN()</code>, <code>MAX()</code>, <code>COUNT()</code>, <code>SUM()</code>, dan <code>AVG()</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL Aggregate Functions",
        "example_code": "SELECT COUNT(CustomerID) AS TotalPelanggan, AVG(Price) AS RataHarga, SUM(Quantity) AS TotalQty FROM OrderDetails;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_min": {
        "title": "SQL Min()",
        "summary": "Fungsi MIN() mengembalikan nilai terkecil dari kolom yang dipilih.",
        "content": "<p class=\"lead\">Fungsi <code>MIN()</code> mengembalikan nilai terkecil pada kolom numerik atau tanggal.</p>",
        "example_title": "Contoh Kueri SQL SQL Min()",
        "example_code": "SELECT MIN(Harga) AS HargaTermurah FROM Produk;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_max": {
        "title": "SQL Max()",
        "summary": "Fungsi MAX() mengembalikan nilai terbesar dari kolom yang dipilih.",
        "content": "<p class=\"lead\">Fungsi <code>MAX()</code> mengembalikan nilai tertinggi pada kolom numerik atau tanggal.</p>",
        "example_title": "Contoh Kueri SQL SQL Max()",
        "example_code": "SELECT MAX(Harga) AS HargaTermahal FROM Produk;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_count": {
        "title": "SQL Count()",
        "summary": "Menghitung jumlah baris data yang cocok dengan kriteria kueri.",
        "content": "<p class=\"lead\">Gunakan <code>SELECT COUNT(*) FROM Siswa;</code> untuk menghitung total seluruh siswa yang terdaftar di database.</p>",
        "example_title": "Contoh Kueri SQL SQL Count()",
        "example_code": "SELECT COUNT(ID) AS TotalSiswaAktif FROM Siswa WHERE Status = 'Aktif';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_sum": {
        "title": "SQL Sum()",
        "summary": "Menjumlahkan total akumulasi seluruh nilai angka pada kolom numerik.",
        "content": "<p class=\"lead\">Gunakan <code>SUM(TotalBayar)</code> untuk mengetahui omzet total penjualan dalam periode tertentu.</p>",
        "example_title": "Contoh Kueri SQL SQL Sum()",
        "example_code": "SELECT SUM(Jumlah) AS TotalPendapatan FROM Transaksi;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_avg": {
        "title": "SQL Avg()",
        "summary": "Menghitung nilai rata-rata dari kolom numerik.",
        "content": "<p class=\"lead\">Fungsi <code>AVG(Nilai)</code> menghitung nilai rata-rata matematika dari seluruh baris data.</p>",
        "example_title": "Contoh Kueri SQL SQL Avg()",
        "example_code": "SELECT AVG(NilaiUjian) AS RataRataKelas FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_like": {
        "title": "SQL Like",
        "summary": "Pencarian pola teks parsial di dalam klausa WHERE menggunakan operator LIKE.",
        "content": "<p class=\"lead\">Operator <code>LIKE</code> digunakan bersama dua wildcard: tanda persen (<code>%</code>) untuk nol atau banyak karakter, dan tanda garis bawah (<code>_</code>) untuk tepat satu karakter.</p>",
        "example_title": "Contoh Kueri SQL SQL Like",
        "example_code": "SELECT * FROM Siswa WHERE Nama LIKE 'A%'; // Nama berawalan huruf A",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_wildcards": {
        "title": "SQL Wildcards",
        "summary": "Karakter wildcard pencocokan pola: %, _, [charlist], [!charlist].",
        "content": "<p class=\"lead\">Wildcard mempercepat pencarian data teks saat pengguna hanya mengingat sebagian kecil dari kata kunci.</p>",
        "example_title": "Contoh Kueri SQL SQL Wildcards",
        "example_code": "SELECT * FROM Customers WHERE City LIKE 'ber%';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_in": {
        "title": "SQL In",
        "summary": "Menentukan beberapa nilai potensial di dalam klausa WHERE sebagai singkatan dari banyak kondisi OR.",
        "content": "<p class=\"lead\">Operator <code>IN</code> membuat kueri jauh lebih ringkas: <code>WHERE Kota IN ('Kolaka', 'Kendari', 'Makassar')</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL In",
        "example_code": "SELECT * FROM Siswa WHERE Kota IN ('Jakarta', 'Bandung', 'Surabaya');",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_between": {
        "title": "SQL Between",
        "summary": "Menyaring data yang berada di dalam suatu rentang nilai batas awal dan batas akhir (inklusif).",
        "content": "<p class=\"lead\">Operator <code>BETWEEN</code> dapat digunakan untuk rentang angka, rentang teks alfabet, maupun rentang tanggal.</p>",
        "example_title": "Contoh Kueri SQL SQL Between",
        "example_code": "SELECT * FROM Produk WHERE Harga BETWEEN 50000 AND 150000;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_alias": {
        "title": "SQL Aliases",
        "summary": "Memberikan nama alias sementara yang lebih ramah pada kolom atau tabel menggunakan kata kunci AS.",
        "content": "<p class=\"lead\">Alias hanya berlaku selama kueri dieksekusi, sangat mempermudah pembacaan nama kolom hasil kalkulasi atau penamaan tabel join yang panjang.</p>",
        "example_title": "Contoh Kueri SQL SQL Aliases",
        "example_code": "SELECT s.Nama AS NamaLengkap, k.NamaKelas FROM Siswa AS s JOIN Kelas AS k ON s.KelasID = k.ID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join": {
        "title": "SQL Joins",
        "summary": "Menghubungkan dan menggabungkan baris data dari dua tabel atau lebih berdasarkan kolom yang saling berelasi.",
        "content": "<p class=\"lead\">JOIN adalah kekuatan utama database relasional, memungkinkan kita menormalkan data ke dalam beberapa tabel terpisah lalu menyatukannya saat kueri dipanggil.</p>",
        "example_title": "Contoh Kueri SQL SQL Joins",
        "example_code": "SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate\nFROM Orders\nINNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join_inner": {
        "title": "SQL Inner Join",
        "summary": "Mengambil record data yang memiliki kecocokan nilai di kedua tabel yang digabungkan.",
        "content": "<p class=\"lead\">Klausa <code>INNER JOIN</code> hanya mengembalikan baris data jika kunci relasi cocok di kedua tabel.</p>",
        "example_title": "Contoh Kueri SQL SQL Inner Join",
        "example_code": "SELECT Pesanan.ID, Pelanggan.Nama\n    FROM Pesanan\n    INNER JOIN Pelanggan ON Pesanan.PelangganID = Pelanggan.ID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join_left": {
        "title": "SQL Left Join",
        "summary": "Mengambil SEMUA baris dari tabel kiri, dan baris yang cocok dari tabel kanan (atau NULL jika tidak ada yang cocok).",
        "content": "<p class=\"lead\">Klausa <code>LEFT JOIN</code> memastikan semua data tabel kiri tetap tampil meskipun belum memiliki data terkait di tabel kanan.</p>",
        "example_title": "Contoh Kueri SQL SQL Left Join",
        "example_code": "SELECT Siswa.Nama, Kursus.Judul\n    FROM Siswa\n    LEFT JOIN Kursus ON Siswa.KursusID = Kursus.ID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join_right": {
        "title": "SQL Right Join",
        "summary": "Mengambil SEMUA baris dari tabel kanan, dan baris yang cocok dari tabel kiri.",
        "content": "<p class=\"lead\">Kebalikan dari LEFT JOIN, <code>RIGHT JOIN</code> mempertahankan semua data di tabel sebelah kanan.</p>",
        "example_title": "Contoh Kueri SQL SQL Right Join",
        "example_code": "SELECT Pesanan.ID, Karyawan.Nama\n    FROM Pesanan\n    RIGHT JOIN Karyawan ON Pesanan.KaryawanID = Karyawan.ID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join_full": {
        "title": "SQL Full Join",
        "summary": "Menggabungkan seluruh baris dari kedua tabel, mengisi NULL jika tidak ada kecocokan di salah satu sisi.",
        "content": "<p class=\"lead\">FULL OUTER JOIN menghasilkan gabungan himpunan seluruh data kedua tabel.</p>",
        "example_title": "Contoh Kueri SQL SQL Full Join",
        "example_code": "SELECT Customers.CustomerName, Orders.OrderID\nFROM Customers\nFULL OUTER JOIN Orders ON Customers.CustomerID = Orders.CustomerID\nORDER BY Customers.CustomerName;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_join_self": {
        "title": "SQL Self Join",
        "summary": "Menggabungkan sebuah tabel dengan dirinya sendiri (berguna untuk data hierarki atasan-bawahan).",
        "content": "<p class=\"lead\">Self Join adalah JOIN biasa di mana tabel di-join ke dirinya sendiri dengan alias nama tabel yang berbeda.</p>",
        "example_title": "Contoh Kueri SQL SQL Self Join",
        "example_code": "SELECT A.Nama AS Karyawan, B.Nama AS Manager\n    FROM Karyawan A, Karyawan B\n    WHERE A.ManagerID = B.ID;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_union": {
        "title": "SQL Union",
        "summary": "Menggabungkan kumpulan hasil dari dua atau lebih kueri SELECT menjadi satu (otomatis menghapus duplikat).",
        "content": "<p class=\"lead\">Setiap kueri SELECT di dalam <code>UNION</code> harus memiliki jumlah kolom yang sama dan tipe data yang kompatibel.</p>",
        "example_title": "Contoh Kueri SQL SQL Union",
        "example_code": "SELECT Kota FROM Pelanggan\n    UNION\n    SELECT Kota FROM Pemasok;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_union_all": {
        "title": "SQL Union All",
        "summary": "Menggabungkan hasil SELECT dengan tetap mempertahankan nilai duplikat (jauh lebih cepat performanya).",
        "content": "<p class=\"lead\">Gunakan <code>UNION ALL</code> jika Anda tahu tidak ada baris duplikat atau memang ingin menampilkan semua kemunculan data karena menghemat pemrosesan sortir internal database.</p>",
        "example_title": "Contoh Kueri SQL SQL Union All",
        "example_code": "SELECT Kota FROM Pelanggan UNION ALL SELECT Kota FROM Pemasok;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_groupby": {
        "title": "SQL Group By",
        "summary": "Mengelompokkan baris data yang memiliki nilai kolom yang sama ke dalam baris ringkasan bersama fungsi agregat.",
        "content": "<p class=\"lead\">Klausa <code>GROUP BY</code> sering digunakan bersama <code>COUNT()</code>, <code>MAX()</code>, <code>MIN()</code>, <code>SUM()</code>, <code>AVG()</code> untuk membuat ringkasan per kategori.</p>",
        "example_title": "Contoh Kueri SQL SQL Group By",
        "example_code": "SELECT Kota, COUNT(ID) AS JumlahSiswa\n    FROM Siswa\n    GROUP BY Kota;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_having": {
        "title": "SQL Having",
        "summary": "Menyaring hasil pengelompokan agregat (pengganti klausa WHERE untuk fungsi agregat).",
        "content": "<p class=\"lead\">Klausa WHERE tidak dapat digunakan langsung pada fungsi agregat, karena itu SQL menyediakan klausa <code>HAVING</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL Having",
        "example_code": "SELECT Kota, COUNT(ID) FROM Siswa\n    GROUP BY Kota\n    HAVING COUNT(ID) > 10;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_exists": {
        "title": "SQL Exists",
        "summary": "Menguji keberadaan record data di dalam subquery (mengembalikan TRUE jika subquery menghasilkan minimal 1 baris).",
        "content": "<p class=\"lead\">Operator <code>EXISTS</code> sangat efisien untuk memvalidasi apakah ada data anak yang berelasi.</p>",
        "example_title": "Contoh Kueri SQL SQL Exists",
        "example_code": "SELECT Nama FROM Pemasok\n    WHERE EXISTS (SELECT NamaProduk FROM Produk WHERE Produk.PemasokID = Pemasok.ID AND Harga < 20000);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_any": {
        "title": "SQL Any",
        "summary": "Operator ANY mengembalikan TRUE jika ada salah satu nilai subquery yang memenuhi kondisi.",
        "content": "<p class=\"lead\">Operator <code>ANY</code> membandingkan nilai kolom dengan sekumpulan nilai dari subquery dan bernilai benar jika minimal satu nilai cocok.</p>",
        "example_title": "Contoh Kueri SQL SQL Any",
        "example_code": "SELECT NamaProduk FROM Produk WHERE ID = ANY (SELECT ProdukID FROM Pesanan WHERE Jumlah > 99);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_all": {
        "title": "SQL All",
        "summary": "Operator ALL mengembalikan TRUE jika seluruh nilai subquery memenuhi kondisi perbandingan.",
        "content": "<p class=\"lead\">Operator <code>ALL</code> mengevaluasi apakah kondisi bernilai benar terhadap SEMUA nilai yang dihasilkan oleh subquery.</p>",
        "example_title": "Contoh Kueri SQL SQL All",
        "example_code": "SELECT NamaProduk FROM Produk WHERE ID = ALL (SELECT ProdukID FROM Pesanan WHERE Jumlah = 10);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_select_into": {
        "title": "SQL Select Into",
        "summary": "Menyalin data dari satu tabel ke dalam tabel baru secara instan.",
        "content": "<p class=\"lead\">Sangat berguna untuk membuat salinan cadangan (backup) tabel sebelum menjalankan perubahan besar.</p>",
        "example_title": "Contoh Kueri SQL SQL Select Into",
        "example_code": "SELECT * INTO SiswaBackup2026 FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_insert_into_select": {
        "title": "SQL Insert Into Select",
        "summary": "Menyalin data dari satu tabel lalu menyisipkannya ke tabel lain yang sudah ada.",
        "content": "<p class=\"lead\">Data hasil SELECT disisipkan langsung ke tabel tujuan yang strukturnya cocok.</p>",
        "example_title": "Contoh Kueri SQL SQL Insert Into Select",
        "example_code": "INSERT INTO ArsipSiswa (Nama, Email) SELECT Nama, Email FROM Siswa WHERE Lulus = 1;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_case": {
        "title": "SQL Case",
        "summary": "Logika percabangan kondisional if-then-else langsung di dalam kueri SQL.",
        "content": "<p class=\"lead\">Pernyataan <code>CASE WHEN kondisi THEN hasil ELSE alternatif END</code> mengevaluasi logika percabangan di level database.</p>",
        "example_title": "Contoh Kueri SQL SQL Case",
        "example_code": "SELECT Nama, Nilai,\n    CASE\n      WHEN Nilai >= 85 THEN 'A'\n      WHEN Nilai >= 70 THEN 'B'\n      ELSE 'C'\n    END AS Predikat\n    FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_isnull": {
        "title": "SQL Null Functions",
        "summary": "Mengganti nilai NULL dengan nilai default: IFNULL() / COALESCE() / ISNULL().",
        "content": "<p class=\"lead\">Fungsi standar ANSI <code>COALESCE(val1, val2, ...)</code> mengembalikan nilai pertama yang tidak bernilai NULL.</p>",
        "example_title": "Contoh Kueri SQL SQL Null Functions",
        "example_code": "SELECT NamaProduk, Harga * (Stok + COALESCE(Bonus, 0)) FROM Produk;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_stored_procedures": {
        "title": "SQL Stored Procedures",
        "summary": "Kumpulan kode SQL yang dipersiapkan dan disimpan di server database untuk dapat dipanggil berulang kali.",
        "content": "<p class=\"lead\">Stored Procedure meningkatkan performa dan keamanan karena kueri kompleks dikompilasi satu kali di server dan dipanggil dengan <code>CALL NamaProsedur();</code>.</p>",
        "example_title": "Contoh Kueri SQL SQL Stored Procedures",
        "example_code": "CREATE PROCEDURE AmbilSemuaSiswa()\n    BEGIN\n      SELECT * FROM Siswa;\n    END;\n    CALL AmbilSemuaSiswa();",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_comments": {
        "title": "SQL Comments",
        "summary": "Penulisan komentar di SQL: Komentar satu baris (--) dan komentar banyak baris (/* ... */).",
        "content": "<p class=\"lead\">Komentar SQL digunakan untuk menjelaskan bagian kueri atau mencegah eksekusi baris tertentu saat pengujian.</p>",
        "example_title": "Contoh Kueri SQL SQL Comments",
        "example_code": "-- Ini komentar satu baris di SQL\n    SELECT * FROM Siswa; /* komentar blok */",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_operators": {
        "title": "SQL Operators",
        "summary": "Kamus lengkap operator SQL: Aritmatika (+, -, *, /), Bitwise, Perbandingan (=, !=, &lt;&gt;, &gt;, &lt;), dan Majemuk (ALL, ANY, BETWEEN, IN, LIKE).",
        "content": "<p class=\"lead\">Gunakan operator yang tepat untuk memastikan integritas dan akurasi perbandingan data kueri.</p>",
        "example_title": "Contoh Kueri SQL SQL Operators",
        "example_code": "SELECT * FROM Products\nWHERE Price >= 50 AND Price <= 200 AND NOT CategoryID = 3;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      }
    },
    "SQL Database": {
      "sql_create_db": {
        "title": "SQL Create DB",
        "summary": "Membuat basis data baru dengan CREATE DATABASE nama_db.",
        "content": "<p class=\"lead\">Membuat basis data baru dengan CREATE DATABASE nama_db.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Create DB",
        "example_code": "CREATE DATABASE skillance_academy;\nSHOW DATABASES;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_drop_db": {
        "title": "SQL Drop DB",
        "summary": "Menghapus database beserta seluruh tabel di dalamnya secara permanen (DROP DATABASE).",
        "content": "<p class=\"lead\">Menghapus database beserta seluruh tabel di dalamnya secara permanen (DROP DATABASE).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Drop DB",
        "example_code": "DROP DATABASE test_database;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_backup_db": {
        "title": "SQL Backup DB",
        "summary": "Membuat salinan cadangan database (BACKUP DATABASE / mysqldump).",
        "content": "<p class=\"lead\">Membuat salinan cadangan database (BACKUP DATABASE / mysqldump).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Backup DB",
        "example_code": "BACKUP DATABASE skillance_academy\nTO DISK = 'C:\\backups\\skillance_academy.bak';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_create_table": {
        "title": "SQL Create Table",
        "summary": "Mendefinisikan tabel baru beserta kolom, tipe data, dan kendalanya.",
        "content": "<p class=\"lead\">Mendefinisikan tabel baru beserta kolom, tipe data, dan kendalanya.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Create Table",
        "example_code": "CREATE TABLE Siswa (\n    SiswaID int NOT NULL AUTO_INCREMENT,\n    Nama varchar(255) NOT NULL,\n    Jurusan varchar(100),\n    TanggalDaftar date DEFAULT (CURRENT_DATE),\n    PRIMARY KEY (SiswaID)\n);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_drop_table": {
        "title": "SQL Drop Table",
        "summary": "Menghapus tabel beserta seluruh definisi strukturnya (DROP TABLE).",
        "content": "<p class=\"lead\">Menghapus tabel beserta seluruh definisi strukturnya (DROP TABLE).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Drop Table",
        "example_code": "DROP TABLE SiswaLama;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_alter_table": {
        "title": "SQL Alter Table",
        "summary": "Menambah, mengubah, atau menghapus kolom pada tabel yang sudah ada (ALTER TABLE).",
        "content": "<p class=\"lead\">Menambah, mengubah, atau menghapus kolom pada tabel yang sudah ada (ALTER TABLE).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Alter Table",
        "example_code": "ALTER TABLE Siswa\nADD Email varchar(255);\n\nDESCRIBE Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_constraints": {
        "title": "SQL Constraints",
        "summary": "Aturan integritas data pada kolom tabel untuk menjaga kevalidan record.",
        "content": "<p class=\"lead\">Aturan integritas data pada kolom tabel untuk menjaga kevalidan record.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Constraints",
        "example_code": "CREATE TABLE Siswa (\n    ID int NOT NULL UNIQUE,\n    Nama varchar(255) NOT NULL,\n    Umur int CHECK (Umur >= 17)\n);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_notnull": {
        "title": "SQL Not Null",
        "summary": "Memastikan kolom tidak boleh bernilai kosong (NULL) saat penyisipan data.",
        "content": "<p class=\"lead\">Memastikan kolom tidak boleh bernilai kosong (NULL) saat penyisipan data.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Not Null",
        "example_code": "ALTER TABLE Siswa\nMODIFY COLUMN Nama varchar(255) NOT NULL;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_unique": {
        "title": "SQL Unique",
        "summary": "Memastikan semua nilai pada kolom tersebut unik dan tidak boleh ada duplikat.",
        "content": "<p class=\"lead\">Memastikan semua nilai pada kolom tersebut unik dan tidak boleh ada duplikat.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Unique",
        "example_code": "ALTER TABLE Siswa\nADD CONSTRAINT UC_Email UNIQUE (Email);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_primarykey": {
        "title": "SQL Primary Key",
        "summary": "Kunci utama unik yang mengidentifikasi setiap baris record secara absolut.",
        "content": "<p class=\"lead\">Kunci utama unik yang mengidentifikasi setiap baris record secara absolut.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Primary Key",
        "example_code": "ALTER TABLE Siswa\nADD PRIMARY KEY (SiswaID);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_foreignkey": {
        "title": "SQL Foreign Key",
        "summary": "Kunci asing yang menghubungkan baris data ke Primary Key tabel lain untuk integritas relasi.",
        "content": "<p class=\"lead\">Kunci asing yang menghubungkan baris data ke Primary Key tabel lain untuk integritas relasi.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Foreign Key",
        "example_code": "ALTER TABLE Orders\nADD CONSTRAINT FK_CustomerOrder\nFOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_check": {
        "title": "SQL Check",
        "summary": "Membatasi rentang nilai yang sah yang boleh disimpan ke dalam kolom (CHECK).",
        "content": "<p class=\"lead\">Membatasi rentang nilai yang sah yang boleh disimpan ke dalam kolom (CHECK).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Check",
        "example_code": "ALTER TABLE Siswa\nADD CONSTRAINT CHK_UmurSiswa CHECK (Umur >= 17);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_default": {
        "title": "SQL Default",
        "summary": "Menetapkan nilai bawaan otomatis jika kolom tidak diisi saat INSERT (DEFAULT).",
        "content": "<p class=\"lead\">Menetapkan nilai bawaan otomatis jika kolom tidak diisi saat INSERT (DEFAULT).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Default",
        "example_code": "ALTER TABLE Siswa\nALTER Kota SET DEFAULT 'Makassar';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_create_index": {
        "title": "SQL Create Index",
        "summary": "Membuat indeks pencarian cepat untuk mempercepat kueri SELECT ribuan kali lipat.",
        "content": "<p class=\"lead\">Membuat indeks pencarian cepat untuk mempercepat kueri SELECT ribuan kali lipat.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Create Index",
        "example_code": "CREATE INDEX idx_nama_siswa\nON Siswa (Nama);\n\nSHOW INDEX FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_autoincrement": {
        "title": "SQL Auto Increment",
        "summary": "Menghasilkan angka penomoran berurutan secara otomatis saat record baru dibuat.",
        "content": "<p class=\"lead\">Menghasilkan angka penomoran berurutan secara otomatis saat record baru dibuat.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Auto Increment",
        "example_code": "CREATE TABLE Kategori (\n    KategoriID int NOT NULL AUTO_INCREMENT,\n    NamaKategori varchar(100) NOT NULL,\n    PRIMARY KEY (KategoriID)\n);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_dates": {
        "title": "SQL Dates",
        "summary": "Format tanggal SQL (YYYY-MM-DD) dan fungsi tanggal: NOW(), CURDATE(), DATE_ADD().",
        "content": "<p class=\"lead\">Format tanggal SQL (YYYY-MM-DD) dan fungsi tanggal: NOW(), CURDATE(), DATE_ADD().</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Dates",
        "example_code": "SELECT OrderID, OrderDate, CURDATE() AS HariIni, DATEDIFF(CURDATE(), OrderDate) AS SelisihHari\nFROM Orders;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_views": {
        "title": "SQL Views",
        "summary": "Tabel virtual hasil kueri SELECT yang disimpan untuk menyederhanakan kueri kompleks (CREATE VIEW).",
        "content": "<p class=\"lead\">Tabel virtual hasil kueri SELECT yang disimpan untuk menyederhanakan kueri kompleks (CREATE VIEW).</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Views",
        "example_code": "CREATE VIEW SiswaAktif AS\nSELECT SiswaID, Nama, Jurusan\nFROM Siswa\nWHERE Status = 'Aktif';\n\nSELECT * FROM SiswaAktif;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_injection": {
        "title": "SQL Injection",
        "summary": "Memahami bagaimana penyerang meretas database dan cara mutlak mencegahnya.",
        "content": "<p class=\"lead\">Memahami bagaimana penyerang meretas database dan cara mutlak mencegahnya.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Injection",
        "example_code": "-- CONTOH SERANGAN SQL INJECTION:\n-- Input tidak aman: ' OR '1'='1\nSELECT * FROM Users WHERE Username = 'admin' AND Password = '' OR '1'='1';\n\n-- PENCEGAHAN MUTLAK (Parameterized Query / Prepared Statement):\nSELECT * FROM Users WHERE Username = ? AND Password = ?;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_parameters": {
        "title": "SQL Parameters",
        "summary": "Parameterized Queries untuk mengikat data pengguna secara terpisah dari sintaks SQL.",
        "content": "<p class=\"lead\">Parameterized Queries untuk mengikat data pengguna secara terpisah dari sintaks SQL.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Parameters",
        "example_code": "PREPARE get_student FROM 'SELECT * FROM Siswa WHERE SiswaID = ?';\nSET @id = 101;\nEXECUTE get_student USING @id;\nDEALLOCATE PREPARE get_student;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_prepared_statements": {
        "title": "SQL Prepared Statements",
        "summary": "Pemisahan kompilasi template SQL dengan eksekusi data aman di server.",
        "content": "<p class=\"lead\">Pemisahan kompilasi template SQL dengan eksekusi data aman di server.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Prepared Statements",
        "example_code": "PREPARE stmt FROM 'INSERT INTO Siswa (Nama, Email) VALUES (?, ?)';\nSET @nama = 'Andi Pratama', @email = 'andi@example.com';\nEXECUTE stmt USING @nama, @email;\nDEALLOCATE PREPARE stmt;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_hosting": {
        "title": "SQL Hosting",
        "summary": "Pengelolaan server database MySQL/PostgreSQL di cloud hosting, VPS, dan Docker.",
        "content": "<p class=\"lead\">Pengelolaan server database MySQL/PostgreSQL di cloud hosting, VPS, dan Docker.</p><p>Topik ini merupakan bagian penting dalam perancangan arsitektur database relasional profesional di Skillance Academy.</p>",
        "example_title": "Contoh Kueri SQL SQL Hosting",
        "example_code": "SHOW VARIABLES LIKE '%version%';\nSHOW STATUS LIKE 'Uptime';\nSELECT USER(), CURRENT_USER();",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      }
    },
    "SQL Cert": {
      "sql_exam": {
        "title": "SQL Certificate",
        "summary": "Uji sertifikasi keahlian kueri SQL dan perancangan database relasional Skillance Academy.",
        "content": "<p class=\"lead\">Uji ketangkasan Anda dalam menulis JOIN, agregasi GROUP BY, subquery, dan perancangan Primary/Foreign Key.</p>",
        "example_title": "Contoh Kueri SQL SQL Certificate",
        "example_code": "SELECT s.Nama, k.NamaKursus, n.SkorNilai, n.StatusLulus\nFROM NilaiUjian n\nJOIN Siswa s ON n.SiswaID = s.SiswaID\nJOIN Kursus k ON n.KursusID = k.KursusID\nWHERE n.StatusLulus = 'LULUS';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      }
    },
    "SQL References": {
      "sql_datatypes": {
        "title": "SQL Data Types",
        "summary": "Kamus tipe data SQL: String (VARCHAR, TEXT), Numeric (INT, DECIMAL), Date/Time (DATE, TIMESTAMP).",
        "content": "<p class=\"lead\">Memilih tipe data yang tepat menghemat kapasitas penyimpanan dan mempercepat indeks pencarian database.</p>",
        "example_title": "Contoh Kueri SQL SQL Data Types",
        "example_code": "CREATE TABLE ContohTipe (\n    ID int,\n    Nama varchar(100),\n    Harga decimal(10,2),\n    TanggalDaftar date,\n    Catatan text\n);",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_ref_keywords": {
        "title": "SQL Keywords",
        "summary": "Daftar seluruh kata kunci cadangan (Reserved Keywords) di SQL.",
        "content": "<p class=\"lead\">Indeks kata kunci yang tidak boleh dijadikan nama tabel atau nama kolom tanpa tanda escape backtick (`).</p>",
        "example_title": "Contoh Kueri SQL SQL Keywords",
        "example_code": "SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, JOIN, WHERE, GROUP BY, ORDER BY.",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_ref_mysql": {
        "title": "MySQL Functions",
        "summary": "Referensi fungsi bawaan MySQL: String, Numeric, Date, dan fungsi kontrol lanjutan.",
        "content": "<p class=\"lead\">Katalog fungsi bawaan MySQL seperti CONCAT(), NOW(), DATEDIFF(), dan IFNULL().</p>",
        "example_title": "Contoh Kueri SQL MySQL Functions",
        "example_code": "SELECT CONCAT(NamaDepan, ' ', NamaBelakang) AS NamaLengkap FROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_ref_sqlserver": {
        "title": "SQL Server Functions",
        "summary": "Kamus fungsi bawaan Microsoft SQL Server (T-SQL): GETDATE(), ISNULL(), LEN(), SUBSTRING().",
        "content": "<p class=\"lead\">Referensi fungsi spesifik untuk sistem database Microsoft SQL Server.</p>",
        "example_title": "Contoh Kueri SQL SQL Server Functions",
        "example_code": "SELECT GETDATE(), LEN('Skillance');",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_ref_msaccess": {
        "title": "MS Access Functions",
        "summary": "Fungsi-fungsi bawaan Microsoft Access Database engine.",
        "content": "<p class=\"lead\">Panduan kompatibilitas kueri untuk database Microsoft Access desktop.</p>",
        "example_title": "Contoh Kueri SQL MS Access Functions",
        "example_code": "SELECT Mid(CustomerName, 1, 5) AS Singkatan, UCase(City) AS KotaBesar FROM Customers;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_quickref": {
        "title": "SQL Quick Ref",
        "summary": "Lembar contekan cepat (Cheat Sheet) sintaks SQL paling sering digunakan untuk pengembang.",
        "content": "<p class=\"lead\">Buku saku praktis ringkasan kueri CRUD, JOIN, dan indeks untuk referensi cepat pekerjaan Anda sehari-hari.</p>",
        "example_title": "Contoh Kueri SQL SQL Quick Ref",
        "example_code": "-- Quick Cheat Sheet\n    SELECT c1, c2 FROM t1 JOIN t2 ON t1.id = t2.ref_id WHERE c1 = 'val' ORDER BY c2 DESC LIMIT 10;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      }
    },
    "SQL Examples": {
      "sql_examples": {
        "title": "SQL Examples",
        "summary": "Koleksi puluhan contoh nyata kueri SQL untuk berbagai skenario bisnis.",
        "content": "<p class=\"lead\">Koleksi puluhan contoh nyata kueri SQL untuk berbagai skenario bisnis.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Examples",
        "example_code": "SELECT CustomerName, City, Country\nFROM Customers\nWHERE Country IN ('Indonesia', 'Malaysia', 'Singapore')\nORDER BY Country ASC, CustomerName ASC;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_editor": {
        "title": "SQL Editor",
        "summary": "Code Lab editor SQL di browser untuk menguji kueri secara interaktif.",
        "content": "<p class=\"lead\">Code Lab editor SQL di browser untuk menguji kueri secara interaktif.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Editor",
        "example_code": "SELECT SiswaID, Nama, Jurusan, Nilai\nFROM Siswa\nWHERE Nilai >= 85\nORDER BY Nilai DESC;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_quiz": {
        "title": "SQL Quiz",
        "summary": "Kuis pilihan ganda interaktif untuk menguji pemahaman sintaks SQL Anda.",
        "content": "<p class=\"lead\">Kuis pilihan ganda interaktif untuk menguji pemahaman sintaks SQL Anda.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Quiz",
        "example_code": "SELECT COUNT(*) AS TotalSiswa, AVG(Nilai) AS RataRata, MAX(Nilai) AS NilaiTertinggi\nFROM Siswa;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_exercises": {
        "title": "SQL Exercises",
        "summary": "Latihan terpandu mengisi klausa SQL yang hilang pada studi kasus.",
        "content": "<p class=\"lead\">Latihan terpandu mengisi klausa SQL yang hilang pada studi kasus.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Exercises",
        "example_code": "SELECT DISTINCT Country FROM Customers ORDER BY Country ASC;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_server": {
        "title": "SQL Server",
        "summary": "Pengenalan administrasi server database dan konfigurasi pengguna.",
        "content": "<p class=\"lead\">Pengenalan administrasi server database dan konfigurasi pengguna.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Server",
        "example_code": "SELECT @@SERVERNAME AS NamaServer, DB_NAME() AS NamaDatabase;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_syllabus": {
        "title": "SQL Syllabus",
        "summary": "Silabus kurikulum database relasional dari pemula hingga administrator database.",
        "content": "<p class=\"lead\">Silabus kurikulum database relasional dari pemula hingga administrator database.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Syllabus",
        "example_code": "SHOW TABLES;\nSELECT TABLE_NAME, TABLE_ROWS FROM information_schema.tables WHERE table_schema = DATABASE();",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_study_plan": {
        "title": "SQL Study Plan",
        "summary": "Rencana belajar SQL intensif 14 hari sampai mahir kueri kompleks.",
        "content": "<p class=\"lead\">Rencana belajar SQL intensif 14 hari sampai mahir kueri kompleks.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Study Plan",
        "example_code": "SELECT JudulMateri, Tingkat, DurasiMenit\nFROM Kurikulum\nORDER BY Urutan ASC;",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      },
      "sql_training": {
        "title": "SQL Training",
        "summary": "Panduan pelatihan dan proyek portofolio basis data relasional industri.",
        "content": "<p class=\"lead\">Panduan pelatihan dan proyek portofolio basis data relasional industri.</p><p>Praktikkan latihan dan kuis untuk memperkuat intuisi pemecahan masalah data Anda.</p>",
        "example_title": "Contoh Kueri SQL SQL Training",
        "example_code": "SELECT ProyekID, NamaProyek, Kategori, Status\nFROM PortofolioSiswa\nWHERE Status = 'Selesai';",
        "explanation": "<p>Jalankan kueri SQL di atas dan periksa hasil baris data pada tabel relasional.</p>"
      }
    }
  }
}
JSON_DATA, true);

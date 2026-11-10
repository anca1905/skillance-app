<?php
/**
 * Silabus Lengkap Tutorial Flutter & Dart - Skillance Academy Indonesia
 * 29 Topik Terbagi ke dalam 5 Kategori Utama Sesuai Standar Resmi Dokumentasi Flutter
 * Semua Materi & Contoh Kode Menggunakan Sintaks Murni Dart & Flutter 3.24
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "Get started": {
      "flutter_install": {
        "title": "Install Flutter & Setup Environment",
        "summary": "Panduan langkah demi langkah mengunduh Flutter SDK, konfigurasi PATH, menjalankan flutter doctor, setup Android Studio, VS Code, dan Emulator.",
        "content": "\n<p class=\"lead\">Untuk memulai pengembangan aplikasi mobile dengan <strong>Flutter</strong>, Anda memerlukan Flutter SDK resmi dari Google dan editor koding seperti <strong>Visual Studio Code</strong> atau <strong>Android Studio</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-screwdriver-wrench text-primary me-2\"></i>Langkah Instalasi Flutter:</h6>\n    <ol class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Unduh Flutter SDK</strong>: Unduh berkas ZIP Flutter dari situs resmi <code>docs.flutter.dev</code> atau clone via Git: <code>git clone https://github.com/flutter/flutter.git -b stable</code>.</li>\n        <li><strong>Atur Environment Variable PATH</strong>: Tambahkan path folder <code>bin</code> Flutter (misal: <code>C:\\src\\flutter\\bin</code>) ke System PATH Windows Anda.</li>\n        <li><strong>Jalankan Flutter Doctor</strong>: Buka terminal dan ketik <code>flutter doctor</code> untuk mendeteksi dependensi yang belum terinstal (Android SDK, Chrome, VS Code).</li>\n        <li><strong>Setup Android Studio & Emulator</strong>: Instal Android SDK Command-line Tools dan buat Virtual Device (AVD Emulator) untuk pengujian.</li>\n    </ol>\n</div>\n<div class=\"alert alert-info border-0 rounded-3\">\n    <small><i class=\"fa-solid fa-circle-check me-2 text-info\"></i><strong>Tips Skillance:</strong> Flutter mendukung hot reload nirkabel (Wireless ADB) langsung ke smartphone Android fisik Anda tanpa kabel USB!</small>\n</div>\n",
        "example_title": "Contoh Verifikasi Flutter SDK (CLI & main.dart)",
        "example_code": "// Verifikasi Flutter SDK & Setup Environment\n// Di Terminal:\n//   $ flutter doctor -v\n//   $ flutter create skillance_flutter_app\n//   $ cd skillance_flutter_app && flutter run\n\nimport 'package:flutter/material.dart';\n\nvoid main() {\n  print('Flutter 3.24.x & Dart 3.x Environment Verified!');\n  runApp(const MyApp());\n}\n\nclass MyApp extends StatelessWidget {\n  const MyApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(\n          title: const Text('Flutter Doctor: Siap Digunakan'),\n          backgroundColor: Colors.blue,\n        ),\n        body: const Center(\n          child: Text(\n            'Flutter SDK dan Android Toolchain Siap! 🚀',\n            style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Perintah <code>flutter doctor</code> memeriksa seluruh konfigurasi komputer Anda dan memberikan tanda centang hijau jika dependensi Android SDK, lisensi Android, dan IDE sudah siap digunakan.</p>",
        "quiz": {
          "q": "Perintah CLI apa yang digunakan untuk mendeteksi kesiapan dependensi instalasi Flutter di komputer?",
          "options": [
            "flutter check",
            "flutter doctor",
            "flutter verify",
            "flutter test"
          ],
          "answer": 1,
          "explanation": "flutter doctor adalah perintah resmi yang menganalisis status instalasi SDK, Android toolchain, emulator, dan ekstensi IDE."
        }
      },
      "flutter_learn": {
        "title": "Learn Flutter & Dasar Pemrograman Dart",
        "summary": "Memahami anatomi program Dart, fungsi main(), runApp(), struktur folder proyek Flutter, dan aplikasi pertama Anda.",
        "content": "\n<p class=\"lead\">Aplikasi Flutter ditulis menggunakan bahasa <strong>Dart</strong>, bahasa berorientasi objek modern dari Google yang memiliki pengetikan statis kuat (*sound null safety*) dan kompilasi AOT (*Ahead-of-Time*) ke kode mesin native.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-dart-lang text-primary me-2\"></i>Struktur Utama main.dart:</h6>\n    <pre class=\"bg-dark text-white p-2 rounded small mb-0\"><code>import 'package:flutter/material.dart';\n\nvoid main() {\n  runApp(const MyApp());\n}\n\nclass MyApp extends StatelessWidget {\n  const MyApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return const MaterialApp(\n      home: Scaffold(\n        body: Center(child: Text('Halo Skillance!')),\n      ),\n    );\n  }\n}</code></pre>\n</div>\n<p class=\"small text-muted\">Fungsi <code>void main()</code> adalah titik masuk utama (entrypoint), dan <code>runApp()</code> menempelkan widget akar ke layar perangkat.</p>\n",
        "example_title": "Struktur Utama main.dart & Aplikasi Pertama",
        "example_code": "import 'package:flutter/material.dart';\n\n// Titik masuk utama program Flutter (Entrypoint)\nvoid main() {\n  runApp(const MyApp());\n}\n\nclass MyApp extends StatelessWidget {\n  const MyApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      title: 'Skillance Academy',\n      debugShowCheckedModeBanner: false,\n      theme: ThemeData(\n        colorScheme: ColorScheme.fromSeed(seedColor: const Color(0xFF0D2E5C)),\n        useMaterial3: true,\n      ),\n      home: const BerandaPage(),\n    );\n  }\n}\n\nclass BerandaPage extends StatelessWidget {\n  const BerandaPage({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(\n        title: const Text('Halo Skillance Academy!'),\n        centerTitle: true,\n      ),\n      body: const Center(\n        child: Text(\n          'Selamat Datang di Flutter & Dart! 💙',\n          style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Fungsi <code>runApp()</code> menginstansiasi widget <code>MaterialApp</code>, yang menyediakan gaya visual Material Design, navigasi, dan konfigurasi tema aplikasi mobile.</p>",
        "quiz": {
          "q": "Fungsi apakah yang bertugas mengikat Widget akar Flutter ke layar perangkat?",
          "options": [
            "startApp()",
            "runApp()",
            "initFlutter()",
            "renderRoot()"
          ],
          "answer": 1,
          "explanation": "runApp() menginstansiasi widget akar dan menempatkannya pada jendela tampilan aplikasi."
        }
      }
    },
    "User interface": {
      "flutter_ui_intro": {
        "title": "Introduction to Widgets & Widget Tree",
        "summary": "Mengenal paradigma 'Everything is a Widget', perbedaan StatelessWidget vs StatefulWidget, dan hierarki Widget Tree.",
        "content": "\n<p class=\"lead\">Di Flutter, moto desain utamanya adalah <strong>\"Everything is a Widget\"</strong>. Teks, tombol, padding, hingga struktur layar penuh adalah widget yang disusun bersarang membentuk <strong>Widget Tree</strong>.</p>\n<div class=\"row g-3 mb-3\">\n    <div class=\"col-md-6\">\n        <div class=\"card h-100 border p-3 rounded-3\">\n            <h6 class=\"fw-bold text-navy\"><i class=\"fa-solid fa-cube text-primary me-2\"></i>StatelessWidget</h6>\n            <p class=\"small text-muted mb-0\">Widget statis yang tidak memiliki *state* (keadaan) yang berubah selama siklus hidupnya. Contoh: Text, Icon, StatelessWidget kartu info.</p>\n        </div>\n    </div>\n    <div class=\"col-md-6\">\n        <div class=\"card h-100 border p-3 rounded-3\">\n            <h6 class=\"fw-bold text-navy\"><i class=\"fa-solid fa-arrows-rotate text-success me-2\"></i>StatefulWidget</h6>\n            <p class=\"small text-muted mb-0\">Widget dinamis yang datanya dapat berubah saat pengguna berinteraksi. Perubahan data memicu pemanggilan <code>setState()</code> untuk me-render ulang UI.</p>\n        </div>\n    </div>\n</div>\n",
        "example_title": "StatelessWidget vs StatefulWidget & setState()",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const CounterApp());\n\nclass CounterApp extends StatelessWidget {\n  const CounterApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return const MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: CounterScreen(),\n    );\n  }\n}\n\nclass CounterScreen extends StatefulWidget {\n  const CounterScreen({super.key});\n\n  @override\n  State<CounterScreen> createState() => _CounterScreenState();\n}\n\nclass _CounterScreenState extends State<CounterScreen> {\n  int _counter = 0;\n\n  void _incrementCounter() {\n    setState(() {\n      _counter++; // Memberi tahu Flutter untuk me-rebuild widget tree\n    });\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Widget Tree & State')),\n      body: Center(\n        child: Column(\n          mainAxisAlignment: MainAxisAlignment.center,\n          children: [\n            const Text('Jumlah Tombol Ditekan:'),\n            Text(\n              '$_counter',\n              style: const TextStyle(fontSize: 48, fontWeight: FontWeight.bold, color: Colors.blue),\n            ),\n          ],\n        ),\n      ),\n      floatingActionButton: FloatingActionButton(\n        onPressed: _incrementCounter,\n        tooltip: 'Tambah Angka',\n        child: const Icon(Icons.add),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Ketika <code>setState()</code> dipanggil pada StatefulWidget, framework Flutter menandai elemen tersebut kotor (*dirty*) dan menjadwalkan metode <code>build()</code> untuk dieksekusi ulang secara efisien.</p>",
        "quiz": {
          "q": "Metode apa yang harus dipanggil di dalam State sebuah StatefulWidget untuk merefresh tampilan antarmuka saat variabel berubah?",
          "options": [
            "updateUI()",
            "refresh()",
            "setState()",
            "rebuild()"
          ],
          "answer": 2,
          "explanation": "setState() memberi tahu framework Flutter bahwa data internal telah berubah dan layar perlu di-render ulang."
        }
      },
      "flutter_widget_catalog": {
        "title": "Widget Catalog: Scaffold, Column, Row & Stack",
        "summary": "Katalog widget esensial untuk menyusun struktur layout: Scaffold, AppBar, Column, Row, Stack, ListView, dan GridView.",
        "content": "\n<p class=\"lead\">Flutter menyediakan ratusan widget siap pakai berkualitas tinggi yang mengikuti pedoman desain Google Material 3 dan Apple Cupertino.</p>\n<div class=\"table-responsive\">\n    <table class=\"table table-bordered table-sm small\">\n        <thead class=\"table-light\"><tr><th>Widget</th><th>Fungsi Utama</th></tr></thead>\n        <tbody>\n            <tr><td><code>Scaffold</code></td><td>Kerangka dasar halaman mobile (AppBar, Drawer, Body, FAB, BottomNav).</td></tr>\n            <tr><td><code>Column</code> & <code>Row</code></td><td>Menyusun widget anak secara vertikal (kolom) atau horizontal (baris).</td></tr>\n            <tr><td><code>Stack</code></td><td>Menumpuk widget secara bertingkat di atas sumbu Z (seperti lapisan foto & badge).</td></tr>\n            <tr><td><code>ListView</code></td><td>Daftar item vertikal yang dapat di-scroll dengan lazy loading efisien via <code>.builder</code>.</td></tr>\n        </tbody>\n    </table>\n</div>\n",
        "example_title": "Penyusunan Layout: Scaffold, Row, Stack & ListView",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const CatalogApp());\n\nclass CatalogApp extends StatelessWidget {\n  const CatalogApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    final List<String> courses = [\n      'Flutter & Dart Mobile App',\n      'Laravel 10 REST API Backend',\n      'Vue.js 3 Frontend Reactive',\n      'Python Data & Automation',\n    ];\n\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Katalog Widget Dasar')),\n        body: Column(\n          children: [\n            // Stack Widget untuk badge di atas gambar\n            Stack(\n              children: [\n                Container(\n                  height: 100,\n                  width: double.infinity,\n                  color: const Color(0xFF0D2E5C),\n                  alignment: Alignment.center,\n                  child: const Text('Banner Kelas (Stack)', style: TextStyle(color: Colors.white, fontSize: 16)),\n                ),\n                Positioned(\n                  top: 10,\n                  right: 10,\n                  child: Container(\n                    padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),\n                    decoration: BoxDecoration(color: Colors.amber, borderRadius: BorderRadius.circular(12)),\n                    child: const Text('BARU', style: TextStyle(fontWeight: FontWeight.bold, fontSize: 11)),\n                  ),\n                ),\n              ],\n            ),\n            // ListView.builder untuk render daftar efisien\n            Expanded(\n              child: ListView.builder(\n                itemCount: courses.length,\n                itemBuilder: (context, i) {\n                  return ListTile(\n                    leading: const CircleAvatar(child: Icon(Icons.school)),\n                    title: Text(courses[i]),\n                    trailing: const Icon(Icons.chevron_right),\n                  );\n                },\n              ),\n            ),\n          ],\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Widget <code>Stack</code> memungkinkan penumpukan elemen di atas elemen lain menggunakan <code>Positioned</code>, sangat ideal untuk badge notifikasi dan banner foto produk.</p>",
        "quiz": {
          "q": "Widget apa yang menyediakan struktur dasar visual layar aplikasi seperti AppBar, FloatingActionButton, dan Drawer?",
          "options": [
            "Container",
            "Scaffold",
            "MaterialApp",
            "Body"
          ],
          "answer": 1,
          "explanation": "Scaffold mengimplementasikan layout dasar visual Material Design."
        }
      },
      "flutter_layout": {
        "title": "Layout & Box Constraints",
        "summary": "Memahami aturan emas tata letak Flutter: 'Constraints go down, Sizes go up, Parents set position'.",
        "content": "\n<p class=\"lead\">Untuk menguasai tata letak di Flutter, Anda harus memahami prinsip <strong>Box Constraints</strong> (batasan kotak dimensi lebar dan tinggi minimum/maksimum).</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-ruler-combined text-primary me-2\"></i>3 Aturan Emas Layout Flutter:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Constraints go down</strong>: Induk widget memberikan batasan (min/max width & height) ke anak-anaknya.</li>\n        <li><strong>Sizes go up</strong>: Anak widget menentukan ukurannya sendiri berdasarkan batasan tersebut dan melapor ke induk.</li>\n        <li><strong>Parents set position</strong>: Induk widget menentukan koordinat posisi X dan Y di layar untuk anak-anaknya.</li>\n    </ul>\n</div>\n<p class=\"small text-muted\">Gunakan widget <code>Expanded</code> atau <code>Flexible</code> di dalam <code>Row</code>/<code>Column</code> untuk menghindari error garis kuning-hitam <em>RenderFlex overflowed</em>.</p>\n",
        "example_title": "Box Constraints & Flex: Expanded vs SizedBox",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const LayoutApp());\n\nclass LayoutApp extends StatelessWidget {\n  const LayoutApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Layout & Box Constraints')),\n        body: Padding(\n          padding: const EdgeInsets.all(16.0),\n          child: Column(\n            crossAxisAlignment: CrossAxisAlignment.stretch,\n            children: [\n              // Row dengan proporsi fleksibel (Expanded)\n              Row(\n                children: [\n                  Expanded(\n                    flex: 1,\n                    child: Container(\n                      height: 50,\n                      color: Colors.blue,\n                      alignment: Alignment.center,\n                      child: const Text('Flex: 1', style: TextStyle(color: Colors.white)),\n                    ),\n                  ),\n                  const SizedBox(width: 10), // Jarak horizontal tetap\n                  Expanded(\n                    flex: 2,\n                    child: Container(\n                      height: 50,\n                      color: Colors.amber,\n                      alignment: Alignment.center,\n                      child: const Text('Flex: 2', style: TextStyle(fontWeight: FontWeight.bold)),\n                    ),\n                  ),\n                ],\n              ),\n              const SizedBox(height: 20), // Jarak vertikal tetap\n              const Card(\n                child: Padding(\n                  padding: EdgeInsets.all(16.0),\n                  child: Text('Konten Card di dalam batasan BoxConstraints induk.'),\n                ),\n              ),\n            ],\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Widget <code>Expanded</code> memaksa anaknya memenuhi sisa ruang kosong yang tersedia pada sumbu utama Row atau Column.</p>",
        "quiz": {
          "q": "Widget apa yang digunakan di dalam Row atau Column untuk mengambil seluruh sisa ruang horizontal atau vertikal?",
          "options": [
            "SizedBox",
            "Expanded",
            "Padding",
            "Container"
          ],
          "answer": 1,
          "explanation": "Expanded membagi dan mengisi seluruh sisa ruang kosong yang tersedia pada sumbu utama."
        }
      },
      "flutter_adaptive_responsive": {
        "title": "Adaptive & Responsive Design",
        "summary": "Membangun tampilan aplikasi yang fleksibel di HP layar kecil, tablet, foldable, dan desktop menggunakan MediaQuery dan LayoutBuilder.",
        "content": "\n<p class=\"lead\">Aplikasi Flutter modern harus tampil elegan di berbagai dimensi layar, mulai dari smartphone 5 inci, tablet lipat, iPad, hingga jendela peramban desktop.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-mobile-screen-button text-primary me-2\"></i>Toolkit Responsif Flutter:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>MediaQuery.of(context).size</code>: Mengetahui lebar dan orientasi (portrait vs landscape) layar fisik perangkat.</li>\n        <li><code>LayoutBuilder</code>: Memberikan <code>BoxConstraints</code> spesifik dari widget induk untuk menentukan jumlah kolom grid.</li>\n        <li><strong>Adaptive Widgets</strong>: Menggunakan <code>Switch.adaptive</code> atau dialog platform-native otomatis (Material di Android, Cupertino di iOS).</li>\n    </ul>\n</div>\n",
        "example_title": "Layout Responsif dengan LayoutBuilder & MediaQuery",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const ResponsiveApp());\n\nclass ResponsiveApp extends StatelessWidget {\n  const ResponsiveApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Adaptive & Responsive')),\n        body: LayoutBuilder(\n          builder: (context, constraints) {\n            // Deteksi breakpoint: Layar Tablet/Desktop (>= 600px) vs Smartphone\n            if (constraints.maxWidth >= 600) {\n              return Row(\n                children: const [\n                  Expanded(flex: 1, child: Center(child: Text('Panel Navigasi Kiri (Tablet)'))),\n                  VerticalDivider(),\n                  Expanded(flex: 2, child: Center(child: Text('Konten Detail Kanan'))),\n                ],\n              );\n            } else {\n              return const Center(\n                child: Text('Tampilan 1 Kolom Vertikal (Smartphone)'),\n              );\n            }\n          },\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Dengan <code>LayoutBuilder</code>, Anda dapat mengubah tampilan 1 kolom pada ponsel menjadi 2 kolom atau sidebar di tablet.</p>",
        "quiz": {
          "q": "Widget apa yang menyediakan batasan dimensi (constraints) dari widget induk untuk menentukan layout responsif secara dinamis?",
          "options": [
            "MediaQuery",
            "LayoutBuilder",
            "FlexLayout",
            "ResponsiveView"
          ],
          "answer": 1,
          "explanation": "LayoutBuilder menyediakan parameter constraints yang memungkinkan pengembang menentukan UI berdasarkan ruang yang tersedia."
        }
      },
      "flutter_design_theming": {
        "title": "Design & Theming: Material 3 & Dark Mode",
        "summary": "Kustomisasi tema menyeluruh, color scheme dinamis Material Design 3, typography Google Fonts, dan dukungan Dark Mode otomatis.",
        "content": "\n<p class=\"lead\">Flutter mendukung penuh standar <strong>Material Design 3 (M3)</strong>. Anda dapat menghasilkan palet warna harmonis dari satu warna primer menggunakan <code>ColorScheme.fromSeed()</code>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-palette text-primary me-2\"></i>Konfigurasi ThemeData di main.dart:</h6>\n    <pre class=\"bg-dark text-white p-2 rounded small mb-0\"><code>theme: ThemeData(\n  useMaterial3: true,\n  colorScheme: ColorScheme.fromSeed(\n    seedColor: const Color(0xFF0D2E5C), // Skillance Navy\n    brightness: Brightness.light,\n  ),\n),\ndarkTheme: ThemeData(\n  useMaterial3: true,\n  colorScheme: ColorScheme.fromSeed(\n    seedColor: const Color(0xFF0D2E5C),\n    brightness: Brightness.dark,\n  ),\n),</code></pre>\n</div>\n",
        "example_title": "Material 3 ColorScheme & Dark Mode Theming",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const ThemeApp());\n\nclass ThemeApp extends StatefulWidget {\n  const ThemeApp({super.key});\n\n  @override\n  State<ThemeApp> createState() => _ThemeAppState();\n}\n\nclass _ThemeAppState extends State<ThemeApp> {\n  ThemeMode _currentMode = ThemeMode.light;\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      themeMode: _currentMode,\n      // Tema Terang Material 3\n      theme: ThemeData(\n        useMaterial3: true,\n        colorScheme: ColorScheme.fromSeed(\n          seedColor: const Color(0xFF0D2E5C),\n          brightness: Brightness.light,\n        ),\n      ),\n      // Tema Gelap Material 3\n      darkTheme: ThemeData(\n        useMaterial3: true,\n        colorScheme: ColorScheme.fromSeed(\n          seedColor: const Color(0xFF0D2E5C),\n          brightness: Brightness.dark,\n        ),\n      ),\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Theming Material 3')),\n        body: Center(\n          child: ElevatedButton.icon(\n            onPressed: () {\n              setState(() {\n                _currentMode = _currentMode == ThemeMode.light ? ThemeMode.dark : ThemeMode.light;\n              });\n            },\n            icon: Icon(_currentMode == ThemeMode.light ? Icons.dark_mode : Icons.light_mode),\n            label: Text(_currentMode == ThemeMode.light ? 'Beralih ke Dark Mode' : 'Beralih ke Light Mode'),\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Menetapkan <code>useMaterial3: true</code> mengaktifkan spesifikasi desain Material 3 terbaru seperti rounded pill shape, elevasi permukaan berbasis warna tint, dan dynamic color.</p>",
        "quiz": {
          "q": "Properti apa yang digunakan pada MaterialApp untuk menyediakan tema khusus saat smartphone pengguna dalam mode gelap?",
          "options": [
            "themeMode",
            "darkTheme",
            "nightStyle",
            "blackTheme"
          ],
          "answer": 1,
          "explanation": "darkTheme mendefinisikan ThemeData khusus yang diaktifkan secara otomatis saat sistem operasi berada dalam Dark Mode."
        }
      },
      "flutter_interactivity": {
        "title": "Interactivity, Gestures & Form Input",
        "summary": "Menangani sentuhan pengguna dengan GestureDetector, InkWell, validasi Form, TextFormField, dan button handlers.",
        "content": "\n<p class=\"lead\">Interaktivitas di Flutter dicapai dengan membungkus elemen dengan penangkap gestur seperti <strong>GestureDetector</strong> atau <strong>InkWell</strong>, serta menggunakan sistem validasi formulir terintegrasi.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-hand-pointer text-primary me-2\"></i>Komponen Input Utama:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>InkWell</code>: Menangkap event tap sekaligus memberikan efek riak air (*ripple effect*) khas Material.</li>\n        <li><code>Form</code> & <code>GlobalKey&lt;FormState&gt;</code>: Mengontrol validasi sekumpulan field secara bersamaan via <code>_formKey.currentState!.validate()</code>.</li>\n        <li><code>TextFormField</code>: Input teks yang dilengkapi fungsi validator otomatis dan dekorasi input (icon, border, error text).</li>\n    </ul>\n</div>\n",
        "example_title": "Form Handling & Validasi Input Pengguna",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const FormApp());\n\nclass FormApp extends StatelessWidget {\n  const FormApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return const MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: FormScreen(),\n    );\n  }\n}\n\nclass FormScreen extends StatefulWidget {\n  const FormScreen({super.key});\n\n  @override\n  State<FormScreen> createState() => _FormScreenState();\n}\n\nclass _FormScreenState extends State<FormScreen> {\n  final _formKey = GlobalKey<FormState>();\n  final _namaController = TextEditingController();\n\n  void _simpanData() {\n    if (_formKey.currentState!.validate()) {\n      ScaffoldMessenger.of(context).showSnackBar(\n        SnackBar(content: Text('Selamat datang, ${_namaController.text}!')),\n      );\n    }\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Form & Interactivity')),\n      body: Padding(\n        padding: const EdgeInsets.all(16.0),\n        child: Form(\n          key: _formKey,\n          child: Column(\n            children: [\n              TextFormField(\n                controller: _namaController,\n                decoration: const InputDecoration(\n                  labelText: 'Nama Lengkap Siswa',\n                  prefixIcon: Icon(Icons.person),\n                  border: OutlineInputBorder(),\n                ),\n                validator: (val) => (val == null || val.isEmpty) ? 'Nama wajib diisi' : null,\n              ),\n              const SizedBox(height: 16),\n              ElevatedButton(\n                onPressed: _simpanData,\n                child: const Text('Kirim Formulir'),\n              ),\n            ],\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Di Flutter, validator mengembalikan nilai <code>null</code> jika input valid, atau mengembalikan <code>String</code> berisi pesan kesalahan jika input tidak memenuhi kriteria.</p>",
        "quiz": {
          "q": "Apa perbedaan utama antara GestureDetector dan InkWell di Flutter?",
          "options": [
            "GestureDetector lebih cepat",
            "InkWell memberikan animasi visual riak (splash ripple effect)",
            "GestureDetector hanya untuk tombol",
            "InkWell tidak mendukung onTap"
          ],
          "answer": 1,
          "explanation": "InkWell adalah komponen Material yang menambahkan efek visual riak air (splash ripple) saat disentuh."
        }
      },
      "flutter_assets_media": {
        "title": "Assets, Media & Fonts",
        "summary": "Deklarasi asset gambar, icon SVG, dan file font kustom pada berkas pubspec.yaml, serta rendering Image.asset dan Image.network.",
        "content": "\n<p class=\"lead\">Untuk menggunakan gambar lokal, video, icon, atau font tipografi kustom, Anda harus mendaftarkannya terlebih dahulu di dalam berkas konfigurasi <strong>pubspec.yaml</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-file-code text-primary me-2\"></i>Konfigurasi di pubspec.yaml:</h6>\n    <pre class=\"bg-dark text-white p-2 rounded small mb-0\"><code>flutter:\n  assets:\n    - assets/images/logo.png\n    - assets/icons/\n  fonts:\n    - family: PlusJakarta\n      fonts:\n        - asset: assets/fonts/PlusJakartaSans-Regular.ttf\n        - asset: assets/fonts/PlusJakartaSans-Bold.ttf\n          weight: 700</code></pre>\n</div>\n",
        "example_title": "Menampilkan Image.network & Asset Gambar",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const AssetApp());\n\nclass AssetApp extends StatelessWidget {\n  const AssetApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Assets & Images')),\n        body: Center(\n          child: Column(\n            mainAxisAlignment: MainAxisAlignment.center,\n            children: [\n              // Gambar dari Jaringan (Network Image)\n              ClipRRect(\n                borderRadius: BorderRadius.circular(12),\n                child: Image.network(\n                  'https://images.unsplash.com/photo-1517694712202-14dd9538aa97',\n                  height: 160,\n                  width: 260,\n                  fit: BoxFit.cover,\n                  loadingBuilder: (context, child, progress) {\n                    return progress == null ? child : const CircularProgressIndicator();\n                  },\n                ),\n              ),\n              const SizedBox(height: 16),\n              const Text('Foto Proyek Flutter Skillance', style: TextStyle(fontWeight: FontWeight.bold)),\n            ],\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Untuk gambar remote dari internet, disarankan menggunakan package <code>cached_network_image</code> agar gambar disimpan di memori dan disk lokal sehingga tidak perlu di-download ulang.</p>",
        "quiz": {
          "q": "Berkas konfigurasi manakah yang digunakan untuk mendaftarkan aset gambar dan font kustom pada proyek Flutter?",
          "options": [
            "build.gradle",
            "pubspec.yaml",
            "AndroidManifest.xml",
            "flutter.config"
          ],
          "answer": 1,
          "explanation": "pubspec.yaml adalah berkas konfigurasi utama untuk mendaftarkan aset dan dependensi di Flutter."
        }
      },
      "flutter_navigation_routing": {
        "title": "Navigation & Routing: GoRouter & Navigator",
        "summary": "Mempelajari perpindahan layar dengan Navigator.push/pop, deklarasi named routes, dan routing modern deklaratif menggunakan package go_router.",
        "content": "\n<p class=\"lead\">Navigasi di Flutter telah berevolusi dari <strong>Navigator 1.0</strong> berbasis tumpukan stack (push/pop) menjadi <strong>Navigator 2.0</strong> deklaratif yang didukung resmi oleh package <strong>go_router</strong> dari Google.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-route text-primary me-2\"></i>Implementasi Dasar GoRouter:</h6>\n    <pre class=\"bg-dark text-white p-2 rounded small mb-0\"><code>final _router = GoRouter(\n  routes: [\n    GoRoute(path: '/', builder: (context, state) => const HomeScreen()),\n    GoRoute(\n      path: '/detail/:id',\n      builder: (context, state) {\n        final id = state.pathParameters['id']!;\n        return DetailScreen(courseId: id);\n      },\n    ),\n  ],\n);</code></pre>\n</div>\n",
        "example_title": "Navigasi Modern Menggunakan GoRouter",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:go_router/go_router.dart';\n\nvoid main() => runApp(const NavApp());\n\nfinal GoRouter _router = GoRouter(\n  routes: [\n    GoRoute(\n      path: '/',\n      builder: (context, state) => const HalamanUtama(),\n    ),\n    GoRoute(\n      path: '/materi/:id',\n      builder: (context, state) {\n        final id = state.pathParameters['id'] ?? '1';\n        return HalamanMateri(materiId: id);\n      },\n    ),\n  ],\n);\n\nclass NavApp extends StatelessWidget {\n  const NavApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp.router(\n      routerConfig: _router,\n      debugShowCheckedModeBanner: false,\n    );\n  }\n}\n\nclass HalamanUtama extends StatelessWidget {\n  const HalamanUtama({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Beranda Kursus')),\n      body: Center(\n        child: ElevatedButton(\n          onPressed: () => context.go('/materi/flutter-widgets'),\n          child: const Text('Buka Materi Flutter Widgets »'),\n        ),\n      ),\n    );\n  }\n}\n\nclass HalamanMateri extends StatelessWidget {\n  final String materiId;\n  const HalamanMateri({super.key, required this.materiId});\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: Text('Materi: $materiId')),\n      body: Center(\n        child: ElevatedButton(\n          onPressed: () => context.pop(),\n          child: const Text('« Kembali ke Beranda'),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Dengan <code>go_router</code>, aplikasi Flutter di web otomatis mendukung deep linking dan navigasi tombol Back/Forward pada peramban secara konsisten.</p>",
        "quiz": {
          "q": "Package resmi Google apa yang sangat direkomendasikan untuk routing deklaratif dan deep-linking di Flutter?",
          "options": [
            "flutter_route",
            "go_router",
            "page_manager",
            "auto_nav"
          ],
          "answer": 1,
          "explanation": "go_router adalah solusi routing deklaratif standar industri yang didukung langsung oleh tim pengembang Flutter."
        }
      },
      "flutter_animations": {
        "title": "Animations & Transitions",
        "summary": "Membuat antarmuka hidup dan dinamis dengan Implicit Animations (AnimatedContainer) dan Explicit Animations (AnimationController).",
        "content": "\n<p class=\"lead\">Animasi di Flutter terkenal sangat halus (*butter smooth 60/120 FPS*). Flutter menyediakan dua kategori animasi:</p>\n<div class=\"row g-3 mb-3\">\n    <div class=\"col-md-6\">\n        <div class=\"card h-100 border p-3 rounded-3\">\n            <h6 class=\"fw-bold text-navy\"><i class=\"fa-solid fa-wand-magic-sparkles text-primary me-2\"></i>Implicit Animations</h6>\n            <p class=\"small text-muted mb-0\">Sangat mudah digunakan tanpa perlu controller manual. Contoh: <code>AnimatedContainer</code>, <code>AnimatedOpacity</code>, <code>AnimatedAlign</code>.</p>\n        </div>\n    </div>\n    <div class=\"col-md-6\">\n        <div class=\"card h-100 border p-3 rounded-3\">\n            <h6 class=\"fw-bold text-navy\"><i class=\"fa-solid fa-sliders text-success me-2\"></i>Explicit Animations</h6>\n            <p class=\"small text-muted mb-0\">Memberikan kontrol penuh per-frame menggunakan <code>AnimationController</code>, <code>CurvedAnimation</code>, dan <code>Tween</code>.</p>\n        </div>\n    </div>\n</div>\n",
        "example_title": "Animasi Implisit dengan AnimatedContainer",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const AnimationApp());\n\nclass AnimationApp extends StatelessWidget {\n  const AnimationApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return const MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: AnimationScreen(),\n    );\n  }\n}\n\nclass AnimationScreen extends StatefulWidget {\n  const AnimationScreen({super.key});\n\n  @override\n  State<AnimationScreen> createState() => _AnimationScreenState();\n}\n\nclass _AnimationScreenState extends State<AnimationScreen> {\n  bool _selected = false;\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('AnimatedContainer Demo')),\n      body: Center(\n        child: GestureDetector(\n          onTap: () {\n            setState(() {\n              _selected = !_selected;\n            });\n          },\n          child: AnimatedContainer(\n            duration: const Duration(milliseconds: 400),\n            curve: Curves.easeInOutBack,\n            width: _selected ? 200.0 : 100.0,\n            height: _selected ? 200.0 : 100.0,\n            decoration: BoxDecoration(\n              color: _selected ? Colors.indigo : Colors.amber,\n              borderRadius: BorderRadius.circular(_selected ? 30 : 8),\n            ),\n            alignment: Alignment.center,\n            child: Text(\n              _selected ? 'Besar!' : 'Klik Saya',\n              style: TextStyle(\n                color: _selected ? Colors.white : Colors.black,\n                fontWeight: FontWeight.bold,\n              ),\n            ),\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Widget <code>AnimatedContainer</code> secara otomatis menginterpolasi perubahan nilai lebar, tinggi, warna, dan dekorasi selama durasi yang ditentukan.</p>",
        "quiz": {
          "q": "Widget animasi implisit apa yang dapat menganimasikan perubahan ukuran, warna latar, dan border radius hanya dengan mengubah propertinya?",
          "options": [
            "AnimatedBox",
            "AnimatedContainer",
            "TransitionCard",
            "SmoothView"
          ],
          "answer": 1,
          "explanation": "AnimatedContainer secara otomatis menginterpolasi properti geometri dan visualnya."
        }
      },
      "flutter_accessibility": {
        "title": "Accessibility (A11y & Semantics)",
        "summary": "Membuat aplikasi inklusif untuk pengguna disabilitas netra atau low-vision menggunakan Semantics widget dan dukungan screen reader.",
        "content": "\n<p class=\"lead\">Aksesibilitas memastikan aplikasi dapat digunakan oleh semua orang, termasuk penyandang disabilitas yang mengandalkan <strong>Screen Reader</strong> (Google TalkBack di Android dan Apple VoiceOver di iOS).</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-universal-access text-primary me-2\"></i>Pilar Aksesibilitas Flutter:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>Semantics</code>: Memberikan label penjelasan verbal pada icon atau tombol custom (misal: <code>Semantics(label: 'Tombol Simpan Sertifikat')</code>).</li>\n        <li><strong>Text Scaling</strong>: Memastikan UI tidak overflow saat pengguna memperbesar font sistem di pengaturan HP.</li>\n        <li><strong>Kontras Warna</strong>: Mematuhi rasio kontras warna minimum WCAG 4.5:1 agar teks terbaca jelas di bawah terik matahari.</li>\n    </ul>\n</div>\n",
        "example_title": "Mendukung Aksesibilitas dengan Widget Semantics",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const A11yApp());\n\nclass A11yApp extends StatelessWidget {\n  const A11yApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      debugShowCheckedModeBanner: false,\n      home: Scaffold(\n        appBar: AppBar(title: const Text('Accessibility (A11y)')),\n        body: Center(\n          child: Semantics(\n            label: 'Tombol untuk mendaftar kelas bootcamp Skillance Academy',\n            button: true,\n            hint: 'Ketuk dua kali untuk membuka formulir pendaftaran',\n            child: ElevatedButton.icon(\n              onPressed: () {},\n              icon: const Icon(Icons.school),\n              label: const Text('Daftar Bootcamp'),\n            ),\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Widget <code>Semantics</code> sangat krusial saat Anda membuat widget interaktif berbasis <code>GestureDetector</code> yang tidak memiliki teks bawaan.</p>",
        "quiz": {
          "q": "Widget apa di Flutter yang digunakan untuk menyediakan anotasi semantik bagi aplikasi pembaca layar (Screen Reader)?",
          "options": [
            "Accessible",
            "Semantics",
            "VoiceOver",
            "ScreenReaderWidget"
          ],
          "answer": 1,
          "explanation": "Semantics membungkus widget dan memberikan label serta petunjuk aksi bagi TalkBack atau VoiceOver."
        }
      },
      "flutter_internationalization": {
        "title": "Internationalization (i18n & l10n)",
        "summary": "Mendukung multi-bahasa dalam satu aplikasi menggunakan flutter_localizations dan file Application Resource Bundle (.arb).",
        "content": "\n<p class=\"lead\">Untuk menjangkau audiens internasional, aplikasi Flutter dapat dengan mudah dialokasikan ke berbagai bahasa (Bahasa Indonesia, English, dll.) menggunakan sistem <strong>ARB (Application Resource Bundle)</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-language text-primary me-2\"></i>Contoh Berkas app_id.arb & app_en.arb:</h6>\n    <pre class=\"bg-dark text-white p-2 rounded small mb-0\"><code>// app_id.arb\n{\n  \"welcomeMsg\": \"Selamat Datang di Skillance Academy\",\n  \"loginBtn\": \"Masuk Sekarang\"\n}\n\n// app_en.arb\n{\n  \"welcomeMsg\": \"Welcome to Skillance Academy\",\n  \"loginBtn\": \"Login Now\"\n}</code></pre>\n</div>\n",
        "example_title": "Konfigurasi Multi-Bahasa (i18n / l10n)",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:flutter_localizations/flutter_localizations.dart';\n\nvoid main() => runApp(const I18nDemoApp());\n\nclass I18nDemoApp extends StatelessWidget {\n  const I18nDemoApp({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return const MaterialApp(\n      debugShowCheckedModeBanner: false,\n      locale: Locale('id', 'ID'), // Bahasa default Indonesia\n      supportedLocales: [\n        Locale('id', 'ID'),\n        Locale('en', 'US'),\n      ],\n      localizationsDelegates: [\n        GlobalMaterialLocalizations.delegate,\n        GlobalWidgetsLocalizations.delegate,\n        GlobalCupertinoLocalizations.delegate,\n      ],\n      home: Scaffold(\n        body: Center(\n          child: Text(\n            'Selamat Datang di Skillance Academy Indonesia',\n            style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),\n          ),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Package <code>flutter_localizations</code> menghasilkan kelas Dart bertipe aman (type-safe) sehingga tidak akan terjadi salah ketik (typo) nama kunci terjemahan.</p>",
        "quiz": {
          "q": "Format berkas apa yang menjadi standar resmi Flutter untuk menyimpan teks terjemahan multi-bahasa?",
          "options": [
            ".xml",
            ".arb",
            ".po",
            ".strings"
          ],
          "answer": 1,
          "explanation": ".arb (Application Resource Bundle) adalah format JSON berbasis standar Google untuk lokalisasi Flutter."
        }
      }
    },
    "Beyond UI": {
      "flutter_data_backend": {
        "title": "Data & Backend: HTTP REST API & Local Storage",
        "summary": "Menghubungkan aplikasi Flutter ke server backend RESTful menggunakan package http/dio, serialisasi JSON, dan penyimpanan lokal SQLite/Hive.",
        "content": "\n<p class=\"lead\">Aplikasi mobile nyata membutuhkan pertukaran data dengan backend server melalui <strong>HTTP REST API</strong> serta penyimpanan lokal di perangkat saat luring (*offline*).</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-cloud-arrow-down text-primary me-2\"></i>Penyimpanan & Komunikasi Data:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>http</code> / <code>dio</code>: Mengirim request GET, POST, PUT, DELETE dengan penanganan token Bearer JWT.</li>\n        <li><code>json_serializable</code>: Otomasi konversi string JSON ke Model Object Dart bertipe aman.</li>\n        <li><code>shared_preferences</code>: Menyimpan preferensi sederhana (status login, dark mode).</li>\n        <li><code>sqflite</code> & <code>hive</code>: Database relasional dan NoSQL berkecepatan tinggi di dalam HP.</li>\n    </ul>\n</div>\n",
        "example_title": "Fetching REST API & Model Serialisasi JSON",
        "example_code": "import 'dart:convert';\nimport 'package:flutter/material.dart';\nimport 'package:http/http.dart' as http;\n\n// Model Kursus\nclass Kursus {\n  final int id;\n  final String judul;\n\n  Kursus({required this.id, required this.judul});\n\n  factory Kursus.fromJson(Map<String, dynamic> json) {\n    return Kursus(id: json['id'], judul: json['title']);\n  }\n}\n\n// Fungsi Tarik Data dari Server REST API\nFuture<List<Kursus>> getKursus() async {\n  final url = Uri.parse('https://api.skillance.cloud/courses');\n  final response = await http.get(url);\n\n  if (response.statusCode == 200) {\n    List<dynamic> list = jsonDecode(response.body);\n    return list.map((item) => Kursus.fromJson(item)).toList();\n  } else {\n    throw Exception('Gagal memuat data dari server');\n  }\n}",
        "explanation": "<p>Menggunakan model class bertipe aman memastikan aplikasi tidak crash saat backend mengirimkan nilai null pada properti tertentu.</p>",
        "quiz": {
          "q": "Package manakah yang paling populer untuk melakukan HTTP network requests tingkat lanjut dengan fitur interceptor di Flutter?",
          "options": [
            "dio",
            "fetch_api",
            "network_kit",
            "axios_flutter"
          ],
          "answer": 0,
          "explanation": "Dio adalah pustaka HTTP yang sangat kuat di Dart yang mendukung Interceptors, Global Configuration, FormData, dan pembatalan Request."
        }
      },
      "flutter_app_architecture": {
        "title": "App Architecture & State Management (BLoC, Riverpod)",
        "summary": "Menerapkan Clean Architecture dan memisahkan logika bisnis dari UI menggunakan BLoC, Riverpod, atau Provider.",
        "content": "\n<p class=\"lead\">Untuk aplikasi skala korporat, menempatkan seluruh kode di widget menggunakan <code>setState</code> akan menimbulkan kekacauan (*spaghetti code*). Anda membutuhkan <strong>State Management</strong> terstandar.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-sitemap text-primary me-2\"></i>3 State Management Terkemuka di Industri:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Riverpod</strong>: Solusi modern penerus Provider yang sepenuhnya *compile-safe*, tanpa ketergantungan pada BuildContext.</li>\n        <li><strong>BLoC (Business Logic Component)</strong>: Pola berbasis aliran event dan state (*Streams*) yang paling banyak digunakan oleh perbankan dan unicorn.</li>\n        <li><strong>Provider</strong>: Solusi sederhana yang didukung tim resmi Flutter untuk aplikasi skala kecil hingga menengah.</li>\n    </ul>\n</div>\n",
        "example_title": "Arsitektur State Management dengan Provider",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:provider/provider.dart';\n\n// State & Business Logic\nclass CartProvider extends ChangeNotifier {\n  final List<String> _items = [];\n  List<String> get items => _items;\n\n  void tambahItem(String nama) {\n    _items.add(nama);\n    notifyListeners(); // Menginstruksikan UI untuk update\n  }\n}\n\nvoid main() {\n  runApp(\n    ChangeNotifierProvider(\n      create: (context) => CartProvider(),\n      child: const MaterialApp(home: CartScreen()),\n    ),\n  );\n}\n\nclass CartScreen extends StatelessWidget {\n  const CartScreen({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    final cart = context.watch<CartProvider>();\n\n    return Scaffold(\n      appBar: AppBar(title: Text('Keranjang (${cart.items.length})')),\n      body: ListView.builder(\n        itemCount: cart.items.length,\n        itemBuilder: (ctx, i) => ListTile(title: Text(cart.items[i])),\n      ),\n      floatingActionButton: FloatingActionButton(\n        onPressed: () => context.read<CartProvider>().tambahItem('E-Book Flutter 3.x'),\n        child: const Icon(Icons.add_shopping_cart),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Pola BLoC memisahkan logika UI (Event dikirim ke BLoC) dan State hasil komputasi yang dipancarkan kembali ke UI via <code>BlocBuilder</code>.</p>",
        "quiz": {
          "q": "Pola State Management apa yang memisahkan logika bisnis menggunakan konsep Events dan States berbasis Reactive Streams?",
          "options": [
            "BLoC",
            "MVC",
            "SharedPreferences",
            "InheritedWidget murni"
          ],
          "answer": 0,
          "explanation": "BLoC (Business Logic Component) mengandalkan aliran Event masuk dan memancarkan State keluar."
        }
      },
      "flutter_native_interop": {
        "title": "Native Interop: Platform Channels & Dart FFI",
        "summary": "Menghubungkan kode Dart Flutter dengan API native Android (Kotlin/Java) dan iOS (Swift) via MethodChannel dan C-FFI.",
        "content": "\n<p class=\"lead\">Ketika aplikasi Flutter memerlukan akses ke fitur perangkat keras yang belum didukung oleh plugin publik, Anda dapat berkomunikasi langsung dengan kode native OS melalui <strong>Platform Channels (MethodChannel)</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-network-wired text-primary me-2\"></i>Alur Komunikasi MethodChannel:</h6>\n    <ol class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li>Di Dart: Panggil <code>const MethodChannel('com.skillance/battery').invokeMethod('getBatteryLevel')</code>.</li>\n        <li>Di Android (Kotlin): Tangkap pesan di <code>MainActivity.kt</code> via <code>MethodChannel.MethodCallHandler</code> dan baca <code>BatteryManager</code>.</li>\n        <li>Di iOS (Swift): Tangkap pesan di <code>AppDelegate.swift</code> via <code>FlutterMethodChannel</code> dan baca <code>UIDevice.current.batteryLevel</code>.</li>\n    </ol>\n</div>\n",
        "example_title": "Komunikasi Native via MethodChannel",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:flutter/services.dart';\n\nclass BatteryScreen extends StatefulWidget {\n  const BatteryScreen({super.key});\n\n  @override\n  State<BatteryScreen> createState() => _BatteryScreenState();\n}\n\nclass _BatteryScreenState extends State<BatteryScreen> {\n  // Saluran platform channel yang terhubung ke Kotlin / Swift\n  static const platform = MethodChannel('com.skillance.academy/battery');\n  String _batteryLevel = 'Belum diperiksa';\n\n  Future<void> _checkBattery() async {\n    try {\n      final int result = await platform.invokeMethod('getBatteryLevel');\n      setState(() => _batteryLevel = '$result% tersisa');\n    } on PlatformException catch (e) {\n      setState(() => _batteryLevel = \"Gagal membaca level baterai: '${e.message}'\");\n    }\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Native MethodChannel')),\n      body: Center(\n        child: Column(\n          mainAxisAlignment: MainAxisAlignment.center,\n          children: [\n            Text('Daya Baterai: $_batteryLevel'),\n            const SizedBox(height: 12),\n            ElevatedButton(onPressed: _checkBattery, child: const Text('Cek Baterai Native')),\n          ],\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Selain MethodChannel, Dart FFI (*Foreign Function Interface*) memungkinkan pemanggilan library C/C++ secara langsung dengan zero-overhead performa.</p>",
        "quiz": {
          "q": "Mekanisme apa di Flutter yang digunakan untuk mengirim pesan asinkron antara kode Dart dan kode native Android (Kotlin) / iOS (Swift)?",
          "options": [
            "Platform Channels (MethodChannel)",
            "Bluetooth Bridge",
            "WebSockets",
            "JNI Wrapper"
          ],
          "answer": 0,
          "explanation": "Platform Channels memungkinkan pengiriman pesan dan pemanggilan metode antara Dart dan platform native host."
        }
      },
      "flutter_platform_integration": {
        "title": "Platform Integration: Camera, GPS & Biometrics",
        "summary": "Integrasi sensor hardware smartphone: akses kamera, koordinat GPS Geolocator, biometrik Fingerprint/Face ID, dan Push Notification.",
        "content": "\n<p class=\"lead\">Aplikasi mobile kelas dunia memanfaatkan kemampuan sensor smartphone secara maksimal untuk menghadirkan pengalaman pengguna yang mulus dan aman.</p>\n<div class=\"table-responsive\">\n    <table class=\"table table-bordered table-sm small\">\n        <thead class=\"table-light\"><tr><th>Kebutuhan Sensor</th><th>Plugin Resmi / Terpercaya</th></tr></thead>\n        <tbody>\n            <tr><td>Kamera & Barcode</td><td><code>camera</code>, <code>image_picker</code>, <code>mobile_scanner</code></td></tr>\n            <tr><td>Koordinat GPS & Peta</td><td><code>geolocator</code>, <code>google_maps_flutter</code></td></tr>\n            <tr><td>Keamanan Biometrik</td><td><code>local_auth</code> (Fingerprint & FaceID)</td></tr>\n            <tr><td>Push Notifications</td><td><code>firebase_messaging</code> (FCM), <code>flutter_local_notifications</code></td></tr>\n        </tbody>\n    </table>\n</div>\n",
        "example_title": "Integrasi Autentikasi Biometrik (Fingerprint / Face ID)",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:local_auth/local_auth.dart';\n\nclass BiometricAuthDemo extends StatefulWidget {\n  const BiometricAuthDemo({super.key});\n\n  @override\n  State<BiometricAuthDemo> createState() => _BiometricAuthDemoState();\n}\n\nclass _BiometricAuthDemoState extends State<BiometricAuthDemo> {\n  final LocalAuthentication _auth = LocalAuthentication();\n  bool _isAuthorized = false;\n\n  Future<void> _authenticate() async {\n    final bool didAuth = await _auth.authenticate(\n      localizedReason: 'Pindai sidik jari Anda untuk login ke Skillance Academy',\n      options: const AuthenticationOptions(biometricOnly: true),\n    );\n    setState(() => _isAuthorized = didAuth);\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Biometric Authentication')),\n      body: Center(\n        child: Column(\n          mainAxisAlignment: MainAxisAlignment.center,\n          children: [\n            Icon(_isAuthorized ? Icons.check_circle : Icons.fingerprint, size: 64, color: _isAuthorized ? Colors.green : Colors.blue),\n            const SizedBox(height: 16),\n            ElevatedButton(onPressed: _authenticate, child: const Text('Verifikasi Sidik Jari')),\n          ],\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Plugin <code>local_auth</code> menangani perbedaan implementasi otentikasi biometrik antara Android BiometricPrompt dan iOS LocalAuthentication secara transparan.</p>",
        "quiz": {
          "q": "Plugin apa yang digunakan untuk mengimplementasikan login biometrik (Fingerprint dan Face ID) di aplikasi Flutter?",
          "options": [
            "biometric_login",
            "local_auth",
            "fingerprint_flutter",
            "device_security"
          ],
          "answer": 1,
          "explanation": "local_auth adalah plugin resmi Flutter untuk otentikasi biometrik lokal pada Android dan iOS."
        }
      },
      "flutter_packages_plugins": {
        "title": "Packages & Plugins: pub.dev Ecosystem",
        "summary": "Memanfaatkan ribuan paket open-source di pub.dev, manajemen dependensi versi semantik, serta merilis package buatan sendiri.",
        "content": "\n<p class=\"lead\">Salah satu kekuatan terbesar ekosistem Flutter adalah <strong>pub.dev</strong>, repositori resmi paket open-source yang memiliki puluhan ribu library siap pakai.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-cubes text-primary me-2\"></i>Panduan Versi Semantik (^):</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>provider: ^6.1.2</code>: Karat (<code>^</code>) berarti proyek menerima pembaruan patch dan fitur minor non-breaking (6.1.3 hingga &lt; 7.0.0).</li>\n        <li><strong>Menambahkan Paket Cepat</strong>: Cukup ketik <code>flutter pub add nama_paket</code> di terminal tanpa perlu mengedit file secara manual.</li>\n    </ul>\n</div>\n",
        "example_title": "Konfigurasi Dependensi pubspec.yaml",
        "example_code": "# Berkas Konfigurasi Proyek Flutter (pubspec.yaml)\nname: skillance_academy_app\ndescription: Aplikasi Resmi Skillance Academy Indonesia.\nversion: 1.0.0+1\n\nenvironment:\n  sdk: '>=3.0.0 <4.0.0'\n\ndependencies:\n  flutter:\n    sdk: flutter\n  http: ^1.2.0\n  provider: ^6.1.1\n  go_router: ^13.2.0\n  shared_preferences: ^2.2.2\n  google_fonts: ^6.1.0\n\ndev_dependencies:\n  flutter_test:\n    sdk: flutter\n  flutter_lints: ^3.0.0\n\nflutter:\n  uses-material-design: true",
        "explanation": "<p>Setiap paket di pub.dev memiliki skor metrik kualitas: *Likes*, *Pub Points* (analisis kualitas kode), dan *Popularity*.</p>",
        "quiz": {
          "q": "Perintah terminal apa yang secara otomatis menambahkan dependensi ke pubspec.yaml dan mengunduh paket tersebut?",
          "options": [
            "flutter install <pkg>",
            "flutter pub add <pkg>",
            "flutter get <pkg>",
            "dart npm add <pkg>"
          ],
          "answer": 1,
          "explanation": "flutter pub add menambahkan dependensi secara otomatis ke pubspec.yaml dan mengeksekusi flutter pub get."
        }
      },
      "flutter_testing_debugging": {
        "title": "Testing & Debugging: DevTools, Unit & Widget Test",
        "summary": "Menguji aplikasi dengan Unit Test, Widget Test, Integration Test, serta debugging tingkat lanjut dengan Flutter DevTools.",
        "content": "\n<p class=\"lead\">Untuk menjamin aplikasi bebas bug saat rilis ke pengguna, Flutter menyediakan framework pengujian otomatis bertingkat (*Testing Pyramid*).</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-bug-slash text-primary me-2\"></i>3 Tingkat Pengujian Flutter:</h6>\n    <ol class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Unit Tests</strong>: Menguji fungsi, kalkulasi, dan logika bisnis kelas murni tanpa UI. Sangat cepat.</li>\n        <li><strong>Widget Tests</strong>: Menguji apakah widget me-render teks, tombol, dan merespons tap secara akurat menggunakan <code>WidgetTester</code>.</li>\n        <li><strong>Integration Tests</strong>: Menjalankan aplikasi secara penuh di simulator fisik untuk menguji alur login hingga checkout.</li>\n    </ol>\n</div>\n",
        "example_title": "Automated Widget Testing dengan flutter_test",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:flutter_test/flutter_test.dart';\n\nvoid main() {\n  testWidgets('Verifikasi tombol counter bertambah saat diklik', (WidgetTester tester) async {\n    // 1. Render widget ke memori pengujian virtual\n    await tester.pumpWidget(\n      const MaterialApp(\n        home: Scaffold(\n          body: Center(child: Text('0')),\n          floatingActionButton: FloatingActionButton(onPressed: null, child: Icon(Icons.add)),\n        ),\n      ),\n    );\n\n    // 2. Ekspektasi: Angka awal adalah '0'\n    expect(find.text('0'), findsOneWidget);\n    expect(find.text('1'), findsNothing);\n\n    // 3. Ekspektasi: Ikon tombol tambah tersedia\n    expect(find.byIcon(Icons.add), findsOneWidget);\n  });\n}",
        "explanation": "<p>Alat <strong>Flutter DevTools</strong> yang terintegrasi di browser menyediakan Widget Inspector, Memory Leak Profiler, dan Network Monitor.</p>",
        "quiz": {
          "q": "Jenis pengujian otomatis apakah di Flutter yang memverifikasi tampilan dan interaksi komponen widget tanpa memerlukan perangkat emulator fisik?",
          "options": [
            "Unit Test",
            "Widget Test",
            "Stress Test",
            "Manual Test"
          ],
          "answer": 1,
          "explanation": "Widget Test menguji komponen UI secara terisolasi dengan kecepatan tinggi menggunakan lingkungan simulasi framework."
        }
      },
      "flutter_performance_optimization": {
        "title": "Performance & Optimization: Impeller Engine",
        "summary": "Mencegah lag dan jank pada animasi, memahami rendering engine Impeller, penggunaan const constructor, dan pencegahan memory leak.",
        "content": "\n<p class=\"lead\">Flutter 3.x memperkenalkan mesin rendering grafis generasi baru bernama <strong>Impeller</strong> yang menggantikan Skia untuk membasmi *shader compilation jank* selamanya.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-gauge-high text-primary me-2\"></i>Praktik Terbaik Kinerja Tinggi:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Gunakan keyword <code>const</code></strong>: Widget dengan konstruktor <code>const</code> tidak akan di-rebuild ulang saat parent widget melakukan render.</li>\n        <li><strong>Hindari Objek Berat di build()</strong>: Jangan pernah membuat HTTP request atau inisialisasi controller di dalam method <code>build()</code>.</li>\n        <li><strong>Dispose Controller</strong>: Selalu panggil <code>controller.dispose()</code> di method <code>dispose()</code> untuk mencegah kebocoran memori.</li>\n    </ul>\n</div>\n",
        "example_title": "Optimasi Render: const Widget & RepaintBoundary",
        "example_code": "import 'package:flutter/material.dart';\n\nclass OptimizedListView extends StatelessWidget {\n  const OptimizedListView({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Performance & Impeller')),\n      // ListView.builder melakukan lazy rendering hanya untuk item yang terlihat di layar\n      body: ListView.builder(\n        itemCount: 500,\n        itemBuilder: (context, index) {\n          // RepaintBoundary mengisolasi render tree item dari rebuild tetangga\n          return RepaintBoundary(\n            child: ListTile(\n              leading: const CircleAvatar(child: Icon(Icons.code)),\n              title: Text('Modul Pembelajaran #$index'),\n              subtitle: const Text('Dioptimasi dengan const constructor'),\n            ),\n          );\n        },\n      ),\n    );\n  }\n}",
        "explanation": "<p>Mesin rendering Impeller melakukan pre-kompilasi shader saat waktu kompilasi aplikasi, menghasilkan gerakan animasi yang mulus tanpa patah-patah.</p>",
        "quiz": {
          "q": "Apa nama rendering engine generasi terbaru di Flutter yang menghilangkan shader compilation jank?",
          "options": [
            "Vulkan",
            "Impeller",
            "Blink",
            "MetalCore"
          ],
          "answer": 1,
          "explanation": "Impeller adalah mesin rendering grafis modern yang dirancang khusus dari nol oleh tim Flutter untuk menggantikan Skia."
        }
      },
      "flutter_deployment": {
        "title": "Deployment & Release: Google Play & App Store",
        "summary": "Proses perilisan aplikasi produksi: pembuatan keystore, build Android App Bundle (AAB), archive iOS via Xcode, dan publikasi ke toko aplikasi.",
        "content": "\n<p class=\"lead\">Setelah aplikasi selesai dikembangkan, langkah final adalah mengemas kode ke dalam format biner terproteksi dan merilisnya ke <strong>Google Play Store</strong> dan <strong>Apple App Store</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-cloud-arrow-up text-primary me-2\"></i>Langkah Rilis Android & iOS:</h6>\n    <ol class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Ubah Ikon & Nama Aplikasi</strong>: Gunakan paket <code>flutter_launcher_icons</code> untuk menghasilkan ikon berbagai resolusi.</li>\n        <li><strong>Generate Signing Keystore (Android)</strong>: Buat kunci digital <code>upload-keystore.jks</code> untuk menandatangani paket APK/AAB.</li>\n        <li><strong>Build Android App Bundle</strong>: Jalankan perintah <code>flutter build appbundle --release</code>.</li>\n        <li><strong>Build iOS Archive</strong>: Buka folder <code>ios</code> di Xcode, atur Bundle Identifier dan Provisioning Profile, lalu Archive ke TestFlight.</li>\n    </ol>\n</div>\n",
        "example_title": "Perintah Build Rilis Android (AAB) & iOS",
        "example_code": "# 1. Bersihkan build cache lama\nflutter clean\nflutter pub get\n\n# 2. Build Android App Bundle (AAB) untuk Google Play Store\nflutter build appbundle --release --obfuscate --split-debug-info=./symbols\n\n# 3. Atau Build APK Mandiri (Universal) untuk distribusi langsung\nflutter build apk --release\n\n# 4. Build iOS Archive untuk Apple App Store (di macOS)\nflutter build ipa --release",
        "explanation": "<p>Google Play Store mewajibkan format <strong>Android App Bundle (AAB)</strong> agar server Google Play dapat mengirimkan ukuran download yang paling kecil sesuai arsitektur CPU masing-masing smartphone pengguna.</p>",
        "quiz": {
          "q": "Perintah CLI apakah yang digunakan untuk mengkompilasi aplikasi Flutter ke format Android App Bundle untuk rilis ke Google Play Store?",
          "options": [
            "flutter build apk",
            "flutter build appbundle",
            "flutter release android",
            "flutter compile playstore"
          ],
          "answer": 1,
          "explanation": "flutter build appbundle menghasilkan berkas biner teroptimasi .aab yang siap diunggah ke Google Play Console."
        }
      },
      "flutter_add_to_app": {
        "title": "Add Flutter to an Existing App",
        "summary": "Arsitektur integrasi modul Flutter ke dalam proyek native Android (Kotlin) atau iOS (Swift) yang telah berjalan di perusahaan.",
        "content": "\n<p class=\"lead\">Banyak perusahaan besar tidak membangun ulang seluruh aplikasinya dari awal, melainkan menyematkan fitur baru berbasis Flutter ke dalam aplikasi native yang sudah ada menggunakan teknik <strong>Add-to-App</strong>.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-puzzle-piece text-primary me-2\"></i>Komponen Add-to-App:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>FlutterEngine</code>: Mesin runtime yang dapat di-prewarm di latar belakang agar layar Flutter terbuka instan tanpa jeda putih (*no splash latency*).</li>\n        <li><code>FlutterActivity</code> (Android) & <code>FlutterViewController</code> (iOS): Kontainer native host yang merender antarmuka Flutter.</li>\n        <li><strong>Flutter Module</strong>: Proyek tipe modul khusus yang dikompilasi sebagai AAR (Android) atau CocoaPods Framework (iOS).</li>\n    </ul>\n</div>\n",
        "example_title": "Integrasi Modul Flutter ke Native Android (Kotlin)",
        "example_code": "// MainActivity.kt pada Aplikasi Native Android\npackage com.skillance.enterprise\n\nimport android.os.Bundle\nimport androidx.appcompat.app.AppCompatActivity\nimport io.flutter.embedding.android.FlutterActivity\n\nclass MainActivity : AppCompatActivity() {\n    override fun onCreate(savedInstanceState: Bundle?) {\n        super.onCreate(savedInstanceState)\n        setContentView(R.layout.activity_main)\n\n        // Membuka modul Flutter sebagai Activity terpisah saat tombol ditekan\n        findViewById<android.widget.Button>(R.id.btnBukaAkademi).setOnClickListener {\n            startActivity(\n                FlutterActivity.createDefaultIntent(this)\n            )\n        }\n    }\n}",
        "explanation": "<p>Fitur Add-to-App memungkinkan migrasi bertahap dari aplikasi warisan (*legacy native*) ke Flutter tanpa risiko tinggi.</p>",
        "quiz": {
          "q": "Objek apa di native Android/iOS yang bertanggung jawab menjalankan Dart VM dan me-render grafis Flutter dalam arsitektur Add-to-App?",
          "options": [
            "FlutterEngine",
            "DartRunner",
            "SkiaBridge",
            "FlutterContainer"
          ],
          "answer": 0,
          "explanation": "FlutterEngine mengelola siklus hidup runtime Flutter dan dapat diinisialisasi lebih awal (pre-warm) untuk kecepatan buka instan."
        }
      }
    },
    "AI": {
      "flutter_ai_develop": {
        "title": "Develop with AI: AI Code Assistance",
        "summary": "Memanfaatkan AI Coding Assistant (Gemini Code Assist, GitHub Copilot) untuk mempercepat penulisan kode Flutter dan pembuatan unit test.",
        "content": "\n<p class=\"lead\">Pengembang Flutter modern memanfaatkan alat bantu kecerdasan buatan (AI) untuk meningkatkan produktivitas koding, mulai dari menghasilkan widget kustom hingga menemukan bug.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-robot text-primary me-2\"></i>Skenario Penggunaan AI dalam Flutter:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Generasi CustomPainter</strong>: Menulis kurva matematika kompleks dan animasi kustom dari instruksi bahasa manusia.</li>\n        <li><strong>Pembuatan Mock Data & Model Class</strong>: Menghasilkan parsing JSON dan model entity lengkap dengan null safety dalam hitungan detik.</li>\n        <li><strong>Otomasi Penulisan Unit Test</strong>: AI menganalisis fungsi bisnis dan membuat skenario uji edge-case yang komprehensif.</li>\n    </ul>\n</div>\n",
        "example_title": "Prompting & Generate Komponen Flutter dengan AI",
        "example_code": "// Hasil Generate AI: Widget Kartu Profil Siswa Modern Material 3\nimport 'package:flutter/material.dart';\n\nclass StudentProfileCard extends StatelessWidget {\n  final String nama;\n  final String learningPath;\n  final String avatarUrl;\n\n  const StudentProfileCard({\n    super.key,\n    required this.nama,\n    required this.learningPath,\n    required this.avatarUrl,\n  });\n\n  @override\n  Widget build(BuildContext context) {\n    return Card(\n      elevation: 2,\n      margin: const EdgeInsets.all(12),\n      child: ListTile(\n        leading: CircleAvatar(backgroundImage: NetworkImage(avatarUrl)),\n        title: Text(nama, style: const TextStyle(fontWeight: FontWeight.bold)),\n        subtitle: Text(learningPath),\n        trailing: const Icon(Icons.verified, color: Colors.blue),\n      ),\n    );\n  }\n}",
        "explanation": "<p>AI bertindak sebagai *copilot* yang mempercepat penulisan boilerplate code sehingga developer dapat fokus pada arsitektur dan kepuasan pengguna.</p>",
        "quiz": {
          "q": "Manakah cara terbaik dalam memanfaatkan AI coding assistant saat mengembangkan aplikasi Flutter?",
          "options": [
            "Menyalin kode tanpa membaca",
            "Menggunakan AI untuk mempercepat pembuatan boilerplate, model data, dan uji coba lalu meninjaunya secara kritis",
            "Menghapus pengujian manual",
            "Membiarkan AI menentukan arsitektur tanpa pengawasan"
          ],
          "answer": 1,
          "explanation": "AI paling efektif untuk mempercepat pembuatan kode boilerplate dan pengujian, namun tetap memerlukan tinjauan kritis dari developer."
        }
      },
      "flutter_ai_apps": {
        "title": "Build AI-Powered Apps with Google Gemini API",
        "summary": "Membangun fitur aplikasi cerdas masa depan di Flutter dengan integrasi SDK resmi Google Gemini AI (google_generative_ai).",
        "content": "\n<p class=\"lead\">Google menyediakan SDK resmi <strong>google_generative_ai</strong> untuk bahasa Dart, memungkinkan Anda menyematkan model multimodal <strong>Gemini 1.5 Pro & Flash</strong> langsung ke dalam aplikasi Flutter.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-brain text-primary me-2\"></i>Kemampuan Fitur Gemini di Mobile:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Chatbot Interaktif & Streaming</strong>: Respons teks cerdas yang dialirkan kata-per-kata secara real-time via <code>model.generateContentStream()</code>.</li>\n        <li><strong>Analisis Gambar Multimodal</strong>: Pengguna memotret dokumen atau foto, dan AI mengekstraksi data atau mendeteksi kerusakan secara visual.</li>\n        <li><strong>Ringkasan Konten Otomatis</strong>: Meringkas artikel atau materi belajar yang panjang menjadi poin-poin ringkas.</li>\n    </ul>\n</div>\n",
        "example_title": "Integrasi Google Gemini API Resmi di Flutter",
        "example_code": "import 'package:flutter/material.dart';\nimport 'package:google_generative_ai/google_generative_ai.dart';\n\nclass GeminiAssistantScreen extends StatefulWidget {\n  const GeminiAssistantScreen({super.key});\n\n  @override\n  State<GeminiAssistantScreen> createState() => _GeminiAssistantScreenState();\n}\n\nclass _GeminiAssistantScreenState extends State<GeminiAssistantScreen> {\n  final _promptController = TextEditingController();\n  String _hasilJawaban = 'Tanyakan sesuatu kepada Skillance AI...';\n  bool _isLoading = false;\n\n  Future<void> _tanyaGemini() async {\n    setState(() => _isLoading = true);\n    final model = GenerativeModel(\n      model: 'gemini-1.5-flash',\n      apiKey: 'AIzaSy_YOUR_API_KEY_HERE',\n    );\n    final response = await model.generateContent([Content.text(_promptController.text)]);\n    setState(() {\n      _hasilJawaban = response.text ?? 'Tidak ada jawaban';\n      _isLoading = false;\n    });\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return Scaffold(\n      appBar: AppBar(title: const Text('Gemini AI Assistant')),\n      body: Padding(\n        padding: const EdgeInsets.all(16),\n        child: Column(\n          children: [\n            TextField(controller: _promptController, decoration: const InputDecoration(labelText: 'Pertanyaan')),\n            const SizedBox(height: 8),\n            ElevatedButton(onPressed: _tanyaGemini, child: const Text('Kirim ke Gemini AI')),\n            const SizedBox(height: 16),\n            _isLoading ? const CircularProgressIndicator() : Text(_hasilJawaban),\n          ],\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Integrasi Gemini di Flutter sangat mudah karena SDK <code>google_generative_ai</code> mengelola koneksi API, serialisasi prompt, dan streaming respons secara otomatis.</p>",
        "quiz": {
          "q": "Package resmi Google apakah yang digunakan untuk mengintegrasikan model Gemini AI ke dalam aplikasi Flutter dan Dart?",
          "options": [
            "flutter_gemini_api",
            "google_generative_ai",
            "dart_openai",
            "gemini_mobile"
          ],
          "answer": 1,
          "explanation": "google_generative_ai adalah SDK resmi dari Google untuk berinteraksi dengan API Gemini di ekosistem Dart dan Flutter."
        }
      }
    },
    "Resources": {
      "flutter_tools_editors": {
        "title": "Tools & Editors: VS Code, Android Studio & CLI",
        "summary": "Optimasi ruang kerja pengembangan Flutter menggunakan ekstensi esensial VS Code, Android Studio, dan shortcut produktivitas harian.",
        "content": "\n<p class=\"lead\">Editor koding yang dikonfigurasi dengan baik akan melipatgandakan kecepatan pengembangan Anda hingga 2x lipat.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-keyboard text-primary me-2\"></i>Shortcut Wajib Developer Flutter:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>Alt + Enter</code> (VS Code): Menampilkan menu *Quick Fix* untuk membungkus widget dengan Padding, Row, Column, atau mengekstrak widget.</li>\n        <li><code>r</code> (di terminal): Melakukan <strong>Hot Reload</strong> instan tanpa kehilangan state variabel.</li>\n        <li><code>R</code> (huruf besar): Melakukan <strong>Hot Restart</strong> untuk mereset seluruh state dari awal.</li>\n        <li><code>flutter clean</code>: Membersihkan cache berkas build lama jika terjadi error kompilasi yang aneh.</li>\n    </ul>\n</div>\n",
        "example_title": "Konfigurasi Debug VS Code & Shortcut Hot Reload",
        "example_code": "// .vscode/launch.json\n{\n  \"version\": \"0.2.0\",\n  \"configurations\": [\n    {\n      \"name\": \"Skillance App (Debug Mode)\",\n      \"request\": \"launch\",\n      \"type\": \"dart\",\n      \"program\": \"lib/main.dart\",\n      \"flutterMode\": \"debug\"\n    },\n    {\n      \"name\": \"Skillance App (Release Mode)\",\n      \"request\": \"launch\",\n      \"type\": \"dart\",\n      \"program\": \"lib/main.dart\",\n      \"flutterMode\": \"release\"\n    }\n  ]\n}\n\n// Pintasan Keyboard Produktivitas:\n//   r      : Hot Reload (Perbarui perubahan UI < 300ms)\n//   R      : Hot Restart (Muat ulang State aplikasi)\n//   p      : Tampilkan Debug Paint",
        "explanation": "<p>Menggunakan fitur *Extract Widget* secara konsisten menjaga pohon widget tetap ramping, mudah dibaca, dan modular.</p>",
        "quiz": {
          "q": "Tombol keyboard apa di terminal yang digunakan untuk melakukan Hot Reload instan pada aplikasi Flutter yang sedang berjalan?",
          "options": [
            "h",
            "r",
            "c",
            "F5"
          ],
          "answer": 1,
          "explanation": "Menekan tombol 'r' kecil pada terminal Flutter menjalankan Hot Reload dan memperbarui UI dalam hitungan milidetik."
        }
      },
      "flutter_core_concepts": {
        "title": "Flutter Core Concepts: Three Trees & Keys",
        "summary": "Memahami arsitektur internal Flutter: Widget Tree, Element Tree, RenderObject Tree, dan peran penting Keys.",
        "content": "\n<p class=\"lead\">Untuk menjadi Software Engineer Flutter tingkat senior, Anda harus memahami apa yang terjadi di balik layar ketika Flutter merender piksel ke layar.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-network-wired text-primary me-2\"></i>Tiga Pohon di Balik Flutter:</h6>\n    <ol class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Widget Tree</strong>: Pohon konfigurasi deklaratif yang murah dan ringan. Widget sering dibuat dan dihancurkan secara instan.</li>\n        <li><strong>Element Tree</strong>: Pengelola siklus hidup yang mengaitkan konfigurasi Widget dengan objek RenderObject yang sebenarnya di layar.</li>\n        <li><strong>RenderObject Tree</strong>: Objek berat yang menghitung tata letak geometris, batas ukuran, dan menggambar piksel (*painting*) langsung ke GPU.</li>\n    </ol>\n</div>\n<p class=\"small text-muted\"><strong>Kapan butuh Keys?</strong> Gunakan <code>ValueKey</code> atau <code>GlobalKey</code> ketika Anda memiliki daftar item bertipe sama yang dapat diubah urutannya atau dihapus untuk mempertahankan state internalnya.</p>\n",
        "example_title": "Konsep Three Trees & ValueKey pada Widget Tree",
        "example_code": "import 'package:flutter/material.dart';\n\nvoid main() => runApp(const KeyDemoApp());\n\nclass KeyDemoApp extends StatefulWidget {\n  const KeyDemoApp({super.key});\n\n  @override\n  State<KeyDemoApp> createState() => _KeyDemoAppState();\n}\n\nclass _KeyDemoAppState extends State<KeyDemoApp> {\n  List<String> items = ['Modul 1: Dasar Dart', 'Modul 2: Layout Flutter'];\n\n  void _tukarPosisi() {\n    setState(() {\n      items = items.reversed.toList();\n    });\n  }\n\n  @override\n  Widget build(BuildContext context) {\n    return MaterialApp(\n      home: Scaffold(\n        appBar: AppBar(title: const Text('ValueKey & Three Trees')),\n        body: ListView(\n          children: items.map((t) {\n            // ValueKey mengikat identitas Widget ke Element Tree secara unik\n            return ListTile(\n              key: ValueKey(t),\n              leading: const Icon(Icons.bookmark),\n              title: Text(t),\n            );\n          }).toList(),\n        ),\n        floatingActionButton: FloatingActionButton(\n          onPressed: _tukarPosisi,\n          child: const Icon(Icons.swap_vert),\n        ),\n      ),\n    );\n  }\n}",
        "explanation": "<p>Dengan memisahkan Widget yang ringan dari RenderObject yang berat, Flutter dapat membangun ulang ribuan widget tanpa penurunan performa sedikitpun.</p>",
        "quiz": {
          "q": "Pohon manakah di Flutter yang bertanggung jawab langsung menghitung koordinat ukuran dan menggambar piksel ke GPU?",
          "options": [
            "Widget Tree",
            "Element Tree",
            "RenderObject Tree",
            "State Tree"
          ],
          "answer": 2,
          "explanation": "RenderObject Tree adalah pohon yang mengelola perhitungan tata letak dan penggambaran langsung ke layar perangkat."
        }
      },
      "flutter_app_solutions": {
        "title": "App Solutions & Enterprise Patterns: Offline-First & CI/CD",
        "summary": "Pola arsitektur aplikasi skala besar: sinkronisasi Offline-First, Monorepo Melos, serta otomatisasi pipeline CI/CD GitHub Actions & Fastlane.",
        "content": "\n<p class=\"lead\">Membangun aplikasi enterprise membutuhkan keandalan tingkat tinggi, seperti kemampuan bekerja tanpa internet (*Offline-First*) dan otomatisasi build (*CI/CD*).</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-server text-primary me-2\"></i>Pola Enterprise Unggulan:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><strong>Arsitektur Offline-First</strong>: Data disimpan terlebih dahulu ke database lokal (SQLite/Hive), lalu disinkronkan ke server cloud melalui antrean sinkronisasi di latar belakang.</li>\n        <li><strong>Automasi CI/CD</strong>: Menggunakan GitHub Actions untuk menjalankan <code>flutter analyze</code> dan <code>flutter test</code> setiap kali ada Pull Request baru.</li>\n        <li><strong>Distribusi Otomatis Fastlane</strong>: Mengotomasi penandatanganan sertifikat iOS dan upload otomatis ke Firebase App Distribution atau Play Console internal testing.</li>\n    </ul>\n</div>\n",
        "example_title": "Pola Arsitektur Offline-First Menggunakan Hive",
        "example_code": "import 'package:hive/hive.dart';\n\n// Model Data Lokal (Offline-First)\nclass PesertaBootcamp {\n  final String nama;\n  final String statusKelulusan;\n\n  PesertaBootcamp({required this.nama, required this.statusKelulusan});\n}\n\n// Repository Pattern yang memprioritaskan database lokal saat koneksi internet terputus\nclass BootcampRepository {\n  final Box _box;\n\n  BootcampRepository(this._box);\n\n  Future<void> simpanLokal(String id, Map<String, dynamic> data) async {\n    await _box.put(id, data);\n  }\n\n  Map<String, dynamic>? ambilLokal(String id) {\n    return _box.get(id);\n  }\n}",
        "explanation": "<p>Aplikasi Offline-First memberikan responsivitas instan bagi pengguna karena UI tidak pernah menunggu jeda koneksi internet untuk menampilkan data.</p>",
        "quiz": {
          "q": "Apa keuntungan utama dari penerapan arsitektur Offline-First pada aplikasi mobile?",
          "options": [
            "Aplikasi tidak membutuhkan database",
            "Pengguna tetap dapat melihat dan menginput data tanpa koneksi internet dan tersinkronisasi saat online",
            "Ukuran aplikasi menjadi lebih kecil",
            "Tidak memerlukan API backend"
          ],
          "answer": 1,
          "explanation": "Offline-First memastikan pengguna dapat terus beraktivitas menggunakan penyimpanan lokal dan data dikirim ke cloud saat internet tersedia."
        }
      },
      "flutter_from_another_platform": {
        "title": "From Another Platform: React Native & Native to Flutter",
        "summary": "Panduan transisi bagi developer React Native, Android Native (Kotlin), iOS (Swift), atau Web ke ekosistem Flutter.",
        "content": "\n<p class=\"lead\">Banyak engineer beralih ke Flutter dari platform lain karena arsitektur kompilasi langsungnya yang tidak menggunakan jembatan JavaScript (*no JS bridge*) serta ekosistem widget yang konsisten.</p>\n<div class=\"table-responsive\">\n    <table class=\"table table-bordered table-sm small\">\n        <thead class=\"table-light\"><tr><th>Konsep</th><th>Web / React Native</th><th>Android Native</th><th>Flutter (Dart)</th></tr></thead>\n        <tbody>\n            <tr><td>Kontainer Dasar</td><td><code>&lt;div&gt;</code> / <code>&lt;View&gt;</code></td><td><code>ViewGroup</code> / <code>FrameLayout</code></td><td><code>Container</code> / <code>SizedBox</code></td></tr>\n            <tr><td>Susunan Vertikal</td><td><code>flexDirection: 'column'</code></td><td><code>LinearLayout (vertical)</code></td><td><code>Column</code></td></tr>\n            <tr><td>Teks</td><td><code>&lt;span&gt;</code> / <code>&lt;Text&gt;</code></td><td><code>TextView</code></td><td><code>Text</code></td></tr>\n            <tr><td>Tombol</td><td><code>&lt;button&gt;</code></td><td><code>Button</code></td><td><code>ElevatedButton</code></td></tr>\n            <tr><td>Styling</td><td>CSS class / StyleSheet</td><td>XML attributes</td><td>Widget constructor arguments</td></tr>\n        </tbody>\n    </table>\n</div>\n",
        "example_title": "Peta Perbandingan React Native vs Flutter Widget",
        "example_code": "// TABEL PERBANDINGAN KOMPONEN:\n// React Native: <View style={{ flexDirection: 'column' }}> ... </View>\n// Flutter:      Column(children: [ ... ])\n\n// React Native: <Text style={{ fontSize: 16 }}>Halo</Text>\n// Flutter:      Text('Halo', style: TextStyle(fontSize: 16))\n\n// React Native: <TouchableOpacity onPress={...}> ... </TouchableOpacity>\n// Flutter:      InkWell(onTap: ..., child: ...)\n\nimport 'package:flutter/material.dart';\n\nclass ComparisonWidget extends StatelessWidget {\n  const ComparisonWidget({super.key});\n\n  @override\n  Widget build(BuildContext context) {\n    return Container(\n      padding: const EdgeInsets.all(16),\n      child: const Text('Flutter merender langsung lewat Skia / Impeller ke kanvas native!'),\n    );\n  }\n}",
        "explanation": "<p>Karena Flutter mengontrol setiap piksel di layar, aplikasi Flutter di Android versi lama akan terlihat sama persis cantiknya dengan di Android versi terbaru.</p>",
        "quiz": {
          "q": "Mengapa performa grafis Flutter umumnya lebih konsisten dibandingkan framework hybrid berbasis JavaScript?",
          "options": [
            "Karena Flutter tidak menggunakan jembatan JS Bridge dan merender piksel langsung via engine grafis native",
            "Karena Flutter hanya berjalan di Android",
            "Karena Flutter menggunakan HTML5 Canvas",
            "Karena Dart tidak memiliki tipe data"
          ],
          "answer": 0,
          "explanation": "Flutter tidak memerlukan jembatan JS Bridge; kodenya dikompilasi AOT ke kode mesin dan digambar langsung oleh engine grafis."
        }
      },
      "flutter_stay_up_to_date": {
        "title": "Stay Up to Date & Manage Install",
        "summary": "Mengelola versi SDK dengan FVM (Flutter Version Management), meng-upgrade Flutter channel stable, dan mematuhi best practices rilis resmi.",
        "content": "\n<p class=\"lead\">Tim pengembang Flutter di Google merilis pembaruan stabil setiap kuartal dengan peningkatan performa, fitur baru, dan optimasi baterai.</p>\n<div class=\"card bg-light border-0 p-3 mb-3 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-arrows-spin text-primary me-2\"></i>Perintah Pemeliharaan SDK:</h6>\n    <ul class=\"mb-0 small\" style=\"line-height: 1.8;\">\n        <li><code>flutter upgrade</code>: Memperbarui Flutter SDK dan dependensi engine ke versi rilis stabil terbaru.</li>\n        <li><code>flutter channel</code>: Melihat dan beralih antara channel <strong>stable</strong>, <strong>beta</strong>, atau <strong>master</strong>.</li>\n        <li><strong>FVM (Flutter Version Management)</strong>: Alat untuk mengisolasi versi Flutter berbeda untuk setiap proyek yang Anda kerjakan di satu laptop.</li>\n    </ul>\n</div>\n",
        "example_title": "Manajemen Versi Flutter SDK dengan FVM",
        "example_code": "# 1. Pasang FVM (Flutter Version Management) secara global\ndart pub global activate fvm\n\n# 2. Pasang versi stabil resmi Flutter\nfvm install 3.24.0\n\n# 3. Kunci versi SDK khusus untuk proyek ini\nfvm use 3.24.0\n\n# 4. Jalankan perintah melalui FVM\nfvm flutter doctor\nfvm flutter run\n\n# 5. Cek daftar versi Flutter yang terpasang di komputer\nfvm list",
        "explanation": "<p>Selalu gunakan channel <code>stable</code> untuk aplikasi produksi komersial guna menjamin stabilitas dan kompatibilitas dependensi.</p>",
        "quiz": {
          "q": "Channel Flutter manakah yang paling direkomendasikan untuk pengembangan aplikasi produksi komersial?",
          "options": [
            "master",
            "beta",
            "stable",
            "nightly"
          ],
          "answer": 2,
          "explanation": "Channel stable adalah rilis yang telah melewati pengujian ketat dan ditujukan untuk aplikasi produksi."
        }
      }
    }
  }
}
JSON_DATA, true);

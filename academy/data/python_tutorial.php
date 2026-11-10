<?php
/**
 * Silabus Lengkap Tutorial Python - Skillance Academy Indonesia
 * Semua Materi & Contoh Kode Menggunakan Sintaks Murni Python 3.12 (PEP 8)
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "Python Tutorial": {
      "py_home": {
        "title": "Python HOME",
        "summary": "Selamat datang di Tutorial Python Skillance Academy. Bahasa pemrograman paling populer untuk Web, AI, Data Science, dan Otomasi.",
        "content": "<p class=\"lead\">Selamat datang di Tutorial Python Skillance Academy. Bahasa pemrograman paling populer untuk Web, AI, Data Science, dan Otomasi.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python HOME:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python HOME",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Halo Dunia Skillance Academy!')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python HOME</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_intro": {
        "title": "Python Intro",
        "summary": "Pengenalan Python: Mengapa Python begitu digemari, sintaks bersih yang menyerupai bahasa Inggris, dan penggunaannya di industri global.",
        "content": "<p class=\"lead\">Pengenalan Python: Mengapa Python begitu digemari, sintaks bersih yang menyerupai bahasa Inggris, dan penggunaannya di industri global.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Intro:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Intro",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nnama = 'Python 3.12'\nprint(f'Mempelajari {nama} di Skillance Academy')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Intro</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_getstarted": {
        "title": "Python Get Started",
        "summary": "Instalasi Python di Windows, macOS, Linux, serta memeriksa versi aktif di terminal (`python --version`).",
        "content": "<p class=\"lead\">Instalasi Python di Windows, macOS, Linux, serta memeriksa versi aktif di terminal (`python --version`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Get Started:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Get Started",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport sys\nprint('Versi Python:', sys.version.split()[0])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Get Started</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_syntax": {
        "title": "Python Syntax",
        "summary": "Aturan indentasi Python (4 spasi) sebagai pengganti kurung kurawal `{}` untuk menentukan blok kode.",
        "content": "<p class=\"lead\">Aturan indentasi Python (4 spasi) sebagai pengganti kurung kurawal `{}` untuk menentukan blok kode.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Syntax:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Syntax",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nif 5 > 2:\n    print('Lima lebih besar dari dua!')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Syntax</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_output": {
        "title": "Python Output",
        "summary": "Mencetak data ke layar menggunakan fungsi `print()`, parameter `sep`, dan `end`.",
        "content": "<p class=\"lead\">Mencetak data ke layar menggunakan fungsi `print()`, parameter `sep`, dan `end`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Output:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Output",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Skillance', 'Academy', sep=' - ', end=' 🚀\\n')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Output</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_comments": {
        "title": "Python Comments",
        "summary": "Menulis komentar baris tunggal (`#`) dan multi-baris docstring (`''' ... '''`).",
        "content": "<p class=\"lead\">Menulis komentar baris tunggal (`#`) dan multi-baris docstring (`''' ... '''`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Comments:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Comments",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\n# Ini komentar yang tidak dieksekusi\nprint('Komentar membantu dokumentasi kode')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Comments</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_variables": {
        "title": "Python Variables",
        "summary": "Membuat variabel dinamis tanpa perlu deklarasi tipe secara eksplisit (Dynamic Typing).",
        "content": "<p class=\"lead\">Membuat variabel dinamis tanpa perlu deklarasi tipe secara eksplisit (Dynamic Typing).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Variables:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Variables",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nnama = 'Faisal'\numur = 21\nprint(nama, 'berusia', umur, 'tahun')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Variables</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_datatypes": {
        "title": "Python Data Types",
        "summary": "Tipe data bawaan: text (`str`), numeric (`int`, `float`), sequence (`list`, `tuple`), mapping (`dict`), boolean (`bool`).",
        "content": "<p class=\"lead\">Tipe data bawaan: text (`str`), numeric (`int`, `float`), sequence (`list`, `tuple`), mapping (`dict`), boolean (`bool`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Data Types:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Data Types",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ndata = [10, 'Teks', 3.14, True]\nfor item in data:\n    print(item, type(item).__name__)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Data Types</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_numbers": {
        "title": "Python Numbers",
        "summary": "Bekerja dengan angka integer, float desimal, dan bilangan kompleks (`1j`).",
        "content": "<p class=\"lead\">Bekerja dengan angka integer, float desimal, dan bilangan kompleks (`1j`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Numbers:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Numbers",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nx = 10\ny = 2.5\nz = 1j\nprint(x * y, type(z))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Numbers</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_casting": {
        "title": "Python Casting",
        "summary": "Konversi tipe data: `int()`, `float()`, dan `str()` secara aman.",
        "content": "<p class=\"lead\">Konversi tipe data: `int()`, `float()`, dan `str()` secara aman.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Casting:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Casting",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nangka_str = '50'\nangka_int = int(angka_str)\nprint('Hasil penjumlahan:', angka_int + 25)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Casting</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_strings": {
        "title": "Python Strings",
        "summary": "Manipulasi teks: slicing `[start:end]`, fungsi `len()`, escape character, dan operasi string.",
        "content": "<p class=\"lead\">Manipulasi teks: slicing `[start:end]`, fungsi `len()`, escape character, dan operasi string.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Strings:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Strings",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nteks = 'Skillance Academy'\nprint('Panjang:', len(teks), '| Huruf Pertama:', teks[0])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Strings</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_booleans": {
        "title": "Python Booleans",
        "summary": "Nilai logika kebenaran `True` dan `False` serta evaluasi ekspresi kondisi `bool()`.",
        "content": "<p class=\"lead\">Nilai logika kebenaran `True` dan `False` serta evaluasi ekspresi kondisi `bool()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Booleans:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Booleans",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint(bool('Halo'))\nprint(bool(0))\nprint(10 > 5)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Booleans</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_operators": {
        "title": "Python Operators",
        "summary": "Operator aritmetika, pembanding (`==`, `!=`), logika (`and`, `or`, `not`), dan keanggotaan (`in`, `not in`).",
        "content": "<p class=\"lead\">Operator aritmetika, pembanding (`==`, `!=`), logika (`and`, `or`, `not`), dan keanggotaan (`in`, `not in`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Operators:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Operators",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\na = 15\nb = 4\nprint('Sisa Bagi (Modulo):', a % b)\nprint('Pangkat:', a ** 2)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Operators</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_lists": {
        "title": "Python Lists",
        "summary": "Koleksi data terurut dan dapat diubah (mutable): append, insert, remove, pop, dan sort.",
        "content": "<p class=\"lead\">Koleksi data terurut dan dapat diubah (mutable): append, insert, remove, pop, dan sort.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Lists:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Lists",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nmateri = ['HTML', 'CSS', 'JavaScript']\nmateri.append('Python')\nprint('Daftar Materi:', materi)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Lists</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_tuples": {
        "title": "Python Tuples",
        "summary": "Koleksi data terurut yang tidak dapat diubah (immutable) setelah dibuat.",
        "content": "<p class=\"lead\">Koleksi data terurut yang tidak dapat diubah (immutable) setelah dibuat.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Tuples:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Tuples",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nkoordinat = (-4.0, 121.5)\nprint('Latitude:', koordinat[0], '| Longitude:', koordinat[1])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Tuples</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_sets": {
        "title": "Python Sets",
        "summary": "Koleksi data tidak terurut, tidak berindeks, dan otomatis menghapus elemen duplikat.",
        "content": "<p class=\"lead\">Koleksi data tidak terurut, tidak berindeks, dan otomatis menghapus elemen duplikat.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Sets:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Sets",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nhobi = {'Koding', 'Desain', 'Koding', 'Membaca'}\nprint('Hobi Unik:', hobi)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Sets</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dictionaries": {
        "title": "Python Dictionaries",
        "summary": "Struktur data pasangan kunci-nilai (key-value pairs) yang sangat cepat dan fleksibel.",
        "content": "<p class=\"lead\">Struktur data pasangan kunci-nilai (key-value pairs) yang sangat cepat dan fleksibel.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Dictionaries:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Dictionaries",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nsiswa = {'nama': 'Ahmad', 'jurusan': 'Informatika', 'nilai': 95}\nprint('Nama:', siswa['nama'], '| Nilai:', siswa.get('nilai'))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Dictionaries</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_if_else": {
        "title": "Python If...Else",
        "summary": "Percabangan logika keputusan menggunakan `if`, `elif`, dan `else` bersarang.",
        "content": "<p class=\"lead\">Percabangan logika keputusan menggunakan `if`, `elif`, dan `else` bersarang.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python If...Else:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python If...Else",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nnilai = 85\nif nilai >= 80:\n    print('Predikat: A (Sangat Memuaskan)')\nelse:\n    print('Predikat: Lulus')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python If...Else</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_match": {
        "title": "Python Match",
        "summary": "Struktur pencocokan pola modern (Pattern Matching) diperkenalkan pada Python 3.10+.",
        "content": "<p class=\"lead\">Struktur pencocokan pola modern (Pattern Matching) diperkenalkan pada Python 3.10+.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Match:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Match",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nstatus = 200\nmatch status:\n    case 200: print('OK - Berhasil')\n    case 404: print('Not Found')\n    case _: print('Unknown Status')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Match</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_while_loops": {
        "title": "Python While Loops",
        "summary": "Perulangan yang terus berjalan selama kondisi bernilai benar beserta klausa `break` dan `continue`.",
        "content": "<p class=\"lead\">Perulangan yang terus berjalan selama kondisi bernilai benar beserta klausa `break` dan `continue`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python While Loops:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python While Loops",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ni = 1\nwhile i <= 3:\n    print('Iterasi ke-', i)\n    i += 1",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python While Loops</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_for_loops": {
        "title": "Python For Loops",
        "summary": "Perulangan iterasi melalui sekuens list, tuple, string, atau generator `range()`.",
        "content": "<p class=\"lead\">Perulangan iterasi melalui sekuens list, tuple, string, atau generator `range()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python For Loops:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python For Loops",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfor huruf in 'Koding':\n    print(huruf, end='-')\nprint('Selesai')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python For Loops</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_functions": {
        "title": "Python Functions",
        "summary": "Mendefinisikan blok fungsi dengan `def`, parameter default, `*args`, `**kwargs`, dan `return`.",
        "content": "<p class=\"lead\">Mendefinisikan blok fungsi dengan `def`, parameter default, `*args`, `**kwargs`, dan `return`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Functions:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Functions",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ndef sapa(nama, peran='Mahasiswa'):\n    return f'Halo {nama}, selamat datang sebagai {peran}!'\nprint(sapa('Rian'))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Functions</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_range": {
        "title": "Python Range",
        "summary": "Menghasilkan barisan bilangan terurut `range(start, stop, step)` untuk perulangan efisien.",
        "content": "<p class=\"lead\">Menghasilkan barisan bilangan terurut `range(start, stop, step)` untuk perulangan efisien.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Range:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Range",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint(list(range(2, 11, 2)))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Range</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_arrays": {
        "title": "Python Arrays",
        "summary": "Penggunaan modul `array` bawaan untuk menyimpan koleksi elemen bertipe homogen.",
        "content": "<p class=\"lead\">Penggunaan modul `array` bawaan untuk menyimpan koleksi elemen bertipe homogen.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Arrays:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Arrays",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport array as arr\na = arr.array('i', [1, 2, 3, 4])\nprint('Array Integer:', a.tolist())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Arrays</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_iterators": {
        "title": "Python Iterators",
        "summary": "Objek iterator yang mengimplementasikan protokol iterasi: fungsi `iter()` dan `next()`.",
        "content": "<p class=\"lead\">Objek iterator yang mengimplementasikan protokol iterasi: fungsi `iter()` dan `next()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Iterators:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Iterators",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nbuah = ['Apel', 'Mangga']\nit = iter(buah)\nprint(next(it))\nprint(next(it))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Iterators</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modules": {
        "title": "Python Modules",
        "summary": "Membuat, mengimpor, dan mengorganisasi file modul Python (`import modul`, `from modul import fungsi`).",
        "content": "<p class=\"lead\">Membuat, mengimpor, dan mengorganisasi file modul Python (`import modul`, `from modul import fungsi`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Modules:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Modules",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport math\nprint('Akar 144:', math.sqrt(144))\nprint('Nilai Pi:', round(math.pi, 2))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Modules</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dates": {
        "title": "Python Dates",
        "summary": "Mengelola tanggal, waktu, dan format zona waktu dengan modul bawaan `datetime`.",
        "content": "<p class=\"lead\">Mengelola tanggal, waktu, dan format zona waktu dengan modul bawaan `datetime`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Dates:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Dates",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport datetime\nsekarang = datetime.datetime.now()\nprint('Tahun Aktif:', sekarang.year)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Dates</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_math": {
        "title": "Python Math",
        "summary": "Operasi matematika lanjutan: trigonometri, logaritma, pembulatan ceil/floor, dan faktorial.",
        "content": "<p class=\"lead\">Operasi matematika lanjutan: trigonometri, logaritma, pembulatan ceil/floor, dan faktorial.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Math:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Math",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport math\nprint('Faktorial 5!:', math.factorial(5))\nprint('Ceil 4.2:', math.ceil(4.2))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Math</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_json": {
        "title": "Python JSON",
        "summary": "Konversi parsing teks JSON ke dictionary Python (`json.loads()`) dan serialisasi (`json.dumps()`).",
        "content": "<p class=\"lead\">Konversi parsing teks JSON ke dictionary Python (`json.loads()`) dan serialisasi (`json.dumps()`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python JSON:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python JSON",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport json\ndata_json = '{\"kursus\": \"Python\", \"level\": \"Lanjutan\"}'\nobj = json.loads(data_json)\nprint(obj['kursus'], obj['level'])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python JSON</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_regex": {
        "title": "Python RegEx",
        "summary": "Pencarian pola ekspresi reguler dengan modul `re`: `re.search()`, `re.findall()`, `re.sub()`.",
        "content": "<p class=\"lead\">Pencarian pola ekspresi reguler dengan modul `re`: `re.search()`, `re.findall()`, `re.sub()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python RegEx:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python RegEx",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport re\ntxt = 'Hubungi admin@skillance.my.id hari ini'\nmatch = re.search(r'[\\w\\.-]+@[\\w\\.-]+', txt)\nprint('Email Terdeteksi:', match.group())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python RegEx</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_pip": {
        "title": "Python PIP",
        "summary": "Package manager resmi untuk mengunduh dan mengelola library eksternal dari PyPI (`pip install package`).",
        "content": "<p class=\"lead\">Package manager resmi untuk mengunduh dan mengelola library eksternal dari PyPI (`pip install package`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python PIP:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python PIP",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Perintah Terminal Resmi:')\nprint('$ pip install requests numpy pandas')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python PIP</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_try_except": {
        "title": "Python Try...Except",
        "summary": "Menangani error perkecualian (Exception Handling) secara aman dengan blok `try`, `except`, `else`, dan `finally`.",
        "content": "<p class=\"lead\">Menangani error perkecualian (Exception Handling) secara aman dengan blok `try`, `except`, `else`, dan `finally`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Try...Except:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Try...Except",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ntry:\n    hasil = 10 / 0\nexcept ZeroDivisionError as err:\n    print('Tertangkap Error:', err)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Try...Except</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_string_formatting": {
        "title": "Python String Formatting",
        "summary": "Format string modern: F-Strings (`f'{nilai:.2f}'`), `format()`, dan operator `%`.",
        "content": "<p class=\"lead\">Format string modern: F-Strings (`f'{nilai:.2f}'`), `format()`, dan operator `%`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python String Formatting:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python String Formatting",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nharga = 75000\ndiskon = 0.15\ntotal = harga * (1 - diskon)\nprint(f'Total Bayar: Rp {total:,.2f}')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python String Formatting</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_none": {
        "title": "Python None",
        "summary": "Mengenal tipe data `NoneType` untuk merepresentasikan ketiadaan nilai atau nilai kosong.",
        "content": "<p class=\"lead\">Mengenal tipe data `NoneType` untuk merepresentasikan ketiadaan nilai atau nilai kosong.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python None:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python None",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nhasil = None\nif hasil is None:\n    print('Variabel belum memiliki nilai')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python None</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_user_input": {
        "title": "Python User Input",
        "summary": "Menerima masukan dari keyboard pengguna melalui fungsi `input()` di terminal.",
        "content": "<p class=\"lead\">Menerima masukan dari keyboard pengguna melalui fungsi `input()` di terminal.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python User Input:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python User Input",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nnama_input = 'Budi Santoso' # Simulasi masukan input()\nprint(f'Selamat datang, {nama_input}!')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python User Input</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_virtualenv": {
        "title": "Python VirtualEnv",
        "summary": "Membuat lingkungan virtual terisolasi (`python -m venv venv`) agar dependensi proyek tidak bentrok.",
        "content": "<p class=\"lead\">Membuat lingkungan virtual terisolasi (`python -m venv venv`) agar dependensi proyek tidak bentrok.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python VirtualEnv:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python VirtualEnv",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Membuat Virtual Environment:')\nprint('$ python -m venv env_skillance')\nprint('$ source env_skillance/bin/activate')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python VirtualEnv</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Classes": {
      "py_oop": {
        "title": "Python OOP",
        "summary": "Prinsip dasar Object-Oriented Programming: mengorganisasi kode ke dalam kelas dan objek nyata.",
        "content": "<p class=\"lead\">Prinsip dasar Object-Oriented Programming: mengorganisasi kode ke dalam kelas dan objek nyata.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python OOP:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python OOP",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('OOP Python: Class, Objek, Enkapsulasi, Pewarisan, Polimorfisme')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python OOP</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_classes_objects": {
        "title": "Python Classes/Objects",
        "summary": "Mendefinisikan class cetak biru dan membuat instansiasi objek mandiri.",
        "content": "<p class=\"lead\">Mendefinisikan class cetak biru dan membuat instansiasi objek mandiri.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Classes/Objects:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Classes/Objects",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Mobil:\n    roda = 4\navanza = Mobil()\nprint('Jumlah Roda Avanza:', avanza.roda)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Classes/Objects</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_class_init": {
        "title": "Python __init__ Method",
        "summary": "Fungsi konstruktor spesial `__init__()` untuk menginisialisasi atribut objek saat dibuat.",
        "content": "<p class=\"lead\">Fungsi konstruktor spesial `__init__()` untuk menginisialisasi atribut objek saat dibuat.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python __init__ Method:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python __init__ Method",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Siswa:\n    def __init__(self, nama, nim):\n        self.nama = nama\n        self.nim = nim\ns1 = Siswa('Dian', '2026001')\nprint(s1.nama, s1.nim)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python __init__ Method</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_class_self": {
        "title": "Python self Parameter",
        "summary": "Peran parameter `self` sebagai referensi ke instance aktif objek di dalam method.",
        "content": "<p class=\"lead\">Peran parameter `self` sebagai referensi ke instance aktif objek di dalam method.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python self Parameter:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python self Parameter",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Akun:\n    def __init__(self, saldo):\n        self.saldo = saldo\n    def cek(self):\n        return f'Saldo: Rp {self.saldo}'\na = Akun(500000)\nprint(a.cek())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python self Parameter</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_class_properties": {
        "title": "Python Class Properties",
        "summary": "Menggunakan decorator `@property` untuk membuat getter dan setter yang bersih.",
        "content": "<p class=\"lead\">Menggunakan decorator `@property` untuk membuat getter dan setter yang bersih.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Class Properties:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Class Properties",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Produk:\n    def __init__(self, harga):\n        self._harga = harga\n    @property\n    def harga(self):\n        return self._harga\np = Produk(15000)\nprint('Harga Produk:', p.harga)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Class Properties</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_class_methods": {
        "title": "Python Class Methods",
        "summary": "Memahami perbedaan Instance Method, `@classmethod` (cls), dan `@staticmethod`.",
        "content": "<p class=\"lead\">Memahami perbedaan Instance Method, `@classmethod` (cls), dan `@staticmethod`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Class Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Class Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Matematika:\n    @staticmethod\n    def tambah(x, y):\n        return x + y\nprint('Hasil Tambah:', Matematika.tambah(8, 7))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Class Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_magic_methods": {
        "title": "Python Magic Methods",
        "summary": "Dunder methods seperti `__str__()`, `__repr__()`, `__len__()`, dan `__eq__()`.",
        "content": "<p class=\"lead\">Dunder methods seperti `__str__()`, `__repr__()`, `__len__()`, dan `__eq__()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Magic Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Magic Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Buku:\n    def __init__(self, judul):\n        self.judul = judul\n    def __str__(self):\n        return f'Buku: {self.judul}'\nb = Buku('Mastering Python')\nprint(b)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Magic Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_inheritance": {
        "title": "Python Inheritance",
        "summary": "Pewarisan sifat class anak dari class induk beserta pemanggilan fungsi `super()`.",
        "content": "<p class=\"lead\">Pewarisan sifat class anak dari class induk beserta pemanggilan fungsi `super()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Inheritance:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Inheritance",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Orang:\n    def __init__(self, nama): self.nama = nama\nclass Mahasiswa(Orang):\n    def kuliah(self): return f'{self.nama} sedang belajar di Skillance.'\nm = Mahasiswa('Rizky')\nprint(m.kuliah())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Inheritance</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_polymorphism": {
        "title": "Python Polymorphism",
        "summary": "Kemampuan metode dengan nama yang sama untuk dieksekusi dengan perilaku berbeda pada class berbeda.",
        "content": "<p class=\"lead\">Kemampuan metode dengan nama yang sama untuk dieksekusi dengan perilaku berbeda pada class berbeda.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Polymorphism:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Polymorphism",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Kucing: bersuara = lambda self: 'Meong!'\nclass Anjing: bersuara = lambda self: 'Guk guk!'\nfor hewan in [Kucing(), Anjing()]:\n    print(hewan.bersuara())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Polymorphism</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_encapsulation": {
        "title": "Python Encapsulation",
        "summary": "Menyembunyikan atribut internal menggunakan prefix underscore privat (`_protected`, `__private`).",
        "content": "<p class=\"lead\">Menyembunyikan atribut internal menggunakan prefix underscore privat (`_protected`, `__private`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Encapsulation:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Encapsulation",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Dompet:\n    def __init__(self):\n        self.__pin = '1234'\n    def verifikasi(self, p): return self.__pin == p\nd = Dompet()\nprint('PIN Valid:', d.verifikasi('1234'))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Encapsulation</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_class_inner": {
        "title": "Python Inner Classes",
        "summary": "Mendefinisikan class di dalam class lain untuk mengelompokkan struktur data hierarkis.",
        "content": "<p class=\"lead\">Mendefinisikan class di dalam class lain untuk mengelompokkan struktur data hierarkis.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Inner Classes:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Inner Classes",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Komputer:\n    def __init__(self):\n        self.cpu = self.CPU()\n    class CPU:\n        def spek(self): return 'Intel Core i7 14th Gen'\nk = Komputer()\nprint('Spek CPU:', k.cpu.spek())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Inner Classes</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "File Handling": {
      "py_file_handling": {
        "title": "Python File Handling",
        "summary": "Operasi dasar berkas dengan fungsi `open()` dan mode akses (`'r'`, `'w'`, `'a'`, `'x'`).",
        "content": "<p class=\"lead\">Operasi dasar berkas dengan fungsi `open()` dan mode akses (`'r'`, `'w'`, `'a'`, `'x'`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python File Handling:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python File Handling",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Mode File Python:\\n# r = Read, w = Write, a = Append, x = Create')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python File Handling</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_file_read": {
        "title": "Python Read Files",
        "summary": "Membaca isi file menggunakan `read()`, `readline()`, dan `readlines()` serta blok `with open()`.",
        "content": "<p class=\"lead\">Membaca isi file menggunakan `read()`, `readline()`, dan `readlines()` serta blok `with open()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Read Files:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Read Files",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Membaca File Aman:\\nwith open(\"data.txt\", \"r\") as f:\\n    konten = f.read()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Read Files</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_file_write": {
        "title": "Python Write/Create Files",
        "summary": "Menulis data baru ke file (`'w'`) atau menambahkan ke akhir baris (`'a'`).",
        "content": "<p class=\"lead\">Menulis data baru ke file (`'w'`) atau menambahkan ke akhir baris (`'a'`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Write/Create Files:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Write/Create Files",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Menulis File Baru:\\nwith open(\"catatan.txt\", \"w\") as f:\\n    f.write(\"Halo Skillance!\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Write/Create Files</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_file_delete": {
        "title": "Python Delete Files",
        "summary": "Menghapus file dan direktori secara terprogram dengan modul `os` (`os.remove()`, `os.rmdir()`).",
        "content": "<p class=\"lead\">Menghapus file dan direktori secara terprogram dengan modul `os` (`os.remove()`, `os.rmdir()`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Delete Files:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Delete Files",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport os\nprint('Memeriksa File Ada:', os.path.exists('file_demo.txt'))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Delete Files</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Modules": {
      "py_mod_numpy": {
        "title": "NumPy Tutorial",
        "summary": "Pustaka komputasi numerik array N-dimensi berperforma tinggi untuk sains data.",
        "content": "<p class=\"lead\">Pustaka komputasi numerik array N-dimensi berperforma tinggi untuk sains data.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci NumPy Tutorial:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: NumPy Tutorial",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Komputasi NumPy Array:\\nimport numpy as np\\na = np.array([1, 2, 3])\\nprint(a * 2)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>NumPy Tutorial</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mod_pandas": {
        "title": "Pandas Tutorial",
        "summary": "Manipulasi dan analisis data tabular berbasis DataFrame dan Series.",
        "content": "<p class=\"lead\">Manipulasi dan analisis data tabular berbasis DataFrame dan Series.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Pandas Tutorial:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Pandas Tutorial",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Analisis Data Pandas:\\nimport pandas as pd\\ndf = pd.DataFrame({\"Nama\": [\"Ali\"], \"Nilai\": [90]})\\nprint(df)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Pandas Tutorial</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mod_scipy": {
        "title": "SciPy Tutorial",
        "summary": "Pustaka algoritma ilmiah untuk optimasi matematis, aljabar linier, dan pemrosesan sinyal.",
        "content": "<p class=\"lead\">Pustaka algoritma ilmiah untuk optimasi matematis, aljabar linier, dan pemrosesan sinyal.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci SciPy Tutorial:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: SciPy Tutorial",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# SciPy Scientific Computing:\\nfrom scipy import constants\\nprint(\"Kecepatan Cahaya:\", constants.c)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>SciPy Tutorial</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mod_django": {
        "title": "Django Tutorial",
        "summary": "Web framework tingkat tinggi berbasis arsitektur MTV (Model-Template-View) untuk aplikasi skala enterprise.",
        "content": "<p class=\"lead\">Web framework tingkat tinggi berbasis arsitektur MTV (Model-Template-View) untuk aplikasi skala enterprise.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Django Tutorial:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Django Tutorial",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Framework Web Django:\\n# $ django-admin startproject myapp\\nprint(\"Django Server Siap di Port 8000\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Django Tutorial</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Matplotlib": {
      "py_mpl_intro": {
        "title": "Matplotlib Intro",
        "summary": "Pustaka visualisasi grafik 2D paling komprehensif di ekosistem Python.",
        "content": "<p class=\"lead\">Pustaka visualisasi grafik 2D paling komprehensif di ekosistem Python.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Intro:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Intro",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Matplotlib: Visualisasi data statis, animasi, dan interaktif')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Intro</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_getstarted": {
        "title": "Matplotlib Get Started",
        "summary": "Instalasi dan impor `matplotlib.pyplot` untuk merender canvas plot grafik pertama.",
        "content": "<p class=\"lead\">Instalasi dan impor `matplotlib.pyplot` untuk merender canvas plot grafik pertama.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Get Started:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Get Started",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('$ pip install matplotlib\\nimport matplotlib.pyplot as plt')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Get Started</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_pyplot": {
        "title": "Matplotlib Pyplot",
        "summary": "Fungsi antarmuka imperatif `pyplot` untuk menggambar titik koordinat sumbu X dan Y.",
        "content": "<p class=\"lead\">Fungsi antarmuka imperatif `pyplot` untuk menggambar titik koordinat sumbu X dan Y.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Pyplot:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Pyplot",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.plot([1, 2, 3], [4, 5, 6])\\nplt.show()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Pyplot</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_plotting": {
        "title": "Matplotlib Plotting",
        "summary": "Menggambar diagram garis antara titik koordinat X dan Y.",
        "content": "<p class=\"lead\">Menggambar diagram garis antara titik koordinat X dan Y.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Plotting:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Plotting",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Koordinat X: [0, 6], Koordinat Y: [0, 250]\\nGrafik garis linear terhubung')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Plotting</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_markers": {
        "title": "Matplotlib Markers",
        "summary": "Menyesuaikan penanda titik koordinat: lingkaran ('o'), bintang ('*'), warna, dan ukuran.",
        "content": "<p class=\"lead\">Menyesuaikan penanda titik koordinat: lingkaran ('o'), bintang ('*'), warna, dan ukuran.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Markers:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Markers",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.plot(ypoints, marker=\"o\", ms=10, mec=\"red\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Markers</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_line": {
        "title": "Matplotlib Line",
        "summary": "Mengatur gaya garis: linestyle ('dashed', 'dotted'), warna, dan ketebalan (linewidth).",
        "content": "<p class=\"lead\">Mengatur gaya garis: linestyle ('dashed', 'dotted'), warna, dan ketebalan (linewidth).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Line:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Line",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.plot(ypoints, linestyle=\"--\", color=\"#00758f\", linewidth=2.5)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Line</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_labels": {
        "title": "Matplotlib Labels",
        "summary": "Menambahkan judul grafik (`plt.title()`) dan label sumbu (`plt.xlabel()`, `plt.ylabel()`).",
        "content": "<p class=\"lead\">Menambahkan judul grafik (`plt.title()`) dan label sumbu (`plt.xlabel()`, `plt.ylabel()`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Labels:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Labels",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Title: Grafik Penjualan 2026 | Sumbu X: Bulan | Sumbu Y: Omset')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Labels</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_grid": {
        "title": "Matplotlib Grid",
        "summary": "Menampilkan garis kisi-kisi latar belakang (`plt.grid()`) untuk mempermudah pembacaan nilai.",
        "content": "<p class=\"lead\">Menampilkan garis kisi-kisi latar belakang (`plt.grid()`) untuk mempermudah pembacaan nilai.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Grid:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Grid",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.grid(color=\"green\", linestyle=\"--\", linewidth=0.5)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Grid</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_subplot": {
        "title": "Matplotlib Subplot",
        "summary": "Menampilkan beberapa grafik berdampingan dalam satu jendela gambar tunggal (`plt.subplot(rows, cols, index)`).",
        "content": "<p class=\"lead\">Menampilkan beberapa grafik berdampingan dalam satu jendela gambar tunggal (`plt.subplot(rows, cols, index)`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Subplot:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Subplot",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.subplot(1, 2, 1) # Plot 1\\nplt.subplot(1, 2, 2) # Plot 2')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Subplot</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_scatter": {
        "title": "Matplotlib Scatter",
        "summary": "Diagram tebar (Scatter Plot) untuk mengamati korelasi dan persebaran sepasang data numerik.",
        "content": "<p class=\"lead\">Diagram tebar (Scatter Plot) untuk mengamati korelasi dan persebaran sepasang data numerik.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Scatter:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Scatter",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.scatter(usia_mobil, kecepatan)\\nAnalisis sebaran kecepatan kendaraan')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Scatter</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_bars": {
        "title": "Matplotlib Bars",
        "summary": "Diagram batang vertikal (`plt.bar()`) dan horizontal (`plt.barh()`) untuk perbandingan kategori.",
        "content": "<p class=\"lead\">Diagram batang vertikal (`plt.bar()`) dan horizontal (`plt.barh()`) untuk perbandingan kategori.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Bars:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Bars",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.bar([\"HTML\", \"CSS\", \"Python\"], [95, 90, 98])')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Bars</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_histograms": {
        "title": "Matplotlib Histograms",
        "summary": "Diagram frekuensi distribusi numerik ke dalam wadah interval (bins).",
        "content": "<p class=\"lead\">Diagram frekuensi distribusi numerik ke dalam wadah interval (bins).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Histograms:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Histograms",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.hist(data_usia, bins=10)\\nVisualisasi distribusi frekuensi data')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Histograms</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mpl_pie_charts": {
        "title": "Matplotlib Pie Charts",
        "summary": "Diagram lingkaran (`plt.pie()`) untuk merepresentasikan proporsi persentase bagian terhadap keseluruhan.",
        "content": "<p class=\"lead\">Diagram lingkaran (`plt.pie()`) untuk merepresentasikan proporsi persentase bagian terhadap keseluruhan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Matplotlib Pie Charts:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Matplotlib Pie Charts",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('plt.pie([40, 30, 20, 10], labels=[\"Web\", \"Mobile\", \"AI\", \"UIUX\"])')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Matplotlib Pie Charts</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Machine Learning": {
      "py_ml_getstarted": {
        "title": "Getting Started",
        "summary": "Pengenalan Machine Learning: Mengajarkan komputer belajar dari data masa lalu untuk membuat prediksi akurat.",
        "content": "<p class=\"lead\">Pengenalan Machine Learning: Mengajarkan komputer belajar dari data masa lalu untuk membuat prediksi akurat.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Getting Started:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Getting Started",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Machine Learning: Supervised, Unsupervised, and Reinforcement Learning')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Getting Started</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_mean_median_mode": {
        "title": "Mean Median Mode",
        "summary": "Statistika deskriptif: Nilai rata-rata (Mean), nilai tengah (Median), dan nilai tersering muncul (Mode).",
        "content": "<p class=\"lead\">Statistika deskriptif: Nilai rata-rata (Mean), nilai tengah (Median), dan nilai tersering muncul (Mode).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Mean Median Mode:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Mean Median Mode",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport statistics\nnilai = [80, 85, 90, 85, 95]\nprint('Mean:', statistics.mean(nilai), '| Median:', statistics.median(nilai))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Mean Median Mode</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_standard_deviation": {
        "title": "Standard Deviation",
        "summary": "Standar deviasi untuk mengukur seberapa menyebar nilai data dari nilai rata-ratanya.",
        "content": "<p class=\"lead\">Standar deviasi untuk mengukur seberapa menyebar nilai data dari nilai rata-ratanya.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Standard Deviation:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Standard Deviation",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport statistics\nprint('Standar Deviasi:', round(statistics.stdev([80, 85, 90]), 2))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Standard Deviation</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_percentile": {
        "title": "Percentile",
        "summary": "Nilai persentil yang membagi data terurut ke dalam 100 bagian setara.",
        "content": "<p class=\"lead\">Nilai persentil yang membagi data terurut ke dalam 100 bagian setara.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Percentile:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Percentile",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport numpy as np\nusia = [18, 20, 22, 25, 30]\nprint('Persentil 75%:', np.percentile(usia, 75))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Percentile</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_data_distribution": {
        "title": "Data Distribution",
        "summary": "Membuat sekumpulan data acak dengan sebaran probabilitas tertentu untuk eksperimen model.",
        "content": "<p class=\"lead\">Membuat sekumpulan data acak dengan sebaran probabilitas tertentu untuk eksperimen model.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Data Distribution:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Data Distribution",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport numpy as np\ndata = np.random.uniform(0.0, 5.0, 5)\nprint('Data Distribusi Uniform:', np.round(data, 2))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Data Distribution</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_normal_distribution": {
        "title": "Normal Data Distribution",
        "summary": "Distribusi Gaussian (kurva lonceng) di mana sebagian besar nilai mengelompok di sekitar rata-rata.",
        "content": "<p class=\"lead\">Distribusi Gaussian (kurva lonceng) di mana sebagian besar nilai mengelompok di sekitar rata-rata.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Normal Data Distribution:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Normal Data Distribution",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport numpy as np\nx = np.random.normal(5.0, 1.0, 3)\nprint('Distribusi Normal:', np.round(x, 2))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Normal Data Distribution</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_scatterplot": {
        "title": "Scatter Plot",
        "summary": "Memvisualisasikan titik data 2D untuk mengidentifikasi pola hubungan antardata sebelum pelatihan model.",
        "content": "<p class=\"lead\">Memvisualisasikan titik data 2D untuk mengidentifikasi pola hubungan antardata sebelum pelatihan model.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Scatter Plot:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Scatter Plot",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Titik Koordinat Data (X, Y) Siap untuk Regresi')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Scatter Plot</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_linear_regression": {
        "title": "Linear Regression",
        "summary": "Menemukan garis lurus terbaik (y = mx + c) untuk memprediksi nilai masa depan.",
        "content": "<p class=\"lead\">Menemukan garis lurus terbaik (y = mx + c) untuk memprediksi nilai masa depan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Linear Regression:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Linear Regression",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom scipy import stats\nx = [1, 2, 3, 4, 5]; y = [2, 4, 6, 8, 10]\nslope, intercept, r, p, std = stats.linregress(x, y)\nprint('Koefisien Korelasi r:', r)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Linear Regression</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_polynomial_regression": {
        "title": "Polynomial Regression",
        "summary": "Regresi non-linear berbentuk kurva ketika data tidak dapat diwakili oleh garis lurus.",
        "content": "<p class=\"lead\">Regresi non-linear berbentuk kurva ketika data tidak dapat diwakili oleh garis lurus.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Polynomial Regression:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Polynomial Regression",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport numpy as np\nx = [1, 2, 3, 4]; y = [1, 4, 9, 16]\nmodel = np.poly1d(np.polyfit(x, y, 2))\nprint('Prediksi x=5:', model(5))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Polynomial Regression</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_multiple_regression": {
        "title": "Multiple Regression",
        "summary": "Memprediksi satu variabel target berdasarkan dua atau lebih variabel fitur independen.",
        "content": "<p class=\"lead\">Memprediksi satu variabel target berdasarkan dua atau lebih variabel fitur independen.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Multiple Regression:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Multiple Regression",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Model Multi-Fitur: Harga = w1*Luas + w2*Kamar + b')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Multiple Regression</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_scale": {
        "title": "Scale",
        "summary": "Penskalaan fitur (Standardization & Normalization) agar fitur dengan rentang besar tidak mendominasi model.",
        "content": "<p class=\"lead\">Penskalaan fitur (Standardization & Normalization) agar fitur dengan rentang besar tidak mendominasi model.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Scale:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Scale",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.preprocessing import StandardScaler\nprint('StandardScaler: (x - mean) / std')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Scale</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_train_test": {
        "title": "Train/Test",
        "summary": "Membagi dataset menjadi data pelatihan (Train 80%) dan data pengujian (Test 20%) untuk mencegah overfitting.",
        "content": "<p class=\"lead\">Membagi dataset menjadi data pelatihan (Train 80%) dan data pengujian (Test 20%) untuk mencegah overfitting.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Train/Test:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Train/Test",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.model_selection import train_test_split\nprint('Membagi Dataset Menjadi Train & Test')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Train/Test</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_decision_tree": {
        "title": "Decision Tree",
        "summary": "Algoritma pohon keputusan untuk klasifikasi dan prediksi berbasis serangkaian kondisi pertanyaan.",
        "content": "<p class=\"lead\">Algoritma pohon keputusan untuk klasifikasi dan prediksi berbasis serangkaian kondisi pertanyaan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Decision Tree:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Decision Tree",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn import tree\nprint('Pohon Keputusan (DecisionTreeClassifier) Terlatih')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Decision Tree</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_confusion_matrix": {
        "title": "Confusion Matrix",
        "summary": "Tabel evaluasi kinerja klasifikasi: True Positive, False Positive, True Negative, False Negative.",
        "content": "<p class=\"lead\">Tabel evaluasi kinerja klasifikasi: True Positive, False Positive, True Negative, False Negative.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Confusion Matrix:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Confusion Matrix",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn import metrics\nprint('Matriks Konfusi: Akurasi, Presisi, dan Recall')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Confusion Matrix</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_hierarchical_clustering": {
        "title": "Hierarchical Clustering",
        "summary": "Pengelompokan data tanpa label (Unsupervised) berbasis dendrogram hierarkis kemiripan.",
        "content": "<p class=\"lead\">Pengelompokan data tanpa label (Unsupervised) berbasis dendrogram hierarkis kemiripan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Hierarchical Clustering:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Hierarchical Clustering",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Dendrogram Pengelompokan Data Hierarkis')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Hierarchical Clustering</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_logistic_regression": {
        "title": "Logistic Regression",
        "summary": "Klasifikasi probabilitas biner (misal: spam vs bukan spam, lulus vs gagal) berbasis fungsi sigmoid.",
        "content": "<p class=\"lead\">Klasifikasi probabilitas biner (misal: spam vs bukan spam, lulus vs gagal) berbasis fungsi sigmoid.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Logistic Regression:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Logistic Regression",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.linear_model import LogisticRegression\nprint('Logistic Regression Model Siap Klasifikasi')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Logistic Regression</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_grid_search": {
        "title": "Grid Search",
        "summary": "Menemukan kombinasi hyperparameter terbaik untuk memaksimalkan skor akurasi model.",
        "content": "<p class=\"lead\">Menemukan kombinasi hyperparameter terbaik untuk memaksimalkan skor akurasi model.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Grid Search:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Grid Search",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.model_selection import GridSearchCV\nprint('Pencarian Hyperparameter Terbaik Selesai')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Grid Search</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_categorical_data": {
        "title": "Categorical Data",
        "summary": "Mengubah data kategori teks (One-Hot Encoding, LabelEncoder) menjadi angka yang dimengerti model.",
        "content": "<p class=\"lead\">Mengubah data kategori teks (One-Hot Encoding, LabelEncoder) menjadi angka yang dimengerti model.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Categorical Data:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Categorical Data",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport pandas as pd\ndf = pd.get_dummies(['Merah', 'Biru', 'Merah'])\nprint('One-Hot Encoding Selesai')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Categorical Data</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_kmeans": {
        "title": "K-means",
        "summary": "Algoritma clustering untuk mempartisi n observasi ke dalam k kelompok terdekat berdasarkan centroid.",
        "content": "<p class=\"lead\">Algoritma clustering untuk mempartisi n observasi ke dalam k kelompok terdekat berdasarkan centroid.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci K-means:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: K-means",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.cluster import KMeans\nprint('K-Means Centroid Terbentuk')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>K-means</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_bootstrap_aggregation": {
        "title": "Bootstrap Aggregation",
        "summary": "Teknik ensemble (Bagging) seperti Random Forest untuk meningkatkan stabilitas dan akurasi.",
        "content": "<p class=\"lead\">Teknik ensemble (Bagging) seperti Random Forest untuk meningkatkan stabilitas dan akurasi.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Bootstrap Aggregation:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Bootstrap Aggregation",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.ensemble import BaggingClassifier\nprint('Ensemble Bagging Classifier Berjalan')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Bootstrap Aggregation</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_cross_validation": {
        "title": "Cross Validation",
        "summary": "Validasi silang K-Fold untuk menguji keandalan model pada berbagai subset data.",
        "content": "<p class=\"lead\">Validasi silang K-Fold untuk menguji keandalan model pada berbagai subset data.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Cross Validation:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Cross Validation",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.model_selection import cross_val_score\nprint('K-Fold Cross Validation Score Evaluasi')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Cross Validation</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_auc_roc": {
        "title": "AUC - ROC Curve",
        "summary": "Kurva karakteristik operasi penerima untuk mengukur kemampuan pemisahan kelas model biner.",
        "content": "<p class=\"lead\">Kurva karakteristik operasi penerima untuk mengukur kemampuan pemisahan kelas model biner.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci AUC - ROC Curve:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: AUC - ROC Curve",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Metrik AUC-ROC: Nilai 1.0 Menunjukkan Model Sempurna')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>AUC - ROC Curve</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ml_knn": {
        "title": "K-nearest neighbors",
        "summary": "Algoritma KNN untuk mengklasifikasikan titik data baru berdasarkan mayoritas tetangga terdekatnya.",
        "content": "<p class=\"lead\">Algoritma KNN untuk mengklasifikasikan titik data baru berdasarkan mayoritas tetangga terdekatnya.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci K-nearest neighbors:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: K-nearest neighbors",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom sklearn.neighbors import KNeighborsClassifier\nprint('KNN Classifier Siap Digunakan')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>K-nearest neighbors</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python DSA": {
      "py_dsa_intro": {
        "title": "Python DSA",
        "summary": "Pengantar Struktur Data & Algoritma: Efisiensi memori, eksekusi waktu, dan notasi Big-O (O(1), O(n), O(log n)).",
        "content": "<p class=\"lead\">Pengantar Struktur Data & Algoritma: Efisiensi memori, eksekusi waktu, dan notasi Big-O (O(1), O(n), O(log n)).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python DSA:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python DSA",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Notasi Big-O: Analisis Kompleksitas Waktu & Ruang')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python DSA</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_lists_arrays": {
        "title": "Lists and Arrays",
        "summary": "Penggunaan list dan array dinamis sebagai struktur data dasar penyimpanan elemen terurut.",
        "content": "<p class=\"lead\">Penggunaan list dan array dinamis sebagai struktur data dasar penyimpanan elemen terurut.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Lists and Arrays:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Lists and Arrays",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\narr = [10, 20, 30]\narr.append(40)\nprint('Array Elemen:', arr)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Lists and Arrays</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_stacks": {
        "title": "Stacks",
        "summary": "Struktur data LIFO (Last In First Out): operasi push (append) dan pop pada tumpukan.",
        "content": "<p class=\"lead\">Struktur data LIFO (Last In First Out): operasi push (append) dan pop pada tumpukan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Stacks:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Stacks",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nstack = []\nstack.append('A'); stack.append('B')\nprint('Pop Teratas:', stack.pop())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Stacks</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_queues": {
        "title": "Queues",
        "summary": "Struktur data FIFO (First In First Out): antrean data menggunakan `collections.deque`.",
        "content": "<p class=\"lead\">Struktur data FIFO (First In First Out): antrean data menggunakan `collections.deque`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Queues:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Queues",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nfrom collections import deque\nq = deque(['Antrean 1', 'Antrean 2'])\nprint('Keluar:', q.popleft())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Queues</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_linked_lists": {
        "title": "Linked Lists",
        "summary": "Senarai berantai: node yang saling menunjuk melalui pointer referensi `next`.",
        "content": "<p class=\"lead\">Senarai berantai: node yang saling menunjuk melalui pointer referensi `next`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Linked Lists:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Linked Lists",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass Node: def __init__(self, val): self.val = val; self.next = None\nn1 = Node('A'); n1.next = Node('B')\nprint(n1.val, '->', n1.next.val)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Linked Lists</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_hash_tables": {
        "title": "Hash Tables",
        "summary": "Peta hash berbasis kunci-nilai dengan waktu pencarian rata-rata instan O(1).",
        "content": "<p class=\"lead\">Peta hash berbasis kunci-nilai dengan waktu pencarian rata-rata instan O(1).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Hash Tables:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Hash Tables",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nhash_table = {'id_01': 'Faisal', 'id_02': 'Siti'}\nprint('Lookup ID:', hash_table['id_01'])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Hash Tables</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_trees": {
        "title": "Trees",
        "summary": "Struktur hierarki bercabang yang terdiri dari simpul akar (root) dan simpul anak (child nodes).",
        "content": "<p class=\"lead\">Struktur hierarki bercabang yang terdiri dari simpul akar (root) dan simpul anak (child nodes).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Trees:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Trees",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Struktur Data Tree: Root -> Node Anak')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Trees</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_binary_trees": {
        "title": "Binary Trees",
        "summary": "Pohon biner di mana setiap simpul memiliki maksimal dua anak (kiri dan kanan).",
        "content": "<p class=\"lead\">Pohon biner di mana setiap simpul memiliki maksimal dua anak (kiri dan kanan).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Binary Trees:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Binary Trees",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nclass TNode: def __init__(self, v): self.v = v; self.l = None; self.r = None\nroot = TNode(10); root.l = TNode(5)\nprint('Root:', root.v, '| Anak Kiri:', root.l.v)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Binary Trees</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_binary_search_trees": {
        "title": "Binary Search Trees",
        "summary": "BST: Subtree kiri selalu lebih kecil dan subtree kanan selalu lebih besar dari simpul induk.",
        "content": "<p class=\"lead\">BST: Subtree kiri selalu lebih kecil dan subtree kanan selalu lebih besar dari simpul induk.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Binary Search Trees:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Binary Search Trees",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('BST: Pencarian Terarah O(log n)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Binary Search Trees</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_avl_trees": {
        "title": "AVL Trees",
        "summary": "Pohon pencarian biner yang menyeimbangkan ketinggian dirinya secara mandiri (Self-Balancing).",
        "content": "<p class=\"lead\">Pohon pencarian biner yang menyeimbangkan ketinggian dirinya secara mandiri (Self-Balancing).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci AVL Trees:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: AVL Trees",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('AVL Tree: Rotasi Kiri/Kanan Menjaga Keseimbangan')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>AVL Trees</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_graphs": {
        "title": "Graphs",
        "summary": "Graf jaringan yang tersusun atas simpul (Vertices) dan sisi penghubung (Edges).",
        "content": "<p class=\"lead\">Graf jaringan yang tersusun atas simpul (Vertices) dan sisi penghubung (Edges).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Graphs:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Graphs",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ngraph = {'A': ['B', 'C'], 'B': ['A'], 'C': ['A']}\nprint('Tetangga Node A:', graph['A'])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Graphs</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_linear_search": {
        "title": "Linear Search",
        "summary": "Algoritma pencarian berurutan satu per satu dari awal hingga akhir dengan kompleksitas O(n).",
        "content": "<p class=\"lead\">Algoritma pencarian berurutan satu per satu dari awal hingga akhir dengan kompleksitas O(n).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Linear Search:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Linear Search",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ndef linear(arr, x):\n    for i, v in enumerate(arr): \n        if v == x: return i\n    return -1\nprint('Indeks Angka 30:', linear([10, 20, 30, 40], 30))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Linear Search</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_binary_search": {
        "title": "Binary Search",
        "summary": "Pencarian bagi-dua pada data yang telah terurut dengan kecepatan O(log n).",
        "content": "<p class=\"lead\">Pencarian bagi-dua pada data yang telah terurut dengan kecepatan O(log n).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Binary Search:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Binary Search",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport bisect\ndata = [10, 20, 30, 40, 50]\nprint('Posisi 40:', bisect.bisect_left(data, 40))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Binary Search</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_bubble_sort": {
        "title": "Bubble Sort",
        "summary": "Algoritma pengurutan dengan menukar elemen bersebelahan yang tidak berurutan berulang kali.",
        "content": "<p class=\"lead\">Algoritma pengurutan dengan menukar elemen bersebelahan yang tidak berurutan berulang kali.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Bubble Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Bubble Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\narr = [64, 34, 25, 12, 22]\narr.sort() # Representasi sort\nprint('Hasil Bubble Sort:', arr)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Bubble Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_selection_sort": {
        "title": "Selection Sort",
        "summary": "Pengurutan dengan berulang kali memilih elemen terkecil dan memindahkannya ke posisi awal.",
        "content": "<p class=\"lead\">Pengurutan dengan berulang kali memilih elemen terkecil dan memindahkannya ke posisi awal.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Selection Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Selection Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Selection Sort: Mencari Nilai Minimum O(n^2)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Selection Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_insertion_sort": {
        "title": "Insertion Sort",
        "summary": "Menyisipkan elemen ke posisi yang tepat pada bagian array yang sudah diurutkan.",
        "content": "<p class=\"lead\">Menyisipkan elemen ke posisi yang tepat pada bagian array yang sudah diurutkan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Insertion Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Insertion Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Insertion Sort: Efisien untuk Data Berukuran Kecil')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Insertion Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_quick_sort": {
        "title": "Quick Sort",
        "summary": "Algoritma Divide and Conquer berbasis pivot dengan performa rata-rata tercepat O(n log n).",
        "content": "<p class=\"lead\">Algoritma Divide and Conquer berbasis pivot dengan performa rata-rata tercepat O(n log n).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Quick Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Quick Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Quick Sort: Partisi Pivot Kiri & Kanan')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Quick Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_counting_sort": {
        "title": "Counting Sort",
        "summary": "Pengurutan berbasis penghitungan frekuensi kemunculan nilai tanpa melakukan perbandingan elemen.",
        "content": "<p class=\"lead\">Pengurutan berbasis penghitungan frekuensi kemunculan nilai tanpa melakukan perbandingan elemen.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Counting Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Counting Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Counting Sort: Linear Time O(n + k)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Counting Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_radix_sort": {
        "title": "Radix Sort",
        "summary": "Pengurutan digit per digit dari Least Significant Digit (LSD) hingga Most Significant Digit (MSD).",
        "content": "<p class=\"lead\">Pengurutan digit per digit dari Least Significant Digit (LSD) hingga Most Significant Digit (MSD).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Radix Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Radix Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Radix Sort: Pengurutan Angka Berbasis Digit')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Radix Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_dsa_merge_sort": {
        "title": "Merge Sort",
        "summary": "Pengurutan stabil Divide and Conquer dengan membagi dua array lalu menggabungkannya kembali secara terurut.",
        "content": "<p class=\"lead\">Pengurutan stabil Divide and Conquer dengan membagi dua array lalu menggabungkannya kembali secara terurut.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Merge Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Merge Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Merge Sort: Pembagian Rekursif O(n log n)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Merge Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python MySQL": {
      "py_mysql_getstarted": {
        "title": "MySQL Get Started",
        "summary": "Menghubungkan Python ke database MySQL menggunakan driver `mysql-connector-python`.",
        "content": "<p class=\"lead\">Menghubungkan Python ke database MySQL menggunakan driver `mysql-connector-python`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Get Started:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Get Started",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('import mysql.connector\\nconn = mysql.connector.connect(host=\"localhost\", user=\"root\", password=\"root\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Get Started</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_create_db": {
        "title": "MySQL Create Database",
        "summary": "Membuat basis data baru secara terprogram melalui perintah SQL `CREATE DATABASE`.",
        "content": "<p class=\"lead\">Membuat basis data baru secara terprogram melalui perintah SQL `CREATE DATABASE`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Create Database:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Create Database",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"CREATE DATABASE db_skillance\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Create Database</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_create_table": {
        "title": "MySQL Create Table",
        "summary": "Mendefinisikan tabel baru lengkap dengan tipe kolom dan primary key auto_increment.",
        "content": "<p class=\"lead\">Mendefinisikan tabel baru lengkap dengan tipe kolom dan primary key auto_increment.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Create Table:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Create Table",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"CREATE TABLE siswa (id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(255))\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Create Table</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_insert": {
        "title": "MySQL Insert",
        "summary": "Menyisipkan baris rekaman data baru ke dalam tabel MySQL dengan parameter prepared statements.",
        "content": "<p class=\"lead\">Menyisipkan baris rekaman data baru ke dalam tabel MySQL dengan parameter prepared statements.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Insert:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Insert",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"INSERT INTO siswa (nama) VALUES (%s)\", (\"Faisal\",))\\nconn.commit()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Insert</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_select": {
        "title": "MySQL Select",
        "summary": "Mengambil data rekaman tabel menggunakan method `cursor.fetchall()` atau `cursor.fetchone()`.",
        "content": "<p class=\"lead\">Mengambil data rekaman tabel menggunakan method `cursor.fetchall()` atau `cursor.fetchone()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Select:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Select",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"SELECT * FROM siswa\")\\nfor row in cursor.fetchall(): print(row)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Select</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_where": {
        "title": "MySQL Where",
        "summary": "Menyaring baris data spesifik menggunakan klausa kondisi `WHERE`.",
        "content": "<p class=\"lead\">Menyaring baris data spesifik menggunakan klausa kondisi `WHERE`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Where:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Where",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"SELECT * FROM siswa WHERE id = %s\", (1,))')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Where</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_orderby": {
        "title": "MySQL Order By",
        "summary": "Mengurutkan data hasil kueri secara menaik (`ASC`) atau menurun (`DESC`).",
        "content": "<p class=\"lead\">Mengurutkan data hasil kueri secara menaik (`ASC`) atau menurun (`DESC`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Order By:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Order By",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"SELECT * FROM siswa ORDER BY nama ASC\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Order By</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_delete": {
        "title": "MySQL Delete",
        "summary": "Menghapus rekaman data tertentu dari tabel MySQL.",
        "content": "<p class=\"lead\">Menghapus rekaman data tertentu dari tabel MySQL.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Delete:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Delete",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"DELETE FROM siswa WHERE id = %s\", (1,))\\nconn.commit()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Delete</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_drop_table": {
        "title": "MySQL Drop Table",
        "summary": "Menghapus tabel dari database menggunakan perintah `DROP TABLE IF EXISTS`.",
        "content": "<p class=\"lead\">Menghapus tabel dari database menggunakan perintah `DROP TABLE IF EXISTS`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Drop Table:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Drop Table",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"DROP TABLE IF EXISTS tabel_demo\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Drop Table</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_update": {
        "title": "MySQL Update",
        "summary": "Memperbarui isi kolom data pada baris yang telah ada.",
        "content": "<p class=\"lead\">Memperbarui isi kolom data pada baris yang telah ada.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Update:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Update",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"UPDATE siswa SET nama = %s WHERE id = %s\", (\"Ahmad Faisal\", 1))')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Update</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_limit": {
        "title": "MySQL Limit",
        "summary": "Membatasi jumlah baris hasil kueri dan membuat pagination dengan `LIMIT` dan `OFFSET`.",
        "content": "<p class=\"lead\">Membatasi jumlah baris hasil kueri dan membuat pagination dengan `LIMIT` dan `OFFSET`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Limit:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Limit",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"SELECT * FROM siswa LIMIT 5 OFFSET 0\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Limit</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mysql_join": {
        "title": "MySQL Join",
        "summary": "Menggabungkan dua tabel relasional atau lebih menggunakan klausa `INNER JOIN`.",
        "content": "<p class=\"lead\">Menggabungkan dua tabel relasional atau lebih menggunakan klausa `INNER JOIN`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MySQL Join:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MySQL Join",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('cursor.execute(\"SELECT s.nama, k.kelas FROM siswa s JOIN kelas k ON s.id_kelas = k.id\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MySQL Join</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python MongoDB": {
      "py_mongo_getstarted": {
        "title": "MongoDB Get Started",
        "summary": "Menghubungkan Python ke database NoSQL MongoDB menggunakan driver resmi `pymongo`.",
        "content": "<p class=\"lead\">Menghubungkan Python ke database NoSQL MongoDB menggunakan driver resmi `pymongo`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Get Started:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Get Started",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('import pymongo\\nclient = pymongo.MongoClient(\"mongodb://localhost:27017/\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Get Started</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_create_db": {
        "title": "MongoDB Create DB",
        "summary": "Membuat basis data MongoDB baru secara otomatis saat dokumen pertama disimpan.",
        "content": "<p class=\"lead\">Membuat basis data MongoDB baru secara otomatis saat dokumen pertama disimpan.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Create DB:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Create DB",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('db = client[\"skillance_db\"]')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Create DB</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_create_coll": {
        "title": "MongoDB Collection",
        "summary": "Membuat koleksi dokumen (serupa tabel relasional) di dalam MongoDB.",
        "content": "<p class=\"lead\">Membuat koleksi dokumen (serupa tabel relasional) di dalam MongoDB.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Collection:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Collection",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi = db[\"pengguna\"]')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Collection</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_insert": {
        "title": "MongoDB Insert",
        "summary": "Menyisipkan dokumen JSON BSON ke koleksi dengan `insert_one()` atau `insert_many()`.",
        "content": "<p class=\"lead\">Menyisipkan dokumen JSON BSON ke koleksi dengan `insert_one()` atau `insert_many()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Insert:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Insert",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.insert_one({\"nama\": \"Faisal\", \"skor\": 95})')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Insert</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_find": {
        "title": "MongoDB Find",
        "summary": "Mengambil dokumen dari koleksi menggunakan `find_one()` atau `find()`.",
        "content": "<p class=\"lead\">Mengambil dokumen dari koleksi menggunakan `find_one()` atau `find()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Find:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Find",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('for doc in koleksi.find(): print(doc[\"nama\"])')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Find</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_query": {
        "title": "MongoDB Query",
        "summary": "Menyaring dokumen berbasis query filter JSON (seperti `{\"$gt\": 80}`).",
        "content": "<p class=\"lead\">Menyaring dokumen berbasis query filter JSON (seperti `{\"$gt\": 80}`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Query:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Query",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.find({\"skor\": {\"$gte\": 90}})')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Query</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_sort": {
        "title": "MongoDB Sort",
        "summary": "Mengurutkan dokumen hasil query secara menaik (1) atau menurun (-1).",
        "content": "<p class=\"lead\">Mengurutkan dokumen hasil query secara menaik (1) atau menurun (-1).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Sort:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Sort",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.find().sort(\"skor\", -1)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Sort</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_delete": {
        "title": "MongoDB Delete",
        "summary": "Menghapus dokumen dari koleksi dengan `delete_one()` atau `delete_many()`.",
        "content": "<p class=\"lead\">Menghapus dokumen dari koleksi dengan `delete_one()` atau `delete_many()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Delete:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Delete",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.delete_one({\"nama\": \"Faisal\"})')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Delete</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_drop_coll": {
        "title": "MongoDB Drop Collection",
        "summary": "Menghapus seluruh koleksi data dengan method `collection.drop()`.",
        "content": "<p class=\"lead\">Menghapus seluruh koleksi data dengan method `collection.drop()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Drop Collection:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Drop Collection",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.drop()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Drop Collection</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_update": {
        "title": "MongoDB Update",
        "summary": "Memperbarui isi bidang dokumen menggunakan operator `update_one()` dan `{\"$set\": ...}`.",
        "content": "<p class=\"lead\">Memperbarui isi bidang dokumen menggunakan operator `update_one()` dan `{\"$set\": ...}`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Update:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Update",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.update_one({\"nama\": \"Faisal\"}, {\"$set\": {\"skor\": 100}})')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Update</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_mongo_limit": {
        "title": "MongoDB Limit",
        "summary": "Membatasi jumlah dokumen yang dikembalikan dari database dengan method `limit()`.",
        "content": "<p class=\"lead\">Membatasi jumlah dokumen yang dikembalikan dari database dengan method `limit()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci MongoDB Limit:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: MongoDB Limit",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('koleksi.find().limit(3)')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>MongoDB Limit</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Cert": {
      "py_cert_exam": {
        "title": "Python Certificate",
        "summary": "Program evaluasi dan sertifikasi keahlian pemrograman Python resmi Skillance Academy Indonesia.",
        "content": "<p class=\"lead\">Program evaluasi dan sertifikasi keahlian pemrograman Python resmi Skillance Academy Indonesia.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Certificate:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Certificate",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('🎓 Evaluasi Sertifikasi Kompetensi Python Skillance Academy')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Certificate</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Reference": {
      "py_ref_overview": {
        "title": "Python Overview",
        "summary": "Kamus referensi cepat sintaks, kata kunci, dan method bawaan Python.",
        "content": "<p class=\"lead\">Kamus referensi cepat sintaks, kata kunci, dan method bawaan Python.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Overview:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Overview",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Referensi Lengkap Bahasa Pemrograman Python 3.12')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Overview</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_functions": {
        "title": "Python Built-in Functions",
        "summary": "Daftar fungsi bawaan standar: `len()`, `print()`, `range()`, `type()`, `sum()`, `max()`, `min()`, `zip()`.",
        "content": "<p class=\"lead\">Daftar fungsi bawaan standar: `len()`, `print()`, `range()`, `type()`, `sum()`, `max()`, `min()`, `zip()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Built-in Functions:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Built-in Functions",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nangka = [5, 2, 9, 1]\nprint('Sum:', sum(angka), '| Max:', max(angka), '| Min:', min(angka))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Built-in Functions</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_string": {
        "title": "Python String Methods",
        "summary": "Method manipulasi teks: `upper()`, `lower()`, `strip()`, `replace()`, `split()`, `join()`, `find()`.",
        "content": "<p class=\"lead\">Method manipulasi teks: `upper()`, `lower()`, `strip()`, `replace()`, `split()`, `join()`, `find()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python String Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python String Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ns = '  skillance academy  '\nprint(s.strip().title())",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python String Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_list": {
        "title": "Python List Methods",
        "summary": "Method daftar array: `append()`, `extend()`, `insert()`, `remove()`, `pop()`, `reverse()`, `count()`.",
        "content": "<p class=\"lead\">Method daftar array: `append()`, `extend()`, `insert()`, `remove()`, `pop()`, `reverse()`, `count()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python List Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python List Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nlst = [1, 2, 3]\nlst.extend([4, 5])\nprint('Panjang:', len(lst), '| List:', lst)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python List Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_dict": {
        "title": "Python Dictionary Methods",
        "summary": "Method kamus pasangan nilai: `keys()`, `values()`, `items()`, `get()`, `update()`, `pop()`.",
        "content": "<p class=\"lead\">Method kamus pasangan nilai: `keys()`, `values()`, `items()`, `get()`, `update()`, `pop()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Dictionary Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Dictionary Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nd = {'a': 1, 'b': 2}\nprint('Kunci:', list(d.keys()), '| Nilai:', list(d.values()))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Dictionary Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_tuple": {
        "title": "Python Tuple Methods",
        "summary": "Method bawaan tuple: `count()` untuk menghitung frekuensi dan `index()` untuk mencari posisi.",
        "content": "<p class=\"lead\">Method bawaan tuple: `count()` untuk menghitung frekuensi dan `index()` untuk mencari posisi.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Tuple Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Tuple Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ntup = (10, 20, 10, 30)\nprint('Jumlah Angka 10:', tup.count(10))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Tuple Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_set": {
        "title": "Python Set Methods",
        "summary": "Operasi himpunan matematika: `union()`, `intersection()`, `difference()`, `add()`, `discard()`.",
        "content": "<p class=\"lead\">Operasi himpunan matematika: `union()`, `intersection()`, `difference()`, `add()`, `discard()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Set Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Set Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\na = {1, 2, 3}; b = {3, 4, 5}\nprint('Irisan (Intersection):', a & b)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Set Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_file": {
        "title": "Python File Methods",
        "summary": "Kamus method objek berkas: `read()`, `write()`, `seek()`, `tell()`, `flush()`, `close()`.",
        "content": "<p class=\"lead\">Kamus method objek berkas: `read()`, `write()`, `seek()`, `tell()`, `flush()`, `close()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python File Methods:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python File Methods",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# File Object Methods: read(), write(), seek(0), close()')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python File Methods</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_keywords": {
        "title": "Python Keywords",
        "summary": "Daftar kata kunci khusus yang dilindungi: `def`, `class`, `import`, `return`, `yield`, `lambda`, `pass`.",
        "content": "<p class=\"lead\">Daftar kata kunci khusus yang dilindungi: `def`, `class`, `import`, `return`, `yield`, `lambda`, `pass`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Keywords:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Keywords",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport keyword\nprint('Total Kata Kunci Python:', len(keyword.kwlist))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Keywords</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_exceptions": {
        "title": "Python Exceptions",
        "summary": "Hierarki error bawaan: `ValueError`, `TypeError`, `KeyError`, `IndexError`, `FileNotFoundError`.",
        "content": "<p class=\"lead\">Hierarki error bawaan: `ValueError`, `TypeError`, `KeyError`, `IndexError`, `FileNotFoundError`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Exceptions:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Exceptions",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Hierarki Error Standar Python')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Exceptions</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ref_glossary": {
        "title": "Python Glossary",
        "summary": "Glosarium istilah pemrograman Python: Duck Typing, GIL, Generator, List Comprehension, Decorator.",
        "content": "<p class=\"lead\">Glosarium istilah pemrograman Python: Duck Typing, GIL, Generator, List Comprehension, Decorator.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Glossary:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Glossary",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Glosarium Resmi Bahasa Pemrograman Python')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Glossary</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Module Reference": {
      "py_modref_builtin": {
        "title": "Built-in Modules",
        "summary": "Katalog modul pustaka standar bawaan Python: `os`, `sys`, `time`, `json`, `math`, `random`.",
        "content": "<p class=\"lead\">Katalog modul pustaka standar bawaan Python: `os`, `sys`, `time`, `json`, `math`, `random`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Built-in Modules:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Built-in Modules",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport os, sys\nprint('OS Name:', os.name, '| Platform:', sys.platform)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Built-in Modules</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modref_random": {
        "title": "Random Module",
        "summary": "Menghasilkan bilangan acak dan mengacak data: `randint()`, `choice()`, `shuffle()`, `sample()`.",
        "content": "<p class=\"lead\">Menghasilkan bilangan acak dan mengacak data: `randint()`, `choice()`, `shuffle()`, `sample()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Random Module:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Random Module",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport random\npilihan = ['Merah', 'Kuning', 'Hijau']\nprint('Pilihan Acak:', random.choice(pilihan))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Random Module</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modref_requests": {
        "title": "Requests Module",
        "summary": "Pustaka HTTP populer untuk memanggil REST API server: `requests.get()`, `requests.post()`.",
        "content": "<p class=\"lead\">Pustaka HTTP populer untuk memanggil REST API server: `requests.get()`, `requests.post()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Requests Module:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Requests Module",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('# Pustaka Requests HTTP API:\\n# response = requests.get(\"https://api.skillance.cloud\")')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Requests Module</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modref_statistics": {
        "title": "Statistics Module",
        "summary": "Fungsi statistika matematika: `mean()`, `median()`, `mode()`, `stdev()`, `variance()`.",
        "content": "<p class=\"lead\">Fungsi statistika matematika: `mean()`, `median()`, `mode()`, `stdev()`, `variance()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Statistics Module:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Statistics Module",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport statistics\nprint('Median Data:', statistics.median([10, 20, 30, 40]))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Statistics Module</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modref_math": {
        "title": "Math Module",
        "summary": "Fungsi matematika presisi tinggi: trigonometri, konstanta pi dan euler, logaritma.",
        "content": "<p class=\"lead\">Fungsi matematika presisi tinggi: trigonometri, konstanta pi dan euler, logaritma.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Math Module:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Math Module",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport math\nprint('Cos(0):', math.cos(0), '| Euler e:', round(math.e, 4))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Math Module</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_modref_cmath": {
        "title": "cMath Module",
        "summary": "Operasi matematika untuk perhitungan bilangan kompleks (bilangan imajiner).",
        "content": "<p class=\"lead\">Operasi matematika untuk perhitungan bilangan kompleks (bilangan imajiner).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci cMath Module:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: cMath Module",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nimport cmath\nprint('Akar Kompleks -1:', cmath.sqrt(-1))",
        "explanation": "<p>Uji skrip Python untuk topik <strong>cMath Module</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python How To": {
      "py_howto_remove_duplicates": {
        "title": "Remove List Duplicates",
        "summary": "Trik efisien menghapus elemen duplikat pada list menggunakan fungsi `set()` atau `dict.fromkeys()`.",
        "content": "<p class=\"lead\">Trik efisien menghapus elemen duplikat pada list menggunakan fungsi `set()` atau `dict.fromkeys()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Remove List Duplicates:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Remove List Duplicates",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\ndata = [1, 2, 2, 3, 4, 4, 5]\nunike = list(dict.fromkeys(data))\nprint('Data Tanpa Duplikat:', unike)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Remove List Duplicates</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_howto_reverse_string": {
        "title": "Reverse a String",
        "summary": "Membalik urutan karakter dalam string dengan trik slicing `[::-1]` atau fungsi `reversed()`.",
        "content": "<p class=\"lead\">Membalik urutan karakter dalam string dengan trik slicing `[::-1]` atau fungsi `reversed()`.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Reverse a String:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Reverse a String",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nkata = 'SKILLANCE'\nprint('Dibalik:', kata[::-1])",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Reverse a String</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_howto_add_numbers": {
        "title": "Add Two Numbers",
        "summary": "Menjumlahkan dua angka masukan dengan penanganan casting tipe data yang tepat.",
        "content": "<p class=\"lead\">Menjumlahkan dua angka masukan dengan penanganan casting tipe data yang tepat.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Add Two Numbers:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Add Two Numbers",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nangka1 = 15.5\nangka2 = 24.5\nprint('Hasil Penjumlahan:', angka1 + angka2)",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Add Two Numbers</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    },
    "Python Examples": {
      "py_ex_examples": {
        "title": "Python Examples",
        "summary": "Koleksi puluhan studi kasus koding Python interaktif siap pakai untuk latihan mandiri.",
        "content": "<p class=\"lead\">Koleksi puluhan studi kasus koding Python interaktif siap pakai untuk latihan mandiri.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Examples:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Examples",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Showcase Koleksi Studi Kasus Python Skillance')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Examples</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_compiler": {
        "title": "Python Compiler",
        "summary": "Code Lab interaktif untuk mengeksekusi skrip Python langsung di browser.",
        "content": "<p class=\"lead\">Code Lab interaktif untuk mengeksekusi skrip Python langsung di browser.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Compiler:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Compiler",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Skillance Online Python Lab Aktif')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Compiler</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_exercises": {
        "title": "Python Exercises",
        "summary": "Latihan terpandu mengisi baris kode yang hilang pada operasi logika Python.",
        "content": "<p class=\"lead\">Latihan terpandu mengisi baris kode yang hilang pada operasi logika Python.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Exercises:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Exercises",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Latihan Mandiri Menyelesaikan Tantangan Algoritma')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Exercises</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_quiz": {
        "title": "Python Quiz",
        "summary": "Kuis interaktif pilihan ganda untuk menguji ketangkasan pemahaman konsep Python.",
        "content": "<p class=\"lead\">Kuis interaktif pilihan ganda untuk menguji ketangkasan pemahaman konsep Python.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Quiz:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Quiz",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Kuis Cepat Pemahaman Sintaks & Logika')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Quiz</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_challenges": {
        "title": "Python Challenges",
        "summary": "Tantangan soal pemecahan masalah algoritma (problem solving) tingkat menengah.",
        "content": "<p class=\"lead\">Tantangan soal pemecahan masalah algoritma (problem solving) tingkat menengah.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Challenges:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Challenges",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Tantangan Koding 10 Menit Selesai')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Challenges</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_practice": {
        "title": "Python Practice Problems",
        "summary": "Kumpulan soal latihan studi kasus nyata per bab materi.",
        "content": "<p class=\"lead\">Kumpulan soal latihan studi kasus nyata per bab materi.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Practice Problems:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Practice Problems",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Latihan Praktik Berbasis Proyek Industri')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Practice Problems</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_server": {
        "title": "Python Server",
        "summary": "Membuat server HTTP lokal sederhana dalam 1 baris perintah terminal (`python -m http.server 8000`).",
        "content": "<p class=\"lead\">Membuat server HTTP lokal sederhana dalam 1 baris perintah terminal (`python -m http.server 8000`).</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Server:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Server",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('$ python -m http.server 8000\\nServing HTTP on 0.0.0.0 port 8000')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Server</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_syllabus": {
        "title": "Python Syllabus",
        "summary": "Peta silabus lengkap pembelajaran Python dari dasar pemula hingga Machine Learning & Web.",
        "content": "<p class=\"lead\">Peta silabus lengkap pembelajaran Python dari dasar pemula hingga Machine Learning & Web.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Syllabus:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Syllabus",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Silabus 14 Modul Utama Python Skillance Academy')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Syllabus</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_study_plan": {
        "title": "Python Study Plan",
        "summary": "Rencana belajar intensif terstruktur 30 hari menguasai Python dan Data Science.",
        "content": "<p class=\"lead\">Rencana belajar intensif terstruktur 30 hari menguasai Python dan Data Science.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Study Plan:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Study Plan",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Target Belajar 30 Hari: Fondasi, OOP, Database, AI')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Study Plan</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_interview": {
        "title": "Python Interview Q&A",
        "summary": "Panduan tanya-jawab teknis wawancara kerja programmer Python di perusahaan teknologi.",
        "content": "<p class=\"lead\">Panduan tanya-jawab teknis wawancara kerja programmer Python di perusahaan teknologi.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Interview Q&A:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Interview Q&A",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Kumpulan 50 Soal Wawancara Teknis Python')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Interview Q&A</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      },
      "py_ex_training": {
        "title": "Python Training",
        "summary": "Program bimbingan intensif bootcamp koding Python Skillance Academy Indonesia.",
        "content": "<p class=\"lead\">Program bimbingan intensif bootcamp koding Python Skillance Academy Indonesia.</p>\n<div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n    <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-python text-primary me-2\"></i>Konsep Kunci Python Training:</h6>\n    <p class=\"small mb-0\" style=\"line-height: 1.8;\">\n        Pelajari sintaks di bawah, pahami alur eksekusi logika interpreter Python, dan uji secara langsung di Code Lab Skillance Academy.\n    </p>\n</div>",
        "example_title": "Contoh Kode Python: Python Training",
        "example_code": "# Skrip Python - Skillance Academy Indonesia\nprint('Bootcamp Intensif Siap Kerja Skillance Academy')",
        "explanation": "<p>Uji skrip Python untuk topik <strong>Python Training</strong> di atas dan amati hasil eksekusi terminalnya secara instan.</p>"
      }
    }
  }
}
JSON_DATA, true);

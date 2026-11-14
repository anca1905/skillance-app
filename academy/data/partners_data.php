<?php
/**
 * Master Data & Provider for Skillance Academy Campus & Organization Partnerships (Multi-Tenant Cohort)
 */

if (!function_exists('getPartnersList')) {
    function getPartnersList() {
        return [
            'msc-usn' => [
                'id' => 1,
                'slug' => 'msc-usn',
                'code' => 'MSC-USN-2026',
                'name' => 'Kemitraan Strategis UKM MSC x Fakultas Teknologi Informasi USN Kolaka',
                'short_name' => 'FTI USN Kolaka x UKM MSC',
                'institution' => 'Universitas Sembilanbelas November Kolaka',
                'faculty' => 'Fakultas Teknologi Informasi',
                'organization' => 'UKM Multimedia Study Club (MSC USN)',
                'pks_number' => '014/PKS-SKL/FTI-USN/XI/2026',
                'pks_date' => '2026-11-16',
                'valid_until' => '2027-11-16',
                'access_pin' => 'MSC2026',
                'contact_person' => 'Ketua Umum UKM MSC & Wadek Kemahasiswaan FTI',
                'logo_faculty' => '../assets/img/logo-usn.png',
                'logo_industry' => '../assets/img/logo_skillance_official.png',
                'logo_org' => '../assets/img/logo-msc.svg',
                'stamp_industry' => '../assets/img/stempel_skillance_navy.png',
                'signature_industry' => '../assets/img/ttd-muh-arsyad-ramsi.png',
                'signers' => [
                    'industry' => [
                        'name' => 'Muh. Arsyad Ramsi',
                        'title' => 'Direktur Utama',
                        'company' => 'PT Skillance Digital Indonesia',
                        'id_number' => 'NIB. 100000011940526'
                    ],
                    'org' => [
                        'name' => 'Muh. Fadel Al-Farizi',
                        'title' => 'Ketua Umum',
                        'company' => 'UKM Multimedia Study Club (MSC)',
                        'id_number' => 'NIM. 22024014018'
                    ],
                    'faculty' => [
                        'name' => 'Dr. Ir. Suharman, S.T., M.Kom.',
                        'title' => 'Wakil Dekan Bidang Kemahasiswaan & Kerjasama',
                        'company' => 'Fakultas Teknologi Informasi USN Kolaka',
                        'id_number' => 'NIP. 19830712 201012 1 003'
                    ]
                ],
                'exclusive_tracks' => [
                    'msc-web-arch' => [
                        'track_id' => 'msc-web-arch',
                        'title' => 'Fullstack Web Architecture & RESTful API Masterclass',
                        'category' => 'Web Engineering & Backend Systems',
                        'total_jp' => 32,
                        'level' => 'Tingkat Menengah - Mahir (Standar SKPI Kemendikbud)',
                        'description' => 'Program pelatihan intensif arsitektur web modern, standardisasi keamanan aplikasi (OWASP Top 10), perancangan RESTful API performa tinggi, dan integrasi Single Page Application (SPA).',
                        'modules' => [
                            ['title' => 'Modul 1: Semantic Architecture & Advanced Responsive Layout', 'jp' => 6, 'competency' => 'HTML5 Living Standard, CSS Grid/Flexbox, Core Web Vitals Optimization'],
                            ['title' => 'Modul 2: JavaScript ES6+ Reactive Logic & Asynchronous DOM', 'jp' => 6, 'competency' => 'Promises, Async/Await, Modular JS, Fetch API & Token Handling'],
                            ['title' => 'Modul 3: RESTful API Engineering with PHP & Optimized MySQL', 'jp' => 10, 'competency' => 'Relational DB Normalization, Indexing, MVC Pattern, Prepared Statements'],
                            ['title' => 'Modul 4: Application Security, Session Auth & CSRF/XSS Mitigation', 'jp' => 6, 'competency' => 'Password Hashing, Security Headers, JWT Auth, Input Sanitization'],
                            ['title' => 'Modul 5: Capstone Project & Standar Evaluasi Kompetensi', 'jp' => 4, 'competency' => 'Fullstack Delivery, Code Review, Comprehensive Exit Examination']
                        ]
                    ],
                    'msc-flutter-mobile' => [
                        'track_id' => 'msc-flutter-mobile',
                        'title' => 'Mobile Apps Engineering with Flutter & Dart',
                        'category' => 'Cross-Platform Mobile Development',
                        'total_jp' => 32,
                        'level' => 'Tingkat Menengah (Standar Industri Mobile)',
                        'description' => 'Pengembangan aplikasi mobile native lintas platform (Android/iOS) menggunakan bahasa Dart, manajemen state reaktif, konsumsi API eksternal, dan arsitektur antarmuka modern.',
                        'modules' => [
                            ['title' => 'Modul 1: Dart 3 OOP, Null Safety & Functional Programming', 'jp' => 6, 'competency' => 'Strict Typing, OOP Inheritance, Collections & Generics'],
                            ['title' => 'Modul 2: Flutter Widget Tree & Responsive Layout Architecture', 'jp' => 8, 'competency' => 'Stateless vs Stateful, Custom Painters, Material 3 Design'],
                            ['title' => 'Modul 3: State Management & Local Storage Persistence', 'jp' => 8, 'competency' => 'Provider/Riverpod Pattern, Shared Preferences, Secure Storage'],
                            ['title' => 'Modul 4: RESTful API HTTP Consumption & JSON Serialization', 'jp' => 6, 'competency' => 'Dio/HTTP Client, Error Handling, Pagination & Caching'],
                            ['title' => 'Modul 5: Project Showcase & Ujian Sertifikasi Mobile', 'jp' => 4, 'competency' => 'APK/AAB Building, Performance Profiling, Final Assessment']
                        ]
                    ],
                    'msc-uiux-product' => [
                        'track_id' => 'msc-uiux-product',
                        'title' => 'UI/UX & Digital Product Interface Design',
                        'category' => 'Product Design & Design Systems',
                        'total_jp' => 24,
                        'level' => 'Tingkat Dasar - Menengah',
                        'description' => 'Metodologi perancangan produk digital berbasis riset pengguna, pembuatan wireframe, Design System berskala industri pada Figma, serta usability testing interaktif.',
                        'modules' => [
                            ['title' => 'Modul 1: Design Thinking & Empathy User Journey Mapping', 'jp' => 4, 'competency' => 'User Personas, Problem Framing, Heuristic Evaluation'],
                            ['title' => 'Modul 2: Wireframing, Information Architecture & Microcopy', 'jp' => 6, 'competency' => 'Low-Fidelity Prototyping, Content Hierarchy, User Flows'],
                            ['title' => 'Modul 3: Industry Design System & Component Tokens in Figma', 'jp' => 8, 'competency' => 'Auto-layout 5.0, Variants, Interactive Components, Tokenization'],
                            ['title' => 'Modul 4: High-Fidelity Prototyping & Usability Testing Lab', 'jp' => 6, 'competency' => 'Interactive Micro-interactions, Usability Scoring, Portfolio Handover']
                        ]
                    ]
                ]
            ],
            'template-univ' => [
                'id' => 2,
                'slug' => 'template-univ',
                'code' => 'CAMPUS-DEMO-2026',
                'name' => 'Contoh Portal Kemitraan Kampus Baru (Multi-Tenant)',
                'short_name' => 'Fakultas Mitra x Skillance',
                'institution' => 'Universitas / Institut Mitra Indonesia',
                'faculty' => 'Fakultas Ilmu Komputer & Sains',
                'organization' => 'Himpunan Mahasiswa Informatika',
                'pks_number' => '020/PKS-SKL/UNIV-DEMO/XI/2026',
                'pks_date' => '2026-11-20',
                'valid_until' => '2027-11-20',
                'access_pin' => 'DEMO2026',
                'contact_person' => 'Biro Kemahasiswaan Kampus',
                'logo_faculty' => '../assets/img/logo-smpn.png',
                'logo_industry' => '../assets/img/logo_skillance_official.png',
                'logo_org' => '../assets/img/logo_skillance_icon_square.png',
                'stamp_industry' => '../assets/img/stempel_skillance_navy.png',
                'signature_industry' => '../assets/img/ttd-muh-arsyad-ramsi.png',
                'signers' => [
                    'industry' => [
                        'name' => 'Muh. Arsyad Ramsi',
                        'title' => 'Direktur Utama',
                        'company' => 'PT Skillance Digital Indonesia',
                        'id_number' => 'NIB. 100000011940526'
                    ],
                    'org' => [
                        'name' => 'Ketua Himpunan Mahasiswa',
                        'title' => 'Ketua Umum Ormawa',
                        'company' => 'Himpunan Mahasiswa Mitra',
                        'id_number' => 'NIM. 22000001'
                    ],
                    'faculty' => [
                        'name' => 'Dekan / Wakil Dekan Kemahasiswaan',
                        'title' => 'Wakil Dekan Bidang Kemahasiswaan',
                        'company' => 'Fakultas Ilmu Komputer',
                        'id_number' => 'NIP. 19800101 200501 1 001'
                    ]
                ],
                'exclusive_tracks' => [
                    'msc-web-arch' => [
                        'track_id' => 'msc-web-arch',
                        'title' => 'Fullstack Web Architecture & RESTful API Masterclass',
                        'category' => 'Web Engineering',
                        'total_jp' => 32,
                        'level' => 'Tingkat Menengah',
                        'description' => 'Silabus eksklusif disesuaikan dengan kurikulum kampus.',
                        'modules' => []
                    ]
                ]
            ]
        ];
    }
}

if (!function_exists('getPartnerBySlug')) {
    function getPartnerBySlug($slug = 'msc-usn') {
        $list = getPartnersList();
        return $list[$slug] ?? $list['msc-usn'];
    }
}

if (!function_exists('getPartnerCohortStudents')) {
    function getPartnerCohortStudents($slug = 'msc-usn') {
        // Data Mahasiswa Cohort Kerjasama Resmi
        $cohortStudents = [
            [
                'nim' => '22024014001',
                'name' => 'Muhammad Rian Pratama',
                'study_program' => 'S1 Sistem Informasi',
                'track_id' => 'msc-web-arch',
                'track_title' => 'Fullstack Web Architecture & RESTful API',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 95,
                'grade' => 'A (Dengan Pujian)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-001',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 96
            ],
            [
                'nim' => '22024014004',
                'name' => 'Dewi Sartika Putri',
                'study_program' => 'S1 Teknik Informatika',
                'track_id' => 'msc-web-arch',
                'track_title' => 'Fullstack Web Architecture & RESTful API',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 92,
                'grade' => 'A (Sangat Memuaskan)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-002',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 100
            ],
            [
                'nim' => '22024014012',
                'name' => 'Ahmad Faisal Pratama',
                'study_program' => 'S1 Sistem Informasi',
                'track_id' => 'msc-flutter-mobile',
                'track_title' => 'Mobile Apps Engineering with Flutter & Dart',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 89,
                'grade' => 'A- (Sangat Memuaskan)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-003',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 92
            ],
            [
                'nim' => '22024014015',
                'name' => 'Siti Nurhaliza Rahayu',
                'study_program' => 'S1 Teknik Informatika',
                'track_id' => 'msc-uiux-product',
                'track_title' => 'UI/UX & Digital Product Interface Design',
                'total_jp' => 24,
                'progress' => 100,
                'exam_score' => 94,
                'grade' => 'A (Dengan Pujian)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-004',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 96
            ],
            [
                'nim' => '22024014022',
                'name' => 'Rizky Ramadhan Saputra',
                'study_program' => 'S1 Teknik Informatika',
                'track_id' => 'msc-web-arch',
                'track_title' => 'Fullstack Web Architecture & RESTful API',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 88,
                'grade' => 'A- (Sangat Memuaskan)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-005',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 88
            ],
            [
                'nim' => '22024014029',
                'name' => 'Nurul Fadilah Mansyur',
                'study_program' => 'S1 Sistem Informasi',
                'track_id' => 'msc-uiux-product',
                'track_title' => 'UI/UX & Digital Product Interface Design',
                'total_jp' => 24,
                'progress' => 85,
                'exam_score' => 0,
                'grade' => 'Evaluasi Berjalan',
                'status' => 'PROSES_BELAJAR',
                'cert_no' => null,
                'issue_date' => null,
                'attendance_pct' => 90
            ],
            [
                'nim' => '22024014033',
                'name' => 'Ilham Wahyudi',
                'study_program' => 'S1 Teknik Informatika',
                'track_id' => 'msc-flutter-mobile',
                'track_title' => 'Mobile Apps Engineering with Flutter & Dart',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 91,
                'grade' => 'A (Sangat Memuaskan)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-006',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 94
            ],
            [
                'nim' => '22024014041',
                'name' => 'Anisa Tri Wahyuni',
                'study_program' => 'S1 Sistem Informasi',
                'track_id' => 'msc-web-arch',
                'track_title' => 'Fullstack Web Architecture & RESTful API',
                'total_jp' => 32,
                'progress' => 70,
                'exam_score' => 0,
                'grade' => 'Evaluasi Berjalan',
                'status' => 'PROSES_BELAJAR',
                'cert_no' => null,
                'issue_date' => null,
                'attendance_pct' => 82
            ],
            [
                'nim' => '22024014048',
                'name' => 'Dimas Arya Pangestu',
                'study_program' => 'S1 Teknik Informatika',
                'track_id' => 'msc-web-arch',
                'track_title' => 'Fullstack Web Architecture & RESTful API',
                'total_jp' => 32,
                'progress' => 100,
                'exam_score' => 86,
                'grade' => 'B+ (Memuaskan)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-007',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 88
            ],
            [
                'nim' => '22024014055',
                'name' => 'Tiara Anggraini',
                'study_program' => 'S1 Sistem Informasi',
                'track_id' => 'msc-uiux-product',
                'track_title' => 'UI/UX & Digital Product Interface Design',
                'total_jp' => 24,
                'progress' => 100,
                'exam_score' => 96,
                'grade' => 'A (Dengan Pujian)',
                'status' => 'LULUS',
                'cert_no' => 'SKL-MSC-2026-008',
                'issue_date' => '2026-11-16',
                'attendance_pct' => 100
            ]
        ];

        return $cohortStudents;
    }
}

if (!function_exists('getPartnerStudentByCert')) {
    function getPartnerStudentByCert($certNo) {
        $students = getPartnerCohortStudents('msc-usn');
        foreach ($students as $s) {
            if (!empty($s['cert_no']) && strtoupper($s['cert_no']) === strtoupper(trim($certNo))) {
                return $s;
            }
        }
        return null;
    }
}

if (!function_exists('getPartnerMetrics')) {
    function getPartnerMetrics($slug = 'msc-usn') {
        $students = getPartnerCohortStudents($slug);
        $total = count($students);
        $passed = 0;
        $inProgress = 0;
        $totalScore = 0;
        $scoredCount = 0;
        $totalProgress = 0;

        foreach ($students as $s) {
            $totalProgress += $s['progress'];
            if ($s['status'] === 'LULUS') {
                $passed++;
                $totalScore += $s['exam_score'];
                $scoredCount++;
            } else {
                $inProgress++;
            }
        }

        $avgScore = $scoredCount > 0 ? round($totalScore / $scoredCount, 1) : 0;
        $avgProgress = $total > 0 ? round($totalProgress / $total, 1) : 0;
        $passRate = $total > 0 ? round(($passed / $total) * 100, 1) : 0;

        return [
            'total_students' => $total,
            'passed_count' => $passed,
            'in_progress_count' => $inProgress,
            'avg_score' => $avgScore,
            'avg_progress' => $avgProgress,
            'pass_rate' => $passRate
        ];
    }
}

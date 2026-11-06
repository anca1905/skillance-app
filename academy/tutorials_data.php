<?php

// Skillance Academy - Data Materi Tutorial Skillance Academy Indonesia

$htmlData = require __DIR__ . '/data/html_tutorial.php';

$htmlCategories = $htmlData['categories'] ?? [];

$htmlFlattenedTopics = [];

foreach ($htmlCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $htmlFlattenedTopics[$tKey] = $tData;

    }

}

$cssData = require __DIR__ . '/data/css_tutorial.php';

$cssCategories = $cssData['categories'] ?? [];

$cssFlattenedTopics = [];

foreach ($cssCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $cssFlattenedTopics[$tKey] = $tData;

    }

}

$jsData = require __DIR__ . '/data/js_tutorial.php';

$jsCategories = $jsData['categories'] ?? [];

$jsFlattenedTopics = [];

foreach ($jsCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $jsFlattenedTopics[$tKey] = $tData;

    }

}

$phpData = require __DIR__ . '/data/php_tutorial.php';

$phpCategories = $phpData['categories'] ?? [];

$phpFlattenedTopics = [];

foreach ($phpCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $phpFlattenedTopics[$tKey] = $tData;

    }

}

$sqlData = require __DIR__ . '/data/sql_tutorial.php';

$sqlCategories = $sqlData['categories'] ?? [];

$sqlFlattenedTopics = [];

foreach ($sqlCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $sqlFlattenedTopics[$tKey] = $tData;

    }

}

$jqueryData = require __DIR__ . '/data/jquery_tutorial.php';

$jqueryCategories = $jqueryData['categories'] ?? [];

$jqueryFlattenedTopics = [];

foreach ($jqueryCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $jqueryFlattenedTopics[$tKey] = $tData;

    }

}

$pythonData = require __DIR__ . '/data/python_tutorial.php';

$pythonCategories = $pythonData['categories'] ?? [];

$pythonFlattenedTopics = [];

foreach ($pythonCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $pythonFlattenedTopics[$tKey] = $tData;

    }

}

$javaData = require __DIR__ . '/data/java_tutorial.php';

$javaCategories = $javaData['categories'] ?? [];

$javaFlattenedTopics = [];

foreach ($javaCategories as $catName => $catTopics) {

    foreach ($catTopics as $tKey => $tData) {

        $javaFlattenedTopics[$tKey] = $tData;

    }

}

$cppData = require __DIR__ . '/data/cpp_tutorial.php';
$cppCategories = $cppData['categories'] ?? [];
$cppFlattenedTopics = [];
foreach ($cppCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $cppFlattenedTopics[$tKey] = $tData;
    }
}

$vueData = require __DIR__ . '/data/vue_tutorial.php';
$vueCategories = $vueData['categories'] ?? [];
$vueFlattenedTopics = [];
foreach ($vueCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $vueFlattenedTopics[$tKey] = $tData;
    }
}

$flutterData = require __DIR__ . '/data/flutter_tutorial.php';
$flutterCategories = $flutterData['categories'] ?? [];
$flutterFlattenedTopics = [];
foreach ($flutterCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $flutterFlattenedTopics[$tKey] = $tData;
    }
}

$uiuxData = require __DIR__ . '/data/uiux_tutorial.php';
$uiuxCategories = $uiuxData['categories'] ?? [];
$uiuxFlattenedTopics = [];
foreach ($uiuxCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $uiuxFlattenedTopics[$tKey] = $tData;
    }
}

$tutorials = [

    'html' => [

        'name' => 'HTML Tutorial',

        'short_name' => 'HTML',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-brands fa-html5',

        'color' => '#e34f26',

        'desc' => 'HTML adalah bahasa standar untuk membuat dan menstrukturkan halaman web.',

        'categories' => $htmlCategories,

        'topics' => $htmlFlattenedTopics

    ],

    'css' => [

        'name' => 'CSS Tutorial',

        'short_name' => 'CSS',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-brands fa-css3-alt',

        'color' => '#264de4',

        'desc' => 'CSS adalah bahasa yang digunakan untuk menata tampilan, warna, tipografi, dan tata letak halaman web.',

        'categories' => $cssCategories,

        'topics' => $cssFlattenedTopics

    ],

    'javascript' => [

        'name' => 'JavaScript Tutorial',

        'short_name' => 'JavaScript',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-brands fa-js',

        'color' => '#ca8a04',

        'desc' => 'JavaScript adalah bahasa pemrograman resmi web yang membuat halaman interaktif, dinamis, dan hidup.',

        'categories' => $jsCategories,

        'topics' => $jsFlattenedTopics

    ],

    'php' => [

        'name' => 'PHP & MySQL Tutorial',

        'short_name' => 'PHP & MySQL',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-brands fa-php',

        'color' => '#777bb4',

        'desc' => 'PHP adalah bahasa pemrograman server-side dan database MySQL yang menjadi fondasi 75%+ website di internet.',

        'categories' => $phpCategories,

        'topics' => $phpFlattenedTopics

    ],

    'sql' => [

        'name' => 'SQL Database Tutorial',

        'short_name' => 'SQL',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-solid fa-database',

        'color' => '#00758f',

        'desc' => 'SQL adalah bahasa standar internasional untuk mengakses, merancang, dan mengelola database relasional.',

        'categories' => $sqlCategories,

        'topics' => $sqlFlattenedTopics

    ],

    'jquery' => [

        'name' => 'jQuery Tutorial',

        'short_name' => 'jQuery',

        'badge' => 'Pemula ke Mahir',

        'icon' => 'fa-solid fa-bolt',

        'color' => '#0769ad',

        'desc' => 'jQuery adalah pustaka JavaScript ringkas yang menyederhanakan manipulasi HTML, event, animasi, dan penanganan AJAX.',

        'categories' => $jqueryCategories,

        'topics' => $jqueryFlattenedTopics

    ],

    'python' => [

        'name' => 'Python Tutorial',

        'short_name' => 'Python',

        'badge' => 'Pemula ke Mahir & AI',

        'icon' => 'fa-brands fa-python',

        'color' => '#3776ab',

        'desc' => 'Python adalah bahasa pemrograman serbaguna berorientasi objek yang populer untuk Web, AI, Data Science, dan Otomasi.',

        'categories' => $pythonCategories,

        'topics' => $pythonFlattenedTopics

    ],

    'java' => [

        'name' => 'Java Tutorial',

        'short_name' => 'Java',

        'badge' => 'Pemula ke Enterprise',

        'icon' => 'fa-brands fa-java',

        'color' => '#ea580c',

        'desc' => 'Java adalah bahasa pemrograman berorientasi objek tangguh yang digunakan oleh miliaran perangkat dan backend enterprise dunia.',

        'categories' => $javaCategories,

        'topics' => $javaFlattenedTopics

    ],

    'cpp' => [

        'name' => 'C++ Tutorial',

        'short_name' => 'C++',

        'badge' => 'High Performance & STL',

        'icon' => 'fa-solid fa-code',

        'color' => '#00599c',

        'desc' => 'C++ adalah bahasa pemrograman kompilasi berkinerja tinggi untuk Game Development, sistem operasi, dan algoritma tingkat lanjut.',

        'categories' => $cppCategories,

        'topics' => $cppFlattenedTopics

    ],
    'vue' => [
        'name' => 'Vue.js Tutorial',
        'short_name' => 'Vue',
        'badge' => 'Frontend Reaktif & SPA',
        'icon' => 'fa-brands fa-vuejs',
        'color' => '#42b883',
        'desc' => 'Vue.js adalah framework JavaScript progresif untuk membangun antarmuka web reaktif, komponen modular, dan Single Page Applications (SPA).',
        'categories' => $vueCategories,
        'topics' => $vueFlattenedTopics
    ],

    'flutter' => [
        'name' => 'Flutter & Dart Mobile Tutorial',
        'short_name' => 'Flutter',
        'badge' => 'Cross-Platform Mobile & AI',
        'icon' => 'fa-solid fa-mobile-screen-button',
        'color' => '#0284c7',
        'desc' => 'Flutter adalah toolkit UI multiplatform dari Google untuk membangun aplikasi native Android, iOS, Web & Desktop dari satu basis kode Dart.',
        'categories' => $flutterCategories,
        'topics' => $flutterFlattenedTopics
    ],

    'uiux' => [
        'name' => 'UI/UX Design & Figma Tutorial',
        'short_name' => 'UI/UX',
        'badge' => 'Desain Produk & Riset',
        'icon' => 'fa-solid fa-bezier-curve',
        'color' => '#d946ef',
        'desc' => 'Desain pengalaman pengguna (UX) dan antarmuka visual (UI) modern menggunakan prinsip Design Thinking, Auto-Layout Figma, dan Design System.',
        'categories' => $uiuxCategories,
        'topics' => $uiuxFlattenedTopics
    ]
];


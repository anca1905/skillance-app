<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../tutorials_data.php';

$query = trim($_GET['q'] ?? '');
$queryClean = preg_replace('/[^a-zA-Z0-9\s]/u', ' ', mb_strtolower($query));
$tokens = array_filter(explode(' ', $queryClean), function($w) {
    return mb_strlen($w) >= 2;
});

$results = [];
$limit = 15;

if (empty($query) || empty($tokens)) {
    // Return curated quick recommendations
    $featured = [
        ['c' => 'flutter', 'p' => 'flutter_install'],
        ['c' => 'flutter', 'p' => 'flutter_ai_apps'],
        ['c' => 'uiux', 'p' => 'uiux_auto_layout'],
        ['c' => 'vue', 'p' => 'vue_home'],
        ['c' => 'python', 'p' => 'py_intro'],
        ['c' => 'html', 'p' => 'html_intro'],
        ['c' => 'javascript', 'p' => 'js_intro'],
        ['c' => 'cpp', 'p' => 'cpp_home']
    ];

    foreach ($featured as $f) {
        $cKey = $f['c'];
        $pKey = $f['p'];
        if (isset($tutorials[$cKey]['topics'][$pKey])) {
            $t = $tutorials[$cKey]['topics'][$pKey];
            $results[] = [
                'course_key' => $cKey,
                'course_name' => $tutorials[$cKey]['short_name'] ?? strtoupper($cKey),
                'course_color' => $tutorials[$cKey]['color'] ?? '#0d2e5c',
                'topic_key' => $pKey,
                'title' => $t['title'],
                'category' => 'Rekomendasi Populer',
                'summary' => $t['summary'] ?? '',
                'url' => "learn.php?c=" . urlencode($cKey) . "&p=" . urlencode($pKey)
            ];
        }
    }

    echo json_encode(['status' => 'success', 'is_featured' => true, 'total' => count($results), 'results' => $results]);
    exit;
}

// Search across all tutorials with tokenized matching
foreach ($tutorials as $cKey => $course) {
    $courseName = $course['name'] ?? $cKey;
    $shortName = $course['short_name'] ?? strtoupper($cKey);
    $color = $course['color'] ?? '#0d2e5c';
    $topics = $course['topics'] ?? [];
    $categories = $course['categories'] ?? [];

    $topicCatMap = [];
    foreach ($categories as $catName => $catTopics) {
        foreach ($catTopics as $tKey => $tData) {
            $topicCatMap[$tKey] = $catName;
        }
    }

    foreach ($topics as $tKey => $topic) {
        $title = $topic['title'] ?? '';
        $summary = $topic['summary'] ?? '';
        $cat = $topicCatMap[$tKey] ?? 'Materi Belajar';

        $searchTarget = mb_strtolower("$title $summary $courseName $shortName $cat $tKey");
        // Also normalize hyphens to spaces
        $searchTargetNorm = str_replace(['-', '_', '/'], ' ', $searchTarget);

        $matchedTokens = 0;
        $score = 0;

        foreach ($tokens as $token) {
            if (mb_stripos($searchTarget, $token) !== false || mb_stripos($searchTargetNorm, $token) !== false) {
                $matchedTokens++;
                if (mb_stripos($title, $token) !== false) $score += 10;
                if (mb_stripos($shortName, $token) !== false || mb_stripos($courseName, $token) !== false) $score += 8;
                if (mb_stripos($summary, $token) !== false) $score += 3;
            }
        }

        // Must match all or at least half tokens
        if ($matchedTokens > 0 && ($matchedTokens === count($tokens) || count($tokens) > 2)) {
            $results[] = [
                'score' => $score,
                'course_key' => $cKey,
                'course_name' => $shortName,
                'course_color' => $color,
                'topic_key' => $tKey,
                'title' => $title,
                'category' => $cat,
                'summary' => mb_substr($summary, 0, 110) . (mb_strlen($summary) > 110 ? '...' : ''),
                'url' => "learn.php?c=" . urlencode($cKey) . "&p=" . urlencode($tKey)
            ];
        }
    }
}

// Sort by score descending
usort($results, function($a, $b) {
    return $b['score'] <=> $a['score'];
});

$slicedResults = array_slice($results, 0, $limit);

echo json_encode([
    'status' => 'success',
    'is_featured' => false,
    'query' => $query,
    'total' => count($slicedResults),
    'results' => $slicedResults
]);

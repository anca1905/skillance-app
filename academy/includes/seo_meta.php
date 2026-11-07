<?php
/**
 * Master Enterprise SEO & Social Share Preview Engine (Open Graph & Twitter Cards)
 * Skillance Academy Indonesia
 * 
 * Usage:
 *   $seoTitle = "Tutorial Flutter - Skillance Academy";
 *   $seoDesc = "Pelajari pembuatan aplikasi mobile...";
 *   $seoOgImage = "https://academy.skillance.cloud/assets/img/og-flutter.png";
 *   include __DIR__ . '/includes/seo_meta.php';
 */

$baseSiteUrl = 'https://academy.skillance.cloud';

// Fallback logic
$seoTitle = !empty($seoTitle) ? $seoTitle : 'Skillance Academy Indonesia - Platform Belajar Koding Praktis & Portofolio SKPI';
$seoDesc = !empty($seoDesc) ? $seoDesc : 'Portal belajar koding mandiri dan interaktif resmi dari Skillance Academy Indonesia. Kuasai HTML, CSS, JavaScript, PHP, MySQL, Flutter, dan UI/UX dengan sertifikasi kelulusan digital SKPI.';
$seoKeywords = !empty($seoKeywords) ? $seoKeywords : 'skillance academy, belajar koding indonesia, tutorial pemrograman, ujian koding online, sertifikat skpi, flutter indonesia, ui ux figma, belajar php mysql';
$seoType = !empty($seoType) ? $seoType : 'website';

// Handle canonical URL
if (empty($seoCanonical)) {
    $currentUri = $_SERVER['REQUEST_URI'] ?? '/';
    $seoCanonical = $baseSiteUrl . htmlspecialchars($currentUri);
}

// Handle OG Image URL (ensure absolute URL with HTTPS)
if (empty($seoOgImage)) {
    $seoOgImage = $baseSiteUrl . '/assets/img/og-academy.png';
} elseif (!preg_match('#^https?://#i', $seoOgImage)) {
    $seoOgImage = $baseSiteUrl . '/' . ltrim($seoOgImage, '/');
}

$faviconUrl = 'https://skillance.my.id/assets/img/favicon.png';
?>
<!-- PRIMARY SEARCH ENGINE METADATA -->
<title><?= htmlspecialchars($seoTitle) ?></title>
<meta name="title" content="<?= htmlspecialchars($seoTitle) ?>">
<meta name="description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta name="keywords" content="<?= htmlspecialchars($seoKeywords) ?>">
<meta name="author" content="Skillance Academy Indonesia">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<link rel="canonical" href="<?= htmlspecialchars($seoCanonical) ?>">

<!-- OPEN GRAPH METADATA (WhatsApp, Telegram, Facebook, LinkedIn) -->
<meta property="og:type" content="<?= htmlspecialchars($seoType) ?>">
<meta property="og:site_name" content="Skillance Academy Indonesia">
<meta property="og:url" content="<?= htmlspecialchars($seoCanonical) ?>">
<meta property="og:title" content="<?= htmlspecialchars($seoTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta property="og:image" content="<?= htmlspecialchars($seoOgImage) ?>">
<meta property="og:image:secure_url" content="<?= htmlspecialchars($seoOgImage) ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= htmlspecialchars($seoTitle) ?>">
<meta property="og:locale" content="id_ID">

<!-- TWITTER CARDS METADATA -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?= htmlspecialchars($seoCanonical) ?>">
<meta name="twitter:title" content="<?= htmlspecialchars($seoTitle) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seoDesc) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($seoOgImage) ?>">
<meta name="twitter:site" content="@skillance_id">
<meta name="twitter:creator" content="@skillance_id">

<!-- MOBILE APP & BRAND STYLING -->
<meta name="theme-color" content="#0d2e5c">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">

<!-- PWA MANIFEST & MOBILE ICONS -->
<link rel="manifest" href="/manifest.json">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Skillance">
<link rel="icon" type="image/png" href="<?= $faviconUrl ?>">
<link rel="shortcut icon" type="image/png" href="<?= $faviconUrl ?>">
<link rel="apple-touch-icon" href="/assets/img/pwa-icon-192.png">

<!-- STRUCTURED DATA: ORGANIZATION & WEBSITE (SCHEMA.ORG JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://academy.skillance.cloud/#organization",
      "name": "Skillance Academy Indonesia",
      "url": "https://academy.skillance.cloud",
      "logo": {
        "@type": "ImageObject",
        "@id": "https://academy.skillance.cloud/#logo",
        "url": "<?= $faviconUrl ?>",
        "caption": "Skillance Academy Logo"
      },
      "sameAs": [
        "https://skillance.my.id",
        "https://instagram.com/skillance.id",
        "https://github.com/anca1905/skillance-app"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+62-822-9170-0778",
        "contactType": "Customer Support",
        "areaServed": "ID",
        "availableLanguage": ["Indonesian"]
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://academy.skillance.cloud/#website",
      "url": "https://academy.skillance.cloud",
      "name": "Skillance Academy Indonesia",
      "description": "Portal Belajar Pemrograman & Sertifikasi SKPI",
      "publisher": {
        "@id": "https://academy.skillance.cloud/#organization"
      },
      "inLanguage": "id-ID",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://academy.skillance.cloud/learn.php?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    <?php if (!empty($seoBreadcrumbs) && is_array($seoBreadcrumbs)): ?>
    ,{
      "@type": "BreadcrumbList",
      "itemListElement": [
        <?php foreach ($seoBreadcrumbs as $bIdx => $bItem): ?>
        {
          "@type": "ListItem",
          "position": <?= $bIdx + 1 ?>,
          "name": "<?= htmlspecialchars($bItem['name'], ENT_QUOTES) ?>",
          "item": "<?= htmlspecialchars($bItem['url'], ENT_QUOTES) ?>"
        }<?= ($bIdx < count($seoBreadcrumbs) - 1) ? ',' : '' ?>
        <?php endforeach; ?>
      ]
    }
    <?php endif; ?>
    <?php if (!empty($seoCustomSchemaJson)): ?>
    ,<?= $seoCustomSchemaJson ?>
    <?php endif; ?>
  ]
}
</script>

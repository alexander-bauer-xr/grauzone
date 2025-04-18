<?php
// Define your base URL
$baseUrl = "https://www.grauzone-pott.de";

// Get the current request URI
$requestUri = $_SERVER['REQUEST_URI'];

// Remove the leading slash from the request URI if it exists
$requestUri = ltrim($requestUri, '/');

// Construct the canonical link with the extracted current page URL
$canonicalLink = $baseUrl . '/' . $requestUri;

// Ensure meta information is set and dynamically use it
$meta = isset($meta) ? $meta : [
    'title' => 'Grauzone Pott',
    'description' => 'Grauzone Pott ist ein Doku-Podcast.',
    'ogTitle' => 'Grauzone Pott',
    'ogDescription' => 'Grauzone Pott ist ein Doku-Podcast.',
    'ogImage' => '/img/default-og-image.png',
    'ogUrl' => $baseUrl,
];

$nonce = base64_encode(random_bytes(16));  // You can use any method to generate a random nonce

?>

<!-- Essential Meta Tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($meta['title'], ENT_QUOTES, 'UTF-8'); ?></title>

<!-- SEO Meta Tags -->
<meta name="description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8'); ?>">
<meta name="keywords" content="<?= htmlspecialchars($meta['keywords'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
<meta name="author" content="Alexander Bauer (Peira GbR)">

<!-- Open Graph Meta Tags (for social media sharing) -->
<meta property="og:title" content="<?= htmlspecialchars($meta['ogTitle'], ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta['ogDescription'], ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:image" content="<?= htmlspecialchars($meta['ogImage'], ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:url" content="<?= htmlspecialchars($meta['ogUrl'], ENT_QUOTES, 'UTF-8'); ?>">
<meta property="og:type" content="<?= htmlspecialchars($meta['ogType'] ?? 'website', ENT_QUOTES, 'UTF-8'); ?>">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($meta['ogTitle'], ENT_QUOTES, 'UTF-8'); ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($meta['ogDescription'], ENT_QUOTES, 'UTF-8'); ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($meta['ogImage'], ENT_QUOTES, 'UTF-8'); ?>">

<!-- Additional Meta Tags -->
<link rel="icon" type="image/png" href="/favicon-48x48.png" sizes="48x48" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Grauzone Pott" />
<link rel="manifest" href="/site.webmanifest" />

<meta name="robots" content="index, follow">
<link rel="canonical" href="<?= htmlspecialchars($canonicalLink, ENT_QUOTES, 'UTF-8'); ?>">
<meta name="theme-color" content="#ffffff">

<meta http-equiv="Content-Security-Policy" content="
    default-src 'self'; 
    img-src 'self' https://grauzone-pott.de; 
    media-src 'self' https://grauzone-pott.de https://op3.dev https://pod.grauzone-pott.de; 
    style-src 'self' 'nonce-<?= $nonce ?>'; 
    script-src 'self' 'nonce-<?= $nonce ?>';">
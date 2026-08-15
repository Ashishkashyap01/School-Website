<?php
declare(strict_types=1);

require_once __DIR__ . '/settings.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($settings['school_name']); ?></title>
<link
rel="icon"
type="image/png"
href="<?= !empty($settings['favicon'])
? '/srs/uploads/settings/' . htmlspecialchars($settings['favicon'])
: '/srs/assets/images/logo.png'; ?>">

<meta
name="description"
content="Official Website of <?= htmlspecialchars($settings['school_name']); ?>">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="/srs/assets/css/variables.css">
<link rel="stylesheet" href="/srs/assets/css/style.css">
<link rel="stylesheet" href="/srs/assets/css/header.css">
<link rel="stylesheet" href="/srs/assets/css/hero.css">
<link rel="stylesheet" href="/srs/assets/css/footer.css">
<link rel="stylesheet" href="/srs/assets/css/about.css">
<link rel="stylesheet" href="/srs/assets/css/academics.css">
<link rel="stylesheet" href="/srs/assets/css/admission.css">
<link rel="stylesheet" href="/srs/assets/css/gallery.css">
<link rel="stylesheet" href="/srs/assets/css/contact.css">
<link rel="stylesheet" href="/srs/assets/css/responsive.css">
<link rel="stylesheet" href="/srs/assets/css/news.css">
<link rel="stylesheet" href="/srs/assets/css/teachers.css">
<link rel="stylesheet" href="/srs/assets/css/events.css">
<link rel="stylesheet" href="/srs/assets/css/image-viewer.css">
<link rel="stylesheet" href="/srs/assets/css/error.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">


</head>

<body>
<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$admin = $_SESSION['admin'] ?? null;

if (!$admin) {
    header('Location: /srs/admin');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> | Sone Rising School CMS
</title>

<link
rel="icon"
type="image/png"
href="/srs/assets/images/logo.png">

<meta name="robots"
content="noindex,nofollow">

<link rel="icon"
href="/srs/assets/images/favicon.png">

<link rel="stylesheet"
href="/srs/admin/assets/css/admin.css">

<link rel="stylesheet"
href="/srs/admin/assets/css/dashboard.css">

<link rel="stylesheet"
href="/srs/admin/assets/css/components.css">

<link rel="stylesheet"
href="/srs/admin/assets/css/responsive.css">

<link rel="stylesheet" 
href="/srs/admin/assets/css/enquiries.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body> 

<div class="admin-layout">
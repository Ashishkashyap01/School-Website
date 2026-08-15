<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('pages.manage');

$pageTitle = 'Pages CMS';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Pages CMS</h2>

<p>
Manage website pages from a single place.
</p>

</div>

<div class="dashboard-box">

<div style="text-align:center;padding:70px 20px;">

<h2 style="font-size:50px;">📄</h2>

<h3>Pages CMS</h3>

<p style="margin-top:15px;color:#666;">

This module will allow you to manage pages like
About Us, Vision, Mission, Privacy Policy,
Terms & Conditions and other static pages.

</p>

<p style="margin-top:25px;color:#999;">

🚧 Coming Soon...

</p>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
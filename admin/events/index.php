<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('events.manage');

$pageTitle = 'Events';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Events Management

</h2>

<p>

Manage school events and announcements.

</p>

</div>

<div class="dashboard-box">

<div style="text-align:center;padding:70px 20px;">

<h2 style="font-size:60px;margin-bottom:15px;">

📅

</h2>

<h3>

Events Module

</h3>

<p
style="
margin-top:15px;
color:#666;
max-width:650px;
margin-left:auto;
margin-right:auto;
line-height:28px;
">

This module will allow administrators to manage
school events such as Annual Function, Sports Day,
Holiday Notices, PTM, Competitions and other
important announcements.

</p>

<p
style="
margin-top:30px;
font-size:15px;
font-weight:600;
color:#8B0000;
">

🚧 Coming Soon...

</p>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
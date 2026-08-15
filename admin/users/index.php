<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('users.manage');

$pageTitle = 'Users';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Users Management</h2>

<p>
Manage administrator accounts.
</p>

</div>

<div class="dashboard-box">

<div style="text-align:center;padding:70px 20px;">

<h2 style="font-size:50px;">👥</h2>

<h3>Users Module</h3>

<p style="margin-top:15px;color:#666;">

Multiple administrator accounts, permissions,
roles and access control will be available here.

</p>

<p style="margin-top:25px;color:#999;">

🚧 Coming Soon...

</p>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
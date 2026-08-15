<?php
declare(strict_types=1);

$pageTitle = 'View Contact Enquiry';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {

    die('Invalid Enquiry.');

}

$database = new Database();

$pdo = $database->connection();

/*
|--------------------------------------------------------------------------
| Mark as Read
|--------------------------------------------------------------------------
*/

$statement = $pdo->prepare("
    UPDATE contact_inquiries
    SET status = 'read'
    WHERE id = ?
");

$statement->execute([$id]);

/*
|--------------------------------------------------------------------------
| Get Enquiry
|--------------------------------------------------------------------------
*/

$statement = $pdo->prepare("
    SELECT *
    FROM contact_inquiries
    WHERE id = ?
");

$statement->execute([$id]);

$enquiry = $statement->fetch();

if (!$enquiry) {

    die('Enquiry not found.');

}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Contact Enquiry Details

</h2>

<p>

View complete enquiry information.

</p>

</div>

<div class="dashboard-box">

<table class="details-table">

<tr>

<th>Name</th>

<td><?= htmlspecialchars($enquiry['name']); ?></td>

</tr>

<tr>

<th>Phone</th>

<td><?= htmlspecialchars($enquiry['phone']); ?></td>

</tr>

<tr>

<th>Email</th>

<td><?= htmlspecialchars($enquiry['email']); ?></td>

</tr>

<tr>

<th>Subject</th>

<td><?= htmlspecialchars($enquiry['subject']); ?></td>

</tr>

<tr>

<th>Class</th>

<td><?= htmlspecialchars($enquiry['class']); ?></td>

</tr>

<tr>

<th>Preferred Contact</th>

<td><?= htmlspecialchars($enquiry['contact_method']); ?></td>

</tr>

<tr>

<th>Message</th>

<td><?= nl2br(htmlspecialchars($enquiry['message'])); ?></td>

</tr>

<tr>

<th>IP Address</th>

<td><?= htmlspecialchars($enquiry['ip_address']); ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<span class="status-badge <?= strtolower($enquiry['status']); ?>">

<?= ucfirst($enquiry['status']); ?>

</span>

</td>

</tr>

<tr>

<th>Received On</th>

<td>

<?= date('d M Y h:i A', strtotime($enquiry['created_at'])); ?>

</td>

</tr>

</table>

<div style="margin-top:25px;">

<a
href="/srs/admin/contact_inquiries"
class="btn-primary">

← Back to Enquiries

</a>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
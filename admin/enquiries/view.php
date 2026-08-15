<?php
declare(strict_types=1);

$pageTitle = 'View Admission Enquiry';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header('Location: /srs/admin/enquiries');
    exit;

}

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->prepare("
    SELECT *
    FROM enquiries
    WHERE id = ?
    LIMIT 1
");

$statement->execute([

    (int)$_GET['id']

]);

$enquiry = $statement->fetch();

if (!$enquiry) {

    header('Location: /srs/admin/enquiries');
    exit;

}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Admission Enquiry Details

</h2>

<p>

View complete admission enquiry information.

</p>

</div>

<div class="dashboard-box">

<table class="details-table">

<tr>

<th width="220">

Enquiry ID

</th>

<td>

<?= htmlspecialchars($enquiry['enquiry_id']); ?>

</td>

</tr>

<tr>

<th>

Student Name

</th>

<td>

<?= htmlspecialchars($enquiry['student_name']); ?>

</td>

</tr>

<tr>

<th>

Parent Name

</th>

<td>

<?= htmlspecialchars($enquiry['parent_name']); ?>

</td>

</tr>

<tr>

<th>

Phone

</th>

<td>

<a href="tel:<?= htmlspecialchars($enquiry['phone']); ?>">

<?= htmlspecialchars($enquiry['phone']); ?>

</a>

</td>

</tr>

<tr>

<th>

Email

</th>

<td>

<a href="mailto:<?= htmlspecialchars($enquiry['email']); ?>">

<?= htmlspecialchars($enquiry['email']); ?>

</a>

</td>

</tr>

<tr>

<th>

Applying Class

</th>

<td>

<?= htmlspecialchars($enquiry['applying_class']); ?>

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

<?= ucfirst($enquiry['status']); ?>

</td>

</tr>

<tr>

<th>

Submitted On

</th>

<td>

<?= date('d M Y h:i A', strtotime($enquiry['created_at'])); ?>

</td>

</tr>

<tr>

<th>

Message

</th>

<td>

<?= nl2br(htmlspecialchars($enquiry['message'])); ?>

</td>

</tr>

</table>

<div style="margin-top:30px;">

<a
href="/srs/admin/enquiries"
class="btn-secondary">

← Back

</a>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('contact_inquiries.view');

$pageTitle = 'Contact Enquiries';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM contact_inquiries
    ORDER BY created_at DESC
");

$enquiries = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Contact Enquiries

</h2>

<p>

Manage Contact Form Enquiries

</p>

</div>

<div class="dashboard-box">

<div class="table-header">

<h3>

All Contact Enquiries

</h3>

</div>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Phone</th>

<th>Email</th>

<th>Subject</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(empty($enquiries)): ?>

<tr>

<td colspan="8">

No Contact Enquiries Found.

</td>

</tr>

<?php else: ?>

<?php foreach($enquiries as $enquiry): ?>

<tr>

<td>

<?= htmlspecialchars($enquiry['inquiry_id']); ?>

</td>

<td>

<?= htmlspecialchars($enquiry['name']); ?>

</td>

<td>

<?= htmlspecialchars($enquiry['phone']); ?>

</td>

<td>

<?= htmlspecialchars($enquiry['email']); ?>

</td>

<td>

<?= htmlspecialchars($enquiry['subject']); ?>

</td>

<td>

<span class="status-badge <?= strtolower($enquiry['status']); ?>">

<?= htmlspecialchars($enquiry['status']); ?>

</span>

</td>

<td>

<?= date(
'd M Y',
strtotime($enquiry['created_at'])
); ?>

</td>

<td class="action-buttons">

<a

href="/srs/admin/contact_inquiries/view.php?id=<?= (int)$enquiry['id']; ?>"

class="btn-edit">

👁 View

</a>

<button

class="btn-delete delete-enquiry"

data-id="<?= (int)$enquiry['id']; ?>">

🗑 Delete

</button>

</td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

<script src="/srs/admin/assets/js/contact_inquiries.js"></script>
<script src="/srs/admin/assets/js/admission.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
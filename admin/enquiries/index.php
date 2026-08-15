<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('enquiries.manage');

$pageTitle = 'Admission Enquiries';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM enquiries
    ORDER BY id DESC
");

$enquiries = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Admission Enquiries

</h2>

<p>

Manage all admission enquiries submitted from the website.

</p>

</div>

<div class="dashboard-box">

<div class="table-responsive">

<table class="data-table">

<thead>

<tr>

<th>ID</th>

<th>Enquiry ID</th>

<th>Student</th>

<th>Parent</th>

<th>Class</th>

<th>Phone</th>

<th>Status</th>

<th>Date</th>

<th width="160">Action</th>

</tr>

</thead>

<tbody>

<?php if (empty($enquiries)): ?>

<tr>

<td colspan="9" style="text-align:center;">

No admission enquiries found.

</td>

</tr>

<?php endif; ?>

<?php foreach ($enquiries as $row): ?>

<tr>

<td>

<?= $row['id']; ?>

</td>

<td>

<?= htmlspecialchars($row['enquiry_id']); ?>

</td>

<td>

<?= htmlspecialchars($row['student_name']); ?>

</td>

<td>

<?= htmlspecialchars($row['parent_name']); ?>

</td>

<td>

<?= htmlspecialchars($row['applying_class']); ?>

</td>

<td>

<?= htmlspecialchars($row['phone']); ?>

</td>
<td>

<select
class="status-select"
data-id="<?= $row['id']; ?>">

<option value="new"
<?= $row['status']=='new'?'selected':''; ?>>

🟢 New

</option>

<option value="contacted"
<?= $row['status']=='contacted'?'selected':''; ?>>

📞 Contacted

</option>

<option value="confirmed"
<?= $row['status']=='confirmed'?'selected':''; ?>>

✅ Confirmed

</option>

<option value="rejected"
<?= $row['status']=='rejected'?'selected':''; ?>>

❌ Rejected

</option>

</select>

</td>
<td>

<?= date('d M Y',strtotime($row['created_at'])); ?>

</td>

<td>

<div class="action-buttons">
<a
href="/srs/admin/enquiries/view.php?id=<?= $row['id']; ?>"
class="btn-sm btn-info">

<i class="fa-solid fa-eye"></i>&nbsp;View

</a>

<button
type="button"
class="btn-sm btn-danger delete-enquiry"
data-id="<?= $row['id']; ?>">

<i class="fa-solid fa-trash"></i>&nbsp;Delete

</button>

</div>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script src="/srs/admin/assets/js/enquiries.js"></script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
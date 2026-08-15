<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('teachers.manage');

$pageTitle = 'Teachers';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM teachers
    ORDER BY sort_order ASC, id DESC
");

$teachers = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Teachers</h2>

<p>

Manage School Teachers & Faculty Members

</p>

</div>

<div class="dashboard-box">

<div class="table-header">

<h3>All Teachers</h3>

<a
href="/srs/admin/teachers/add.php"
class="btn-primary">

+ Add Teacher

</a>

</div>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Photo</th>

<th>Name</th>

<th>Designation</th>

<th>Experience</th>

<th>Status</th>

<th>Order</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(empty($teachers)): ?>

<tr>

<td colspan="8">

No Teachers Found.

</td>

</tr>

<?php else: ?>

<?php foreach($teachers as $teacher): ?>

<tr>

<td>

<?= (int)$teacher['id']; ?>

</td>

<td>

<img

src="/srs/uploads/teachers/<?= htmlspecialchars($teacher['image']); ?>"

class="table-image preview-image"

data-image="/srs/uploads/teachers/<?= htmlspecialchars($teacher['image']); ?>"

alt="Teacher">

</td>

<td>

<?= htmlspecialchars($teacher['name']); ?>

</td>

<td>

<?= htmlspecialchars($teacher['designation']); ?>

</td>

<td>

<?= htmlspecialchars($teacher['experience']); ?>

</td>

<td>

<span
class="status-badge <?= $teacher['status']; ?>">

<?= $teacher['status']=='active'
? '🟢 Active'
: '🔴 Inactive'; ?>

</span>

</td>

<td>

<?= (int)$teacher['sort_order']; ?>

</td>

<td class="action-buttons">

<a

href="/srs/admin/teachers/edit.php?id=<?= (int)$teacher['id']; ?>"

class="btn-edit">

✏ Edit

</a>

<button

class="btn-delete delete-teacher"

data-id="<?= (int)$teacher['id']; ?>">

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
<script src="/srs/admin/assets/js/delete.js"></script>

<script>

deleteRecord({

    selector: '.delete-teacher',

    url: '/srs/admin/teachers/delete.php',

    title: 'Delete Teacher?',

    successTitle: 'Deleted'

});

</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
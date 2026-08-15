<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('slider.manage');

$pageTitle = 'Hero Slider';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
SELECT *
FROM sliders
ORDER BY sort_order ASC,id DESC
");

$sliders = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Hero Slider</h2>

<p>

Manage Homepage Slider

</p>

</div>

<div class="dashboard-box">

<div class="table-header">

<h3>All Slides</h3>

<a
href="/srs/admin/slider/create.php"
class="btn-primary">

+ Add Slide

</a>

</div>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Image</th>

<th>Title</th>

<th>Status</th>

<th>Order</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(empty($sliders)): ?>

<tr>

<td colspan="6">

No Slider Found.

</td>

</tr>

<?php else: ?>

<?php foreach($sliders as $slider): ?>

<tr>

<td>

<?= $slider['id']; ?>

</td>
<td>

<img
src="/srs/uploads/slider/<?= htmlspecialchars($slider['image']) ?>"
class="table-image preview-image"
data-image="/srs/uploads/slider/<?= htmlspecialchars($slider['image']) ?>"
alt="Slider">

</td>
<td>

<?= htmlspecialchars($slider['title']) ?>

</td>

<td>

<span
class="status-badge <?= $slider['status']; ?> toggle-status"
data-id="<?= (int)$slider['id']; ?>"
style="cursor:pointer;">

<?= $slider['status']==='active'
? '🟢 Active'
: '🔴 Inactive'; ?>

</span>

</td>
<td>

<?= (int)$slider['sort_order'] ?>

</td>

<td class="action-buttons">

<a
href="/srs/admin/slider/edit.php?id=<?= $slider['id'] ?>"
class="btn-edit">

✏ Edit

</a>

<a
href="/srs/admin/slider/delete.php?id=<?= $slider['id'] ?>"
class="btn-delete delete-slider">

🗑 Delete

</a>

</td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>



<?php require_once __DIR__ . '/../includes/footer.php'; ?>
<script src="/srs/admin/assets/js/slider.js"></script>
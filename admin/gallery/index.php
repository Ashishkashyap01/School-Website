<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('gallery.manage');

$pageTitle = 'Gallery';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM gallery
    ORDER BY sort_order ASC, id DESC
");

$gallery = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Gallery</h2>

<p>

Manage School Gallery Images

</p>

</div>

<div class="dashboard-box">

<div class="table-header">

<h3>All Gallery Images</h3>

<a
href="/srs/admin/gallery/create.php"
class="btn-primary">

+ Add Image

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

<?php if(empty($gallery)): ?>

<tr>

<td colspan="6">

No Gallery Images Found.

</td>

</tr>

<?php else: ?>

<?php foreach($gallery as $image): ?>

<tr>

<td>

<?= (int)$image['id']; ?>

</td>

<td>

<img

src="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>"

class="table-image preview-image"

data-image="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>"

alt="Gallery Image">

</td>

<td>

<?= htmlspecialchars($image['title']); ?>

</td>

<td>

<span

class="status-badge <?= $image['status']; ?> toggle-gallery-status"

data-id="<?= (int)$image['id']; ?>">

<?= $image['status']=='active'
? '🟢 Active'
: '🔴 Inactive'; ?>

</span>

</td>

<td>

<?= (int)$image['sort_order']; ?>

</td>

<td class="action-buttons">

<a

href="/srs/admin/gallery/edit.php?id=<?= (int)$image['id']; ?>"

class="btn-edit">

✏ Edit

</a>

<a

href="/srs/admin/gallery/delete.php?id=<?= (int)$image['id']; ?>"

class="btn-delete delete-gallery">

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
<script src="/srs/admin/assets/js/gallery.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
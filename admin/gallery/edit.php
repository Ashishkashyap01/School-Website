<?php
declare(strict_types=1);

$pageTitle = 'Edit Gallery Image';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die('Invalid Gallery ID.');
}

$statement = $pdo->prepare("
    SELECT *
    FROM gallery
    WHERE id = ?
    LIMIT 1
");

$statement->execute([$id]);

$image = $statement->fetch();

if (!$image) {
    die('Gallery Image not found.');
}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Edit Gallery Image</h2>

<p>

Update Gallery Image Details.

</p>

</div>

<div class="dashboard-box">

<form
id="galleryForm"
action="/srs/admin/gallery/update.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="id"
value="<?= (int)$image['id']; ?>">

<input
type="hidden"
name="old_image"
value="<?= htmlspecialchars($image['image']); ?>">

<div class="settings-grid">

<div class="form-group">

<label>Image Title</label>

<input
type="text"
name="title"
value="<?= htmlspecialchars($image['title']); ?>"
required>

</div>

<div class="form-group">

<label>Display Order</label>

<input
type="number"
name="sort_order"
value="<?= (int)$image['sort_order']; ?>"
min="1">

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option
value="active"
<?= $image['status'] === 'active' ? 'selected' : ''; ?>>

Active

</option>

<option
value="inactive"
<?= $image['status'] === 'inactive' ? 'selected' : ''; ?>>

Inactive

</option>

</select>

</div>
<div class="form-group">

<label>Gallery Image</label>

<input
type="file"
id="image"
name="image"
accept=".jpg,.jpeg,.png,.webp">

<small style="display:block;margin-top:8px;color:#666;">
Leave blank to keep the current image.
</small>

</div>

<div class="form-group">

<label>Current Image</label>

<img
src="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>"
style="
width:250px;
height:160px;
border-radius:12px;
object-fit:cover;
border:1px solid #ddd;
display:block;
margin-bottom:10px;">

<img
id="previewImage"
src=""
style="
width:250px;
height:160px;
border-radius:12px;
object-fit:cover;
border:1px solid #ddd;
display:none;">

</div>

</div>

<div class="form-actions">

<button
type="submit"
class="btn-primary">

Update Image

</button>

<a
href="/srs/admin/gallery"
class="btn-secondary">

Cancel

</a>

</div>

</form>

</div>

</div>

</div>

<script src="/srs/admin/assets/js/gallery.js"></script>


<?php require_once __DIR__ . '/../includes/footer.php'; ?>
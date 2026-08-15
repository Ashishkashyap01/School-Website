<?php
declare(strict_types=1);

$pageTitle = 'Edit Hero Slide';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die('Invalid Slider ID.');
}

$statement = $pdo->prepare("
    SELECT *
    FROM sliders
    WHERE id = ?
    LIMIT 1
");

$statement->execute([$id]);

$slider = $statement->fetch();

if (!$slider) {
    die('Slider not found.');
}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Edit Hero Slide</h2>

<p>Update homepage slider.</p>

</div>

<div class="dashboard-box">

<form
id="sliderForm"
action="/srs/admin/slider/update.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="id"
value="<?= (int)$slider['id']; ?>">

<input
type="hidden"
name="old_image"
value="<?= htmlspecialchars($slider['image']); ?>">

<div class="settings-grid">

<div class="form-group">

<label>Title</label>

<input
type="text"
name="title"
value="<?= htmlspecialchars($slider['title']); ?>"
required>

</div>

<div class="form-group">

<label>Button Text</label>

<input
type="text"
name="button_text"
value="<?= htmlspecialchars($slider['button_text']); ?>">

</div>

<div class="form-group full-width">

<label>Subtitle</label>

<textarea
name="subtitle"
rows="4"><?= htmlspecialchars($slider['subtitle']); ?></textarea>

</div>

<div class="form-group">

<label>Button Link</label>

<input
type="text"
name="button_link"
value="<?= htmlspecialchars($slider['button_link']); ?>">

</div>

<div class="form-group">

<label>Display Order</label>

<input
type="number"
name="sort_order"
value="<?= (int)$slider['sort_order']; ?>"
min="1">

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option
value="active"
<?= $slider['status'] === 'active' ? 'selected' : ''; ?>>

Active

</option>

<option
value="inactive"
<?= $slider['status'] === 'inactive' ? 'selected' : ''; ?>>

Inactive

</option>

</select>

</div>
<div class="form-group">

<label>Slider Image</label>

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
src="/srs/uploads/slider/<?= htmlspecialchars($slider['image']); ?>"
style="
width:250px;
height:140px;
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
height:140px;
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

Update Slider

</button>

<a
href="/srs/admin/slider"
class="btn-secondary">

Cancel

</a>

</div>

</form>

</div>

</div>

</div>


<?php require_once __DIR__ . '/../includes/footer.php'; ?>


<script src="/srs/admin/assets/js/slider.js"></script>
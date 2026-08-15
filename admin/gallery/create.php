<?php
declare(strict_types=1);

$pageTitle = 'Add Gallery Image';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Add Gallery Image</h2>

<p>

Upload a new gallery image.

</p>

</div>

<div class="dashboard-box">

<form
id="galleryForm"
action="/srs/admin/gallery/save.php"
method="POST"
enctype="multipart/form-data">

<div class="settings-grid">

<div class="form-group">

<label>Image Title</label>

<input
type="text"
name="title"
required>

</div>

<div class="form-group">

<label>Display Order</label>

<input
type="number"
name="sort_order"
value="1"
min="1">

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option value="active">

Active

</option>

<option value="inactive">

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
accept=".jpg,.jpeg,.png,.webp"
required>

</div>

<div class="form-group">

<label>Preview</label>

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

Save Image

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
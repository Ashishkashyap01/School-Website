<?php
declare(strict_types=1);

$pageTitle = 'Edit News';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    die('Invalid News.');
}

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->prepare("
    SELECT *
    FROM news
    WHERE id = ?
");

$statement->execute([$id]);

$news = $statement->fetch();

if (!$news) {
    die('News not found.');
}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Edit News</h2>

<p>

Update School News & Events

</p>

</div>

<div class="dashboard-box">

<form
id="newsForm"
action="/srs/admin/news/update.php"
method="post"
enctype="multipart/form-data">

<input
type="hidden"
name="id"
value="<?= (int)$news['id']; ?>">

<input
type="hidden"
name="old_image"
value="<?= htmlspecialchars($news['image']); ?>">

<!-- Title -->

<div class="form-group">

<label>

News Title

</label>

<input
type="text"
name="title"
class="form-control"
value="<?= htmlspecialchars($news['title']); ?>"
required>

</div>

<!-- Publish Date -->

<div class="form-group">

<label>

Publish Date

</label>

<input
type="date"
name="publish_date"
class="form-control"
value="<?= $news['publish_date']; ?>">

</div>

<!-- Short Description -->

<div class="form-group">

<label>

Short Description

</label>

<textarea
name="short_description"
rows="3"
class="form-control"><?= htmlspecialchars($news['short_description']); ?></textarea>

</div>

<!-- Description -->

<div class="form-group">

<label>

Description

</label>

<textarea
name="description"
rows="8"
class="form-control"><?= htmlspecialchars($news['description']); ?></textarea>

</div>

<!-- Image -->

<div class="form-group">

<label>

Current Image

</label>

<br><br>

<img
id="preview"
src="/srs/uploads/news/<?= htmlspecialchars($news['image']); ?>"
class="table-image"
style="width:220px;height:auto;">

</div>

<div class="form-group">

<label>

Change Image

</label>

<input
type="file"
id="image"
name="image"
accept=".jpg,.jpeg,.png,.webp"
class="form-control">

</div>

<!-- Featured -->

<div class="form-group">

<label>

Featured

</label>

<select
name="featured"
class="form-control">

<option
value="yes"
<?= $news['featured']=='yes' ? 'selected' : ''; ?>>

Yes

</option>

<option
value="no"
<?= $news['featured']=='no' ? 'selected' : ''; ?>>

No

</option>

</select>

</div>

<!-- Sort Order -->

<div class="form-group">

<label>

Sort Order

</label>

<input
type="number"
name="sort_order"
class="form-control"
value="<?= (int)$news['sort_order']; ?>">

</div>

<!-- Status -->

<div class="form-group">

<label>

Status

</label>

<select
name="status"
class="form-control">

<option
value="active"
<?= $news['status']=='active' ? 'selected' : ''; ?>>

Active

</option>

<option
value="inactive"
<?= $news['status']=='inactive' ? 'selected' : ''; ?>>

Inactive

</option>

</select>

</div>

<div style="margin-top:25px;display:flex;gap:15px;">

<button
id="newsSubmit"
type="submit"
class="btn-primary">

💾 Update News

</button>

<a
href="/srs/admin/news"
class="btn-delete"
style="text-decoration:none;">

← Back

</a>

</div>

</form>

</div>

</div>

</div>

<script>

document
.getElementById('image')
.addEventListener('change',function(){

const file=this.files[0];

if(file){

const reader=new FileReader();

reader.onload=function(e){

document
.getElementById('preview')
.src=e.target.result;

}

reader.readAsDataURL(file);

}

});

</script>

<script src="/srs/admin/assets/js/news.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
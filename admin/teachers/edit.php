<?php
declare(strict_types=1);

$pageTitle = 'Edit Teacher';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    die('Invalid Teacher.');
}

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->prepare("
    SELECT *
    FROM teachers
    WHERE id = ?
");

$statement->execute([$id]);

$teacher = $statement->fetch();

if (!$teacher) {
    die('Teacher not found.');
}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Edit Teacher</h2>

<p>

Update Teacher Information

</p>

</div>

<div class="dashboard-box">

<form
id="teacherForm"
action="/srs/admin/teachers/update.php"
method="post"
enctype="multipart/form-data">

<input
type="hidden"
name="id"
value="<?= (int)$teacher['id']; ?>">

<input
type="hidden"
name="old_image"
value="<?= htmlspecialchars($teacher['image']); ?>">

<div class="form-group">

<label>Teacher Name</label>

<input
type="text"
name="name"
class="form-control"
required
value="<?= htmlspecialchars($teacher['name']); ?>">

</div>

<div class="form-group">

<label>Designation</label>

<input
type="text"
name="designation"
class="form-control"
required
value="<?= htmlspecialchars($teacher['designation']); ?>">

</div>

<div class="form-group">

<label>Qualification</label>

<input
type="text"
name="qualification"
class="form-control"
value="<?= htmlspecialchars($teacher['qualification']); ?>">

</div>

<div class="form-group">

<label>Experience</label>

<input
type="text"
name="experience"
class="form-control"
value="<?= htmlspecialchars($teacher['experience']); ?>">

</div>

<div class="form-group">

<label>Current Photo</label>

<br><br>

<img
id="preview"
src="/srs/uploads/teachers/<?= htmlspecialchars($teacher['image']); ?>"
class="table-image"
style="width:220px;height:auto;">

</div>

<div class="form-group">

<label>Change Photo</label>

<input
type="file"
name="image"
id="image"
accept=".jpg,.jpeg,.png,.webp"
class="form-control">

</div>

<div class="form-group">

<label>Short Bio</label>

<textarea
name="bio"
rows="5"
class="form-control"><?= htmlspecialchars($teacher['bio']); ?></textarea>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= htmlspecialchars($teacher['email']); ?>">

</div>

<div class="form-group">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?= htmlspecialchars($teacher['phone']); ?>">

</div>

<div class="form-group">

<label>Sort Order</label>

<input
type="number"
name="sort_order"
class="form-control"
value="<?= (int)$teacher['sort_order']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select
name="status"
class="form-control">

<option
value="active"
<?= $teacher['status']=='active' ? 'selected' : ''; ?>>

Active

</option>

<option
value="inactive"
<?= $teacher['status']=='inactive' ? 'selected' : ''; ?>>

Inactive

</option>

</select>

</div>

<div style="margin-top:25px;display:flex;gap:15px;">

<button
type="submit"
id="teacherSubmit"
class="btn-primary">

💾 Update Teacher

</button>

<a
href="/srs/admin/teachers"
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

<script src="/srs/admin/assets/js/teachers.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
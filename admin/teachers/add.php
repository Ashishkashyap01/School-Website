<?php
declare(strict_types=1);

$pageTitle = 'Add Teacher';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Add Teacher</h2>

<p>

Add New Teacher / Faculty Member

</p>

</div>

<div class="dashboard-box">

<form
id="teacherForm"
action="/srs/admin/teachers/save.php"
method="post"
enctype="multipart/form-data">

<!-- Teacher Name -->

<div class="form-group">

<label>

Teacher Name <span style="color:red;">*</span>

</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<!-- Designation -->

<div class="form-group">

<label>

Designation

</label>

<input
type="text"
name="designation"
class="form-control"
placeholder="Principal / PGT Mathematics"
required>

</div>

<!-- Qualification -->

<div class="form-group">

<label>

Qualification

</label>

<input
type="text"
name="qualification"
class="form-control"
placeholder="M.Sc, B.Ed">

</div>

<!-- Experience -->

<div class="form-group">

<label>

Experience

</label>

<input
type="text"
name="experience"
class="form-control"
placeholder="10 Years">

</div>

<!-- Teacher Photo -->

<div class="form-group">

<label>

Teacher Photo

</label>

<input
type="file"
name="image"
id="image"
accept=".jpg,.jpeg,.png,.webp"
class="form-control"
required>

</div>

<div class="form-group">

<img
id="preview"
src=""
alt="Preview"
style="
display:none;
width:220px;
margin-top:15px;
border-radius:8px;
border:1px solid #ddd;
padding:4px;
">

</div>

<!-- Bio -->

<div class="form-group">

<label>

Short Bio

</label>

<textarea
name="bio"
rows="5"
class="form-control"></textarea>

</div>

<!-- Email -->

<div class="form-group">

<label>

Email

</label>

<input
type="email"
name="email"
class="form-control">

</div>

<!-- Phone -->

<div class="form-group">

<label>

Phone

</label>

<input
type="text"
name="phone"
class="form-control">

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
value="1">

</div>

<!-- Status -->

<div class="form-group">

<label>

Status

</label>

<select
name="status"
class="form-control">

<option value="active">

Active

</option>

<option value="inactive">

Inactive

</option>

</select>

</div>

<div style="margin-top:25px;display:flex;gap:15px;">

<button
type="submit"
id="teacherSubmit"
class="btn-primary">

💾 Save Teacher

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

const preview=document.getElementById('preview');

preview.src=e.target.result;

preview.style.display='block';

}

reader.readAsDataURL(file);

}

});

</script>

<script src="/srs/admin/assets/js/teachers.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
<?php
declare(strict_types=1);

$pageTitle = 'Add News';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>Add News & Event</h2>

<p>

Create New School News & Events

</p>

</div>

<div class="dashboard-box">

<form
id="newsForm"
action="/srs/admin/news/save.php"
method="post"
enctype="multipart/form-data">

<div class="form-group">

<label>

News Title <span style="color:red;">*</span>

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="form-group">

<label>

Publish Date

</label>

<input
type="date"
name="publish_date"
class="form-control"
value="<?= date('Y-m-d'); ?>">

</div>

<div class="form-group">

<label>

Short Description

</label>

<textarea
name="short_description"
rows="3"
class="form-control"></textarea>

</div>

<div class="form-group">

<label>

Description

</label>

<textarea
name="description"
rows="8"
class="form-control"></textarea>

</div>

<div class="form-group">

<label>

Featured Image

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

<div class="form-group">

<label>

Featured

</label>

<select
name="featured"
class="form-control">

<option value="no">

No

</option>

<option value="yes">

Yes

</option>

</select>

</div>

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
id="newsSubmit"
class="btn-primary">

💾 Save News

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

const preview=document.getElementById('preview');

preview.src=e.target.result;

preview.style.display='block';

}

reader.readAsDataURL(file);

}

});

</script>

<script src="/srs/admin/assets/js/news.js"></script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('settings.manage');

$pageTitle = 'Website Settings';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM settings
    LIMIT 1
");

$settings = $statement->fetch();

if (!$settings) {

    $settings = [

        'school_name' => '',
        'tagline' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'facebook' => '',
        'instagram' => '',
        'youtube' => '',
        'twitter' => '',
        'theme_color' => '#7B1113',
        'logo' => '',
        'favicon' => ''

    ];

}
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>

Website Settings

</h2>

<p>

Manage your school information and branding.

</p>

</div>

<div class="dashboard-box">

<form
id="settingsForm"
action="/srs/admin/settings/update.php"
method="POST"
enctype="multipart/form-data">

<div class="settings-grid">

<div class="form-group">

<label>

School Name

</label>

<input
type="text"
name="school_name"
class="form-control"
required
value="<?= htmlspecialchars($settings['school_name']); ?>">

</div>

<div class="form-group">

<label>

Tagline

</label>

<input
type="text"
name="tagline"
class="form-control"
value="<?= htmlspecialchars($settings['tagline']); ?>">

</div>

<div class="form-group">

<label>

Email(s)

</label>

<textarea
name="email"
rows="3"
class="form-control"
placeholder="One email per line"><?= htmlspecialchars($settings['email']); ?></textarea>

</div>

<div class="form-group">

<label>

Phone Number(s)

</label>

<textarea
name="phone"
rows="3"
class="form-control"
placeholder="One phone number per line"><?= htmlspecialchars($settings['phone']); ?></textarea>

</div>

<div class="form-group full-width">

<label>

Address

</label>

<textarea
name="address"
rows="4"
class="form-control"><?= htmlspecialchars($settings['address']); ?></textarea>

</div>

<div class="form-group">

<label>

Facebook URL

</label>

<input
type="url"
name="facebook"
class="form-control"
value="<?= htmlspecialchars($settings['facebook']); ?>">

</div>

<div class="form-group">

<label>

Instagram URL

</label>

<input
type="url"
name="instagram"
class="form-control"
value="<?= htmlspecialchars($settings['instagram']); ?>">

</div>

<div class="form-group">

<label>

YouTube URL

</label>

<input
type="url"
name="youtube"
class="form-control"
value="<?= htmlspecialchars($settings['youtube']); ?>">

</div>

<div class="form-group">

<label>

Twitter URL

</label>

<input
type="url"
name="twitter"
class="form-control"
value="<?= htmlspecialchars($settings['twitter']); ?>">

</div>

<div class="form-group">

<label>

Theme Color

</label>

<input
type="color"
name="theme_color"
class="form-control"
value="<?= htmlspecialchars($settings['theme_color']); ?>">

</div>
<!-- ===========================
Branding
=========================== -->

<div class="form-group full-width">

<hr style="margin:35px 0;">

<h3>

Website Branding

</h3>

<p style="color:#666;margin-bottom:25px;">

Upload School Logo and Favicon.

</p>

</div>

<div class="form-group">

<label>

Current Logo

</label>

<br><br>

<?php if(!empty($settings['logo'])): ?>

<img

id="logoPreview"

src="/srs/uploads/settings/<?= htmlspecialchars($settings['logo']); ?>"

style="
width:140px;
height:auto;
padding:8px;
border:1px solid #ddd;
border-radius:8px;
background:#fff;
margin-bottom:15px;
display:block;
">

<?php else: ?>

<img

id="logoPreview"

src=""

style="
display:none;
width:140px;
padding:8px;
border:1px solid #ddd;
border-radius:8px;
background:#fff;
margin-bottom:15px;
">

<?php endif; ?>

<input

type="file"

id="logo"

name="logo"

accept=".jpg,.jpeg,.png,.webp,.svg"

class="form-control">

</div>

<div class="form-group">

<label>

Current Favicon

</label>

<br><br>

<?php if(!empty($settings['favicon'])): ?>

<img

id="faviconPreview"

src="/srs/uploads/settings/<?= htmlspecialchars($settings['favicon']); ?>"

style="
width:64px;
height:64px;
padding:8px;
border:1px solid #ddd;
border-radius:8px;
background:#fff;
margin-bottom:15px;
display:block;
">

<?php else: ?>

<img

id="faviconPreview"

src=""

style="
display:none;
width:64px;
height:64px;
padding:8px;
border:1px solid #ddd;
border-radius:8px;
background:#fff;
margin-bottom:15px;
">

<?php endif; ?>

<input

type="file"

id="favicon"

name="favicon"

accept=".png,.jpg,.jpeg,.webp,.ico"

class="form-control">

</div>

</div>

<div class="form-actions">

<button

id="settingsSubmit"

type="submit"

class="btn-primary">

💾 Save Settings

</button>

</div>

</form>

</div>

</div>

</div>

<script>

function previewImage(inputId, previewId){

const input=document.getElementById(inputId);

if(!input){

return;

}

input.addEventListener('change',function(){

const file=this.files[0];

if(!file){

return;

}

const reader=new FileReader();

reader.onload=function(e){

const preview=document.getElementById(previewId);

preview.src=e.target.result;

preview.style.display='block';

}

reader.readAsDataURL(file);

});

}

previewImage(

'logo',

'logoPreview'

);

previewImage(

'favicon',

'faviconPreview'

);

</script>
<script src="/srs/admin/assets/js/settings.js"></script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
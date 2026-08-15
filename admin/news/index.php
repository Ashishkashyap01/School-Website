<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('news.manage');

$pageTitle = 'News';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM news
    ORDER BY publish_date DESC, id DESC
");

$newsList = $statement->fetchAll();
?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

<div class="welcome-card">

<h2>News & Events</h2>

<p>

Manage School News & Events

</p>

</div>

<div class="dashboard-box">

<div class="table-header">

<h3>All News</h3>

<a
href="/srs/admin/news/add.php"
class="btn-primary">

+ Add News

</a>

</div>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Image</th>

<th>Title</th>

<th>Date</th>

<th>Featured</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(empty($newsList)): ?>

<tr>

<td colspan="7">

No News Found.

</td>

</tr>

<?php else: ?>

<?php foreach($newsList as $news): ?>

<tr>

<td>

<?= (int)$news['id']; ?>

</td>

<td>

<img

src="/srs/uploads/news/<?= htmlspecialchars($news['image']); ?>"

class="table-image preview-image"

data-image="/srs/uploads/news/<?= htmlspecialchars($news['image']); ?>"

alt="News Image">

</td>

<td>

<?= htmlspecialchars($news['title']); ?>

</td>

<td>

<?= date('d M Y', strtotime($news['publish_date'])); ?>

</td>

<td>

<?php if($news['featured']=='yes'): ?>

<span class="status-badge active">

⭐ Featured

</span>

<?php else: ?>

<span class="status-badge inactive">

No

</span>

<?php endif; ?>

</td>

<td>

<span

class="status-badge <?= $news['status']; ?>">

<?= $news['status']=='active'
? '🟢 Active'
: '🔴 Inactive'; ?>

</span>

</td>

<td class="action-buttons">

<a

href="/srs/admin/news/edit.php?id=<?= (int)$news['id']; ?>"

class="btn-edit">

✏ Edit

</a>

<button

class="btn-delete delete-news"

data-id="<?= (int)$news['id']; ?>">

🗑 Delete

</button>

</td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

<script>

document.querySelectorAll('.delete-news').forEach(button => {

    button.addEventListener('click', function () {

        const id = this.dataset.id;

        Swal.fire({

            title: 'Delete News?',

            text: 'This action cannot be undone.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#8B0000',

            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Yes, Delete'

        }).then(async(result)=>{

            if(!result.isConfirmed){

                return;

            }

            const formData = new FormData();

            formData.append('id', id);

            const response = await fetch(

                '/srs/admin/news/delete.php',

                {

                    method:'POST',

                    body:formData

                }

            );

            const json = await response.json();

            if(json.success){

                Swal.fire({

                    icon:'success',

                    title:'Deleted',

                    text:json.message,

                    confirmButtonColor:'#8B0000'

                }).then(()=>{

                    location.reload();

                });

            }else{

                Swal.fire({

                    icon:'error',

                    title:'Error',

                    text:json.message,

                    confirmButtonColor:'#8B0000'

                });

            }

        });

    });

});

</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
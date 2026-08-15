<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

$slug = trim($_GET['slug'] ?? '');

if ($slug === '') {

    die('Invalid News.');

}

$database = new Database();

$pdo = $database->connection();

/*
|--------------------------------------------------------------------------
| Current News
|--------------------------------------------------------------------------
*/

$statement = $pdo->prepare("
    SELECT *
    FROM news
    WHERE slug=?
    AND status='active'
    LIMIT 1
");

$statement->execute([$slug]);

$news = $statement->fetch();

if(!$news){

    die('News not found.');

}

/*
|--------------------------------------------------------------------------
| Related News
|--------------------------------------------------------------------------
*/

$statement = $pdo->prepare("
SELECT *
FROM news
WHERE status='active'
AND id!=?
ORDER BY publish_date DESC
LIMIT 3
");

$statement->execute([$news['id']]);

$relatedNews = $statement->fetchAll();

?>

<!-- ===========================
PAGE BANNER
=========================== -->

<section class="page-banner">

<div class="page-banner-overlay"></div>

<img
src="/srs/assets/images/news/banner.jpg"
alt="News Banner">

<div class="container page-banner-content">

<h1>

<?= htmlspecialchars($news['title']); ?>

</h1>

<p>

Home / News Details

</p>

</div>

</section>

<!-- ===========================
NEWS DETAILS
=========================== -->

<section class="news-details">

<div class="container">

<div class="news-details-card">
    
<img
src="/uploads/news/<?= htmlspecialchars($news['image']); ?>"
alt="<?= htmlspecialchars($news['title']); ?>"
class="news-details-image image-viewer"
data-image="/uploads/news/<?= htmlspecialchars($news['image']); ?>">

<div class="news-details-content">

<span class="news-date">

📅

<?= date(
'd M Y',
strtotime($news['publish_date'])
); ?>

</span>

<h2>

<?= htmlspecialchars($news['title']); ?>

</h2>

<div class="news-description">

<?= nl2br(htmlspecialchars($news['description'])); ?>

</div>

</div>

</div>

</div>

</section>

<!-- ===========================
RELATED NEWS
=========================== -->

<section class="news-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

MORE NEWS

</span>

<h2>

Related News

</h2>

</div>

<div class="news-grid">

<?php foreach($relatedNews as $item): ?>

<div class="news-card">

<div class="news-image">

<img

src="/srs/uploads/news/<?= htmlspecialchars($item['image']); ?>"

alt="">

</div>

<div class="news-content">

<span class="news-date">

📅

<?= date(
'd M Y',
strtotime($item['publish_date'])
); ?>

</span>

<h3>

<?= htmlspecialchars($item['title']); ?>

</h3>

<p>

<?= htmlspecialchars($item['short_description']); ?>

</p>

<a

href="/srs/news-details?slug=<?= urlencode($item['slug']); ?>"

class="btn-primary">

Read More

</a>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

<!-- ===========================
CTA
=========================== -->

<section class="cta-section">

<div class="container cta-box">

<div>

<span class="section-tag">

ADMISSION OPEN

</span>

<h2>

Join Sone Rising School Today

</h2>

<p>

Limited seats available for Session 2026-27

</p>

</div>

<div>

<a
href="/srs/admission"
class="btn-primary">

Apply Now

</a>

</div>

</div>

</section>

<?php
require_once __DIR__.'/../includes/footer.php';
?>
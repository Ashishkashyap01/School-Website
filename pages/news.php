<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

$database = new Database();

$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM news
    WHERE status='active'
    ORDER BY publish_date DESC
");

$newsList = $statement->fetchAll();
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

            News & Events

        </h1>

        <p>

            Home / News

        </p>

    </div>

</section>

<!-- ===========================
NEWS SECTION
=========================== -->

<section class="news-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

LATEST NEWS

</span>

<h2>

School News & Events

</h2>

<p>

Stay updated with the latest news, announcements and events of Sone Rising School.

</p>

</div>

<div class="news-grid">

<?php if(empty($newsList)): ?>

<div class="empty-news">

<h3>

No News Available

</h3>

<p>

Latest news will appear here soon.

</p>

</div>

<?php else: ?>

<?php foreach($newsList as $news): ?>

<div class="news-card">

<div class="news-image">
<img
src="/srs/uploads/news/<?= htmlspecialchars($news['image']); ?>"
alt="<?= htmlspecialchars($news['title']); ?>"
class="image-viewer"
data-image="/srs/uploads/news/<?= htmlspecialchars($news['image']); ?>">
</div>

<div class="news-content">

<span class="news-date">

📅

<?= date(
'd M Y',
strtotime($news['publish_date'])
); ?>

</span>

<h3>

<?= htmlspecialchars($news['title']); ?>

</h3>

<p>

<?= nl2br(htmlspecialchars($news['short_description'])); ?>

</p>

<a

href="/srs/news-details?slug=<?= urlencode($news['slug']); ?>"

class="btn-primary">

Read More

</a>

</div>

</div>

<?php endforeach; ?>

<?php endif; ?>

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
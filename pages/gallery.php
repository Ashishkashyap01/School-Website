<?php

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../core/Database.php';

$database = new Database();

$pdo = $database->connection();

$statement = $pdo->prepare("
SELECT *
FROM gallery
WHERE status='active'
ORDER BY sort_order ASC,id DESC
");

$statement->execute();

$gallery = $statement->fetchAll();
?>

<!-- PAGE BANNER -->

<section class="page-banner">

    <div class="page-banner-overlay"></div>

    <img src="/srs/assets/images/gallery/gallery1.jpg" alt="Gallery Banner">

    <div class="container page-banner-content">

        <h1>Gallery</h1>

        <p>Home / Gallery</p>

    </div>

</section>

<!-- GALLERY -->

<!-- GALLERY -->

<section class="gallery-page">

<div class="container">

<div class="section-title">

<span class="section-tag">

OUR GALLERY

</span>

<h2>

School Moments

</h2>

<p>

Explore campus life, activities and achievements.

</p>

</div>

<div class="gallery-grid">

<?php if(empty($gallery)): ?>

<p style="text-align:center;width:100%;">

No gallery images available.

</p>

<?php else: ?>

<?php foreach($gallery as $image): ?>

<div class="gallery-card">

<img
    src="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>"
    alt="<?= htmlspecialchars($image['title']); ?>"
    class="image-viewer"
    data-image="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>">
</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

</div>

</section>
<!-- CTA -->

<section class="cta-section">

    <div class="container cta-box">

        <div>

            <span class="section-tag">

                JOIN US

            </span>

            <h2>

                Become Part Of Our School Family

            </h2>

            <p>

                Admissions are open for the new academic session.

            </p>

        </div>

        <div>

            <a href="/srs/admission"
               class="btn-primary">

                Apply Now

            </a>

        </div>

    </div>

</section>

<?php

require_once __DIR__ . '/../includes/footer.php';

?>
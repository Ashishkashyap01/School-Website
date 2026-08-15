<?php

require_once __DIR__.'/../core/Database.php';

$database = new Database();

$pdo = $database->connection();

$statement = $pdo->query("
SELECT *
FROM sliders
WHERE status='active'
ORDER BY sort_order ASC,id ASC
");

$sliders = $statement->fetchAll();
/*
|--------------------------------------------------------------------------
| Home Gallery
|--------------------------------------------------------------------------
*/

$galleryStatement = $pdo->prepare("
SELECT *
FROM gallery
WHERE status='active'
ORDER BY sort_order ASC,id DESC
LIMIT 6
");

$galleryStatement->execute();

$galleryImages = $galleryStatement->fetchAll();

?>
<?php

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';



?>


<!-- HERO SECTION START -->

<section class="hero">

<div class="swiper heroSwiper">

<div class="swiper-wrapper">

<?php foreach($sliders as $index => $slider): ?>

<div class="swiper-slide hero-slide">

<img
class="hero-bg"
src="/srs/uploads/slider/<?= htmlspecialchars($slider['image']); ?>"
alt="<?= htmlspecialchars($slider['title']); ?>">

<div class="hero-overlay"></div>

<?php if($index === 0): ?>

<div class="container hero-content">

<span class="hero-tag">

CBSE Curriculum • English Medium

</span>

<h1 style="color: black;"> Welcome to<br>Sone Rising School

<?php
if(!empty($slider['title'])){

  //  echo nl2br(htmlspecialchars($slider['title']));

}else{

    echo 'Welcome to<br>Sone Rising School';

}
?>

</h1>

<?php if(!empty($slider['subtitle'])): ?>

<p  style="color: black;">
Inspiring Young Minds • Building Bright Futures


</p>

<?php else: ?>

<p>

Inspiring Young Minds • Building Bright Futures

</p>

<?php endif; ?>

<div class="hero-buttons">

<?php if(
!empty($slider['button_text']) &&
!empty($slider['button_link'])
): ?>

<a
href="/<?= htmlspecialchars($slider['button_link']); ?>"
class="btn-primary">

<?= htmlspecialchars($slider['button_text']); ?>

</a>

<?php endif; ?>

<a
href="/about"
class="btn-outline">

Explore School

</a>

</div>

</div>

<?php endif; ?>

</div>

<?php endforeach; ?>

</div>

<div class="swiper-pagination"></div>

<div class="swiper-button-next"></div>

<div class="swiper-button-prev"></div>

</div>

</section>



<section class="stats-section counter-section">

    <div class="container stats-grid">

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="1000"
            data-suffix="+">

            0

            </h2>

            <p>Students</p>

        </div>

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="50"
            data-suffix="+">

            0

            </h2>

            <p>Teachers</p>

        </div>

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="25"
            data-suffix="+">

            0

            </h2>

            <p>Classrooms</p>

        </div>

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="15"
            data-suffix="+">

            0

            </h2>

            <p>Years</p>

        </div>

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="20"
            data-suffix="+">

            0

            </h2>

            <p>Awards</p>

        </div>

        <div class="stat-card counter-card">

            <h2
            class="counter"
            data-target="98"
            data-suffix="%">

            0

            </h2>

            <p>Parent Satisfaction</p>

        </div>

    </div>

</section>

<section class="about-section">

<div class="container about-grid">

<div class="about-left">

<span class="section-tag">
ABOUT US
</span>

<h2>
Excellence in Education
Since 2011
</h2>

<p>

Sone Rising School is committed to academic excellence,
discipline and holistic development of every child.

</p>

<a href="about" class="btn-primary">
Read More
</a>

</div>

<div class="about-center">

<img src="/srs/assets/images/about.png">

</div>

<div class="about-right">

<h3>Our Facilities</h3>

<div class="facility-grid">

<div>🏫<br>Smart Classrooms</div>

<div>💻<br>Computer Lab</div>

<div>📚<br>Library</div>

<div>⚽<br>Sports</div>

<div>🚌<br>Transport</div>

<div>🏥<br>Medical</div>

<div>🎭<br>Activities</div>

<div>🛡<br>Safe Campus</div>

</div>

</div>

</div>

</section>



<section class="info-section">

    <div class="container info-grid">

        <!-- Events -->

        <div class="info-card">

            <span class="section-tag">UPCOMING EVENT</span>

            <h2>77<sup>th</sup> Republic Day Celebration</h2>

            <p><strong>26 January 2026</strong></p>

            <p>10:00 AM Onwards</p>

            <a href="events" class="btn-primary">View All Events</a>

        </div>

        <!-- News -->

        <div class="info-card">

            <span class="section-tag">LATEST NEWS</span>

            <ul class="news-list">

                <li>School Reopens After Summer Break</li>

                <li>Annual Sports Day 2026</li>

                <li>Admissions Open for Session 2026-27</li>

                <li>CBSE Board Registration Started</li>

            </ul>

            <a href="news" class="btn-primary">View All News</a>

        </div>

        <!-- Admission -->

        <div class="admission-card">

            <span class="section-tag">ADMISSION OPEN</span>

            <h2>Session 2026-27</h2>

            <p>
                Limited seats available.
                Secure your child's future today.
            </p>

           <!------- <img src="/srs/assets/images/logo.png" alt="Student">---->

            <a href="admission" class="btn-primary">
                Apply Online
            </a>

        </div>

    </div>

</section>

<section class="welcome-section">

    <div class="container welcome-grid">

        <div class="welcome-image">

            <img src="/srs/assets/images/about/principal.png" alt="Principal"
              class="image-viewer"
    data-image="/srs/assets/images/about/principal.png">

        </div>

        <div class="welcome-content">

            <span class="section-tag">
                WELCOME MESSAGE
            </span>

            <h2>
                Message From The Principal
            </h2>

            <p>

                At Sone Rising School, we believe every child has unique
                potential. Our mission is to nurture curiosity, build strong
                values, and provide quality education in a safe, inspiring
                environment.

            </p>

            <p>

                Together with dedicated teachers and supportive parents,
                we prepare students for academic excellence and responsible
                citizenship.

            </p>

            <a href="academics" class="btn-primary">
                Read Full Message
            </a>

        </div>

    </div>

</section>


<section class="gallery-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

OUR GALLERY

</span>

<h2>

Life At Sone Rising School

</h2>

<p>

Explore our classrooms, activities and memorable moments.

</p>

</div>

<div class="gallery-grid">

<?php foreach($galleryImages as $image): ?>

<div class="gallery-item">

<img
src="/uploads/gallery/<?= htmlspecialchars($image['image']); ?>"
alt="<?= htmlspecialchars($image['title']); ?>"
  class="image-viewer"
    data-image="/srs/uploads/gallery/<?= htmlspecialchars($image['image']); ?>">
</div>

<?php endforeach; ?>

</div>

</div>

</section>


<section class="cta-section">

    <div class="container cta-box">

        <div>
            <span class="section-tag">ADMISSIONS OPEN 2026-27</span>

            <h2>Give Your Child the Best Future</h2>

            <p>
                Admissions are now open for Nursery to Class XII.
                Visit our campus or apply online today.
            </p>
        </div>

        <div>

            <a href="/admission" class="btn-primary">
                Apply Now
            </a>

        </div>

    </div>

</section>

<?php
require_once __DIR__ . '/../includes/footer.php';
<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

$database = new Database();
$pdo = $database->connection();

$statement = $pdo->query("
    SELECT *
    FROM teachers
    WHERE status='active'
    ORDER BY sort_order ASC,id DESC
");

$teachers = $statement->fetchAll();
?>

<!-- ===========================
PAGE BANNER
=========================== -->

<section class="page-banner">

    <div class="page-banner-overlay"></div>

    <img
    src="/srs/assets/images/teachers/banner.jpg"
    alt="Faculty Banner">

    <div class="container page-banner-content">

        <h1>Our Faculty</h1>

        <p>Home / Faculty</p>

    </div>

</section>

<!-- ===========================
TEACHERS
=========================== -->

<section class="teachers-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

OUR FACULTY

</span>

<h2>

Meet Our Experienced Teachers

</h2>

<p>

Our dedicated educators inspire students through quality education,
discipline and innovation.

</p>

</div>

<div class="teachers-grid">

<?php if(empty($teachers)): ?>

<div class="empty-teachers">

<h3>

No Teachers Available

</h3>

<p>

Faculty information will be available soon.

</p>

</div>

<?php else: ?>

<?php foreach($teachers as $teacher): ?>

<div class="teacher-card">

<div class="teacher-image">

<div class="teacher-image">

<img
src="/srs/uploads/teachers/<?= htmlspecialchars($teacher['image']); ?>"
alt="<?= htmlspecialchars($teacher['name']); ?>"
class="image-viewer"
data-image="/srs/uploads/teachers/<?= htmlspecialchars($teacher['image']); ?>">

</div>

</div>

<div class="teacher-content">

<h3>

<?= htmlspecialchars($teacher['name']); ?>

</h3>

<span class="designation">

<?= htmlspecialchars($teacher['designation']); ?>

</span>

<p>

🎓

<?= htmlspecialchars($teacher['qualification']); ?>

</p>

<p>

⭐

<?= htmlspecialchars($teacher['experience']); ?>

</p>

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

JOIN US

</span>

<h2>

Shape Your Child's Bright Future

</h2>

<p>

Admissions are now open. Become a part of Sone Rising School.

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

<?php require_once __DIR__.'/../includes/footer.php'; ?>
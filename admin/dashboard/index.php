<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('dashboard.view');

$pageTitle = 'Dashboard';

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../../core/Database.php';

$database = new Database();

$pdo = $database->connection();

/*
|--------------------------------------------------------------------------
| Dashboard Statistics
|--------------------------------------------------------------------------
*/

$totalUsers = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

$totalGallery = (int)$pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn();

$totalNews = (int)$pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();

$totalEnquiries = (int)$pdo->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();

$totalContact = (int)$pdo->query("SELECT COUNT(*) FROM contact_inquiries")->fetchColumn();

$totalTeachers = (int)$pdo->query("SELECT COUNT(*) FROM teachers")->fetchColumn();

$totalSlider = (int)$pdo->query("SELECT COUNT(*) FROM sliders")->fetchColumn();

?>

<div class="main-content">

<?php require_once __DIR__ . '/../includes/topbar.php'; ?>

<div class="content-area">

    <div class="welcome-card">

        <div>

            <h2>
                Welcome,
                <?= htmlspecialchars($_SESSION['admin']['name']) ?> 👋
            </h2>

            <p>

                Welcome to the Sone Rising School CMS Dashboard.

            </p>

        </div>

    </div>

   <div class="dashboard-cards">

    <div class="dashboard-card">

        <h3>Total Users</h3>

        <h2><?= $totalUsers; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>Hero Slides</h3>

        <h2><?= $totalSlider; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>Gallery Images</h3>

        <h2><?= $totalGallery; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>Teachers</h3>

        <h2><?= $totalTeachers; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>News</h3>

        <h2><?= $totalNews; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>Contact Enquiries</h3>

        <h2><?= $totalContact; ?></h2>

    </div>

    <div class="dashboard-card">

        <h3>Admission Enquiries</h3>

        <h2><?= $totalEnquiries; ?></h2>

    </div>

</div>

    <div class="dashboard-grid">

        <div class="dashboard-box">
    
            <h3>Quick Actions</h3>

                <a href="/srs/admin/slider">🖼 Hero Slider</a>

                <a href="/srs/admin/gallery">🖼 Gallery</a>

                <a href="/srs/admin/teachers">👨‍🏫 Teachers</a>

                <a href="/srs/admin/news">📰 News</a>

                <a href="/srs/admin/contact_inquiries">📩 Contact Enquiries</a>

                <a href="/srs/admin/enquiries">🎓 Admission Enquiries</a>

                <a href="/srs/admin/settings">⚙ Website Settings</a>

        </div>

      <div class="dashboard-box">

        <h3>System Status</h3>

            <ul>

            <li>✅ CMS Running Successfully</li>

            <li>✅ Database Connected</li>

            <li>✅ Email Service Active</li>

            <li>✅ Website Settings Configured</li>

            <li>✅ Admission Module Active</li>

            <li>✅ Contact Module Active</li>

            </ul>

        </div>

    </div>

</div>

</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
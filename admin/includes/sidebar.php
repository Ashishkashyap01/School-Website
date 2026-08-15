<?php

require_once __DIR__ . '/../../core/Permission.php';

?>

<aside class="sidebar">

    <div class="sidebar-logo">

        <img
            src="/srs/assets/images/logo.png"
            alt="SRS Logo">

        <h2>SRS CMS</h2>

        <p>Admin Panel</p>

    </div>

    <ul class="sidebar-menu">

        <?php if (can('dashboard.view')): ?>

            <li>
                <a href="/srs/admin/dashboard" class="active">
                    <span>🏠</span>
                    Dashboard
                </a>
            </li>

        <?php endif; ?>

        
        <?php if (can('slider.manage')): ?>

            <li>
                <a href="/srs/admin/slider">
                    <span>🖼️</span>
                    Hero Slider
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('pages.manage')): ?>

            <li>
                <a href="/srs/admin/pages">
                    <span>📄</span>
                    Pages CMS
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('gallery.manage')): ?>

            <li>
                <a href="/srs/admin/gallery">
                    <span>🖼️</span>
                    Gallery
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('teachers.manage')): ?>

            <li>
                <a href="/srs/admin/teachers">
                    <span>👨‍🏫</span>
                    Teachers
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('news.manage')): ?>

            <li>
                <a href="/srs/admin/news">
                    <span>📰</span>
                    News
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('events.manage')): ?>

            <li>
                <a href="/srs/admin/events">
                    <span>📅</span>
                    Events
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('contact_inquiries.view')): ?>

            <li>
                <a href="/srs/admin/contact_inquiries">
                    <span>📩</span>
                    Contact Enquiries
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('enquiries.manage')): ?>

            <li>
                <a href="/srs/admin/enquiries">
                    <span>📬</span>
                    Enquiries
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('users.manage')): ?>

            <li>
                <a href="/srs/admin/users">
                    <span>👥</span>
                    Users
                </a>
            </li>

        <?php endif; ?>

        <?php if (can('settings.manage')): ?>

            <li>
                <a href="/srs/admin/settings">
                    <span>⚙️</span>
                    Settings
                </a>
            </li>

        <?php endif; ?>

        <li class="logout">

            <a href="/srs/admin/auth/logout.php">

                <span>🚪</span>

                Logout

            </a>

        </li>

    </ul>

</aside>
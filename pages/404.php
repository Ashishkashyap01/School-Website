<?php

http_response_code(404);

$pageTitle = '404 - Page Not Found';

require_once __DIR__ . '/../includes/header.php';
?>

<link rel="stylesheet" href="/srs/assets/css/error.css">

<div class="error-page">

    <div class="error-box">

        <div class="error-code">

            404

        </div>

        <h1>

            Oops! Page Not Found

        </h1>

        <p>

            The page you are looking for doesn't exist or may have been moved.

        </p>

        <div class="error-buttons">

            <a href="/srs/" class="btn-primary">

                Back to Home

            </a>

            <a href="/srs/contact" class="btn-outline">

                Contact Us

            </a>

        </div>

    </div>

</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
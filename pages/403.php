<?php

http_response_code(403);

$pageTitle = '403';
require_once __DIR__ . '/../includes/header.php';
?>

<link rel="stylesheet" href="/srs/assets/css/error.css">

<div class="error-page">

    <div class="error-box">

        <div class="error-code">

            403

        </div>

        <h1>

            Access Denied

        </h1>

        <p>

            You don't have permission to access this page.

        </p>

        <div class="error-buttons">

            <a href="/srs/" class="btn-primary">

                Back to Home

            </a>

        </div>

    </div>

</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
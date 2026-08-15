<?php

http_response_code(500);

$pageTitle = '500 - Server Error';

require_once __DIR__ . '/../includes/header.php';
?>

<link rel="stylesheet" href="/srs/assets/css/error.css">

<div class="error-page">

    <div class="error-box">

        <div class="error-code">

            500

        </div>

        <h1>

            Something Went Wrong

        </h1>

        <p>

            Our team has been notified. Please try again later.

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
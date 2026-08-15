<?php
declare(strict_types=1);

session_start();

/*
|--------------------------------------------------------------------------
| Authentication Check
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['admin'])) {

    header('Location: /srs/admin/auth/login.php');

    exit;

}

/*
|--------------------------------------------------------------------------
| Session Timeout
|--------------------------------------------------------------------------
*/

$timeout = 1800; // 30 Minutes

if (

    isset($_SESSION['last_activity']) &&

    (time() - $_SESSION['last_activity']) > $timeout

) {

    session_unset();

    session_destroy();

    header('Location: /srs/admin/auth/login.php');

    exit;

}

$_SESSION['last_activity'] = time();
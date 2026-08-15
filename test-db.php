<?php

require_once __DIR__ . '/core/Database.php';

try {

    $db = new Database();

    echo "Database Connected Successfully ✅";

} catch (Throwable $e) {

    die($e->getMessage());

}
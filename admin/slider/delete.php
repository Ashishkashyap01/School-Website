<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../../core/Database.php';

try {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id <= 0) {
        throw new Exception('Invalid Slider ID.');
    }

    $database = new Database();
    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Get Image Name
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        SELECT image
        FROM sliders
        WHERE id = ?
        LIMIT 1
    ");

    $statement->execute([$id]);

    $slider = $statement->fetch();

    if (!$slider) {
        throw new Exception('Slider not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Database Record
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        DELETE FROM sliders
        WHERE id = ?
    ");

    $statement->execute([$id]);

    /*
    |--------------------------------------------------------------------------
    | Delete Image
    |--------------------------------------------------------------------------
    */

    if (!empty($slider['image'])) {

        $image = __DIR__ . '/../../uploads/slider/' . $slider['image'];

        if (is_file($image)) {
            unlink($image);
        }

    }

    header('Location: /srs/admin/slider');
    exit;

} catch (Throwable $exception) {

    die($exception->getMessage());

}
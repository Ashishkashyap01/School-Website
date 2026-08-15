<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../../core/Database.php';

try {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id <= 0) {
        throw new Exception('Invalid Gallery Image ID.');
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
        FROM gallery
        WHERE id = ?
        LIMIT 1
    ");

    $statement->execute([$id]);

    $gallery = $statement->fetch();

    if (!$gallery) {
        throw new Exception('Gallery Image not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Database Record
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        DELETE FROM gallery
        WHERE id = ?
    ");

    $statement->execute([$id]);

    /*
    |--------------------------------------------------------------------------
    | Delete Image File
    |--------------------------------------------------------------------------
    */

    if (!empty($gallery['image'])) {

        $imagePath = __DIR__ . '/../../uploads/gallery/' . $gallery['image'];

        if (is_file($imagePath)) {
            unlink($imagePath);
        }

    }

    header('Location: /srs/admin/gallery');
    exit;

} catch (Throwable $exception) {

    die($exception->getMessage());

}
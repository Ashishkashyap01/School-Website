<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../core/Database.php';

header('Content-Type: application/json');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid Request.');
    }

    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {
        throw new Exception('Invalid News.');
    }

    $database = new Database();

    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Get News
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        SELECT image
        FROM news
        WHERE id=?
    ");

    $statement->execute([$id]);

    $news = $statement->fetch();

    if (!$news) {
        throw new Exception('News not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Image
    |--------------------------------------------------------------------------
    */

    $image = __DIR__ .
        '/../../uploads/news/' .
        $news['image'];

    if (is_file($image)) {

        unlink($image);

    }

    /*
    |--------------------------------------------------------------------------
    | Delete Record
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        DELETE
        FROM news
        WHERE id=?
    ");

    $statement->execute([$id]);

    echo json_encode([

        'success' => true,

        'message' => 'News deleted successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
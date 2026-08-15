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
        throw new Exception('Invalid Teacher.');
    }

    $database = new Database();

    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Get Teacher
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        SELECT image
        FROM teachers
        WHERE id=?
    ");

    $statement->execute([$id]);

    $teacher = $statement->fetch();

    if (!$teacher) {
        throw new Exception('Teacher not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Image
    |--------------------------------------------------------------------------
    */

    $image = __DIR__ .
        '/../../uploads/teachers/' .
        $teacher['image'];

    if (is_file($image)) {

        unlink($image);

    }

    /*
    |--------------------------------------------------------------------------
    | Delete Database Record
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        DELETE
        FROM teachers
        WHERE id=?
    ");

    $statement->execute([$id]);

    echo json_encode([

        'success' => true,

        'message' => 'Teacher deleted successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../core/Database.php';

header('Content-Type: application/json');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        throw new Exception('Invalid request.');

    }

    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {

        throw new Exception('Invalid enquiry ID.');

    }

    $database = new Database();

    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Check Enquiry Exists
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        SELECT id
        FROM enquiries
        WHERE id = ?
        LIMIT 1
    ");

    $statement->execute([$id]);

    if (!$statement->fetch()) {

        throw new Exception('Enquiry not found.');

    }

    /*
    |--------------------------------------------------------------------------
    | Delete Enquiry
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        DELETE
        FROM enquiries
        WHERE id = ?
    ");

    $statement->execute([$id]);

    echo json_encode([

        'success' => true,

        'message' => 'Admission enquiry deleted successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
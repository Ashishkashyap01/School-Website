<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../core/Database.php';

header('Content-Type: application/json');

try {

    /*
    |--------------------------------------------------------------------------
    | Request Validation
    |--------------------------------------------------------------------------
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        throw new Exception('Invalid request.');

    }

    /*
    |--------------------------------------------------------------------------
    | Collect Data
    |--------------------------------------------------------------------------
    */

    $id = (int)($_POST['id'] ?? 0);

    $status = trim($_POST['status'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if ($id <= 0) {

        throw new Exception('Invalid enquiry ID.');

    }

    $allowedStatus = [

        'new',

        'contacted',

        'confirmed',

        'rejected'

    ];

    if (!in_array($status, $allowedStatus, true)) {

        throw new Exception('Invalid status.');

    }

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */

    $database = new Database();

    $pdo = $database->connection();

    $statement = $pdo->prepare("
        UPDATE enquiries
        SET status = ?
        WHERE id = ?
    ");

    $statement->execute([

        $status,

        $id

    ]);

    echo json_encode([

        'success' => true,

        'message' => 'Status updated successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
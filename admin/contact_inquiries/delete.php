<?php
declare(strict_types=1);

header('Content-Type: application/json');

require_once __DIR__ . '/../../core/Database.php';

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        throw new Exception('Invalid Request.');

    }

    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {

        throw new Exception('Invalid Enquiry ID.');

    }

    $database = new Database();

    $pdo = $database->connection();

    $statement = $pdo->prepare("
        DELETE
        FROM contact_inquiries
        WHERE id = ?
    ");

    $statement->execute([$id]);

    echo json_encode([

        'success' => true,

        'message' => 'Contact enquiry deleted successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
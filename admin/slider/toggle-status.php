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
        throw new Exception('Invalid Slider ID.');
    }

    $database = new Database();
    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Get Current Status
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        SELECT status
        FROM sliders
        WHERE id = ?
        LIMIT 1
    ");

    $statement->execute([$id]);

    $slider = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$slider) {
        throw new Exception('Slider not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    $newStatus = ($slider['status'] === 'active')
        ? 'inactive'
        : 'active';

    $statement = $pdo->prepare("
        UPDATE sliders
        SET status = ?
        WHERE id = ?
    ");

    $statement->execute([
        $newStatus,
        $id
    ]);

    echo json_encode([

        'success' => true,
        'status'  => $newStatus,
        'message' => 'Slider status updated successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,
        'message' => $exception->getMessage()

    ]);

}
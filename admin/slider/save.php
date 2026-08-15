<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../core/Database.php';

header('Content-Type: application/json');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid Request.');
    }

    if (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {
        throw new Exception('Please select an image.');
    }

    /*
    |--------------------------------------------------------------------------
    | Validate Extension
    |--------------------------------------------------------------------------
    */

    $extension = strtolower(
        pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)
    );

    $allowed = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    if (!in_array($extension, $allowed, true)) {
        throw new Exception(
            'Only JPG, JPEG, PNG and WEBP images are allowed.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Validate Size
    |--------------------------------------------------------------------------
    */

    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        throw new Exception(
            'Maximum upload size is 5 MB.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Directory
    |--------------------------------------------------------------------------
    */

    $uploadDirectory = __DIR__ . '/../../uploads/slider/';

    if (!is_dir($uploadDirectory)) {

        if (!mkdir($uploadDirectory, 0755, true)) {
            throw new Exception(
                'Unable to create upload directory.'
            );
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Generate Random Filename
    |--------------------------------------------------------------------------
    */

    $filename = bin2hex(random_bytes(16)) . '.' . $extension;

    $destination = $uploadDirectory . $filename;

    if (!move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $destination
    )) {

        throw new Exception(
            'Image upload failed.'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */

    $database = new Database();

    $pdo = $database->connection();

    $statement = $pdo->prepare("
        INSERT INTO sliders
        (
            title,
            subtitle,
            button_text,
            button_link,
            image,
            sort_order,
            status
        )
        VALUES
        (
            ?,?,?,?,?,?,?
        )
    ");

    $statement->execute([

        trim($_POST['title'] ?? ''),

        trim($_POST['subtitle'] ?? ''),

        trim($_POST['button_text'] ?? ''),

        trim($_POST['button_link'] ?? ''),

        $filename,

        (int)($_POST['sort_order'] ?? 1),

        $_POST['status'] ?? 'active'

    ]);

    echo json_encode([

        'success' => true,

        'message' => 'Hero Slider Added Successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
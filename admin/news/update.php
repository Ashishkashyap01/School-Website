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

    $title = trim($_POST['title'] ?? '');
    $shortDescription = trim($_POST['short_description'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $publishDate = trim($_POST['publish_date'] ?? '');
    $featured = $_POST['featured'] ?? 'no';
    $sortOrder = (int)($_POST['sort_order'] ?? 1);
    $status = $_POST['status'] ?? 'active';

    $oldImage = trim($_POST['old_image'] ?? '');

    if ($title === '') {
        throw new Exception('Please enter news title.');
    }

    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    $imageName = $oldImage;

    /*
    |--------------------------------------------------------------------------
    | Upload New Image (Optional)
    |--------------------------------------------------------------------------
    */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === UPLOAD_ERR_OK
    ) {

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

        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            throw new Exception(
                'Maximum upload size is 5 MB.'
            );
        }

        if (!getimagesize($_FILES['image']['tmp_name'])) {
            throw new Exception(
                'Invalid image.'
            );
        }

        $uploadDirectory = __DIR__ . '/../../uploads/news/';

        if (!is_dir($uploadDirectory)) {

            mkdir($uploadDirectory, 0755, true);

        }

        $imageName = bin2hex(random_bytes(16)) . '.' . $extension;

        $destination = $uploadDirectory . $imageName;

        if (
            !move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $destination
            )
        ) {

            throw new Exception(
                'Image upload failed.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Delete Old Image
        |--------------------------------------------------------------------------
        */

        if (!empty($oldImage)) {

            $oldFile = $uploadDirectory . $oldImage;

            if (is_file($oldFile)) {

                unlink($oldFile);

            }

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Update Database
    |--------------------------------------------------------------------------
    */

    $database = new Database();

    $pdo = $database->connection();

    $statement = $pdo->prepare("
        UPDATE news
        SET
            title=?,
            slug=?,
            short_description=?,
            description=?,
            image=?,
            publish_date=?,
            featured=?,
            sort_order=?,
            status=?
        WHERE id=?
    ");

    $statement->execute([

        $title,
        $slug,
        $shortDescription,
        $description,
        $imageName,
        $publishDate,
        $featured,
        $sortOrder,
        $status,
        $id

    ]);

    echo json_encode([

        'success' => true,

        'message' => 'News updated successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
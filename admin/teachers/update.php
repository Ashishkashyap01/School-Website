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

    $name = trim($_POST['name'] ?? '');
    $designation = trim($_POST['designation'] ?? '');
    $qualification = trim($_POST['qualification'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $sortOrder = (int)($_POST['sort_order'] ?? 1);
    $status = trim($_POST['status'] ?? 'active');

    $oldImage = trim($_POST['old_image'] ?? '');

    if ($name === '') {
        throw new Exception('Teacher name is required.');
    }

    if ($designation === '') {
        throw new Exception('Designation is required.');
    }

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

        $uploadDirectory = __DIR__ . '/../../uploads/teachers/';

        $imageName =
            bin2hex(random_bytes(16))
            . '.'
            . $extension;

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
        UPDATE teachers
        SET
            name=?,
            designation=?,
            qualification=?,
            experience=?,
            image=?,
            bio=?,
            email=?,
            phone=?,
            sort_order=?,
            status=?
        WHERE id=?
    ");

    $statement->execute([

        $name,
        $designation,
        $qualification,
        $experience,
        $imageName,
        $bio,
        $email,
        $phone,
        $sortOrder,
        $status,
        $id

    ]);

    echo json_encode([

        'success' => true,

        'message' => 'Teacher updated successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
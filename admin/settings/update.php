<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../core/Database.php';

header('Content-Type: application/json');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        throw new Exception('Invalid Request.');

    }

    $database = new Database();

    $pdo = $database->connection();

    /*
    |--------------------------------------------------------------------------
    | Get Existing Settings
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->query("
        SELECT logo, favicon
        FROM settings
        WHERE id = 1
        LIMIT 1
    ");

    $settings = $statement->fetch();

    if (!$settings) {

        throw new Exception('Settings not found.');

    }

    $logo = $settings['logo'];

    $favicon = $settings['favicon'];

    $uploadDirectory = __DIR__ . '/../../uploads/settings/';

    if (!is_dir($uploadDirectory)) {

        if (!mkdir($uploadDirectory, 0755, true)) {

            throw new Exception(
                'Unable to create upload directory.'
            );

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Upload Logo
    |--------------------------------------------------------------------------
    */

    if (

        isset($_FILES['logo']) &&
        $_FILES['logo']['error'] === UPLOAD_ERR_OK

    ) {

        $extension = strtolower(

            pathinfo(

                $_FILES['logo']['name'],

                PATHINFO_EXTENSION

            )

        );

        $allowed = [

            'jpg',
            'jpeg',
            'png',
            'webp',
            'svg'

        ];

        if (!in_array($extension, $allowed, true)) {

            throw new Exception(

                'Invalid logo format.'

            );

        }

        $logoName =

            bin2hex(random_bytes(16))

            . '.'

            . $extension;

        $destination =

            $uploadDirectory

            . $logoName;

        if (

            !move_uploaded_file(

                $_FILES['logo']['tmp_name'],

                $destination

            )

        ) {

            throw new Exception(

                'Logo upload failed.'

            );

        }

        if (

            !empty($logo)

            &&

            is_file(

                $uploadDirectory . $logo

            )

        ) {

            unlink(

                $uploadDirectory . $logo

            );

        }

        $logo = $logoName;

    }

    /*
    |--------------------------------------------------------------------------
    | Upload Favicon
    |--------------------------------------------------------------------------
    */

    if (

        isset($_FILES['favicon']) &&
        $_FILES['favicon']['error'] === UPLOAD_ERR_OK

    ) {

        $extension = strtolower(

            pathinfo(

                $_FILES['favicon']['name'],

                PATHINFO_EXTENSION

            )

        );

        $allowed = [

            'ico',
            'png',
            'jpg',
            'jpeg',
            'webp'

        ];

        if (!in_array($extension, $allowed, true)) {

            throw new Exception(

                'Invalid favicon format.'

            );

        }

        $faviconName =

            bin2hex(random_bytes(16))

            . '.'

            . $extension;

        $destination =

            $uploadDirectory

            . $faviconName;

        if (

            !move_uploaded_file(

                $_FILES['favicon']['tmp_name'],

                $destination

            )

        ) {

            throw new Exception(

                'Favicon upload failed.'

            );

        }

        if (

            !empty($favicon)

            &&

            is_file(

                $uploadDirectory . $favicon

            )

        ) {

            unlink(

                $uploadDirectory . $favicon

            );

        }

        $favicon = $faviconName;

    }
        /*
    |--------------------------------------------------------------------------
    | Update Database
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        UPDATE settings
        SET
            school_name = ?,
            tagline = ?,
            email = ?,
            phone = ?,
            address = ?,
            facebook = ?,
            instagram = ?,
            youtube = ?,
            twitter = ?,
            theme_color = ?,
            logo = ?,
            favicon = ?
        WHERE id = 1
    ");

    $statement->execute([

        trim($_POST['school_name'] ?? ''),
        trim($_POST['tagline'] ?? ''),
        trim($_POST['email'] ?? ''),
        trim($_POST['phone'] ?? ''),
        trim($_POST['address'] ?? ''),
        trim($_POST['facebook'] ?? ''),
        trim($_POST['instagram'] ?? ''),
        trim($_POST['youtube'] ?? ''),
        trim($_POST['twitter'] ?? ''),
        trim($_POST['theme_color'] ?? '#7B1113'),

        $logo,
        $favicon

    ]);

    echo json_encode([

        'success' => true,

        'message' => 'Website settings updated successfully.'

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Mail.php';

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
    | Collect Form Data
    |--------------------------------------------------------------------------
    */

    $studentName = trim($_POST['student_name'] ?? '');
    $parentName = trim($_POST['parent_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $applyingClass = trim($_POST['applying_class'] ?? '');
    $message = trim($_POST['message'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if ($studentName === '') {

        throw new Exception('Please enter student name.');

    }

    if ($parentName === '') {

        throw new Exception('Please enter parent name.');

    }

    if ($phone === '') {

        throw new Exception('Please enter mobile number.');

    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {

        throw new Exception('Please enter valid 10 digit mobile number.');

    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        throw new Exception('Please enter valid email.');

    }

    if ($applyingClass === '') {

        throw new Exception('Please select class.');

    }

    /*
    |--------------------------------------------------------------------------
    | Generate Enquiry ID
    |--------------------------------------------------------------------------
    */

    $database = new Database();

    $pdo = $database->connection();

    $count = (int)$pdo
        ->query("SELECT COUNT(*) FROM enquiries")
        ->fetchColumn();

    $enquiryId =
        'ADM' .
        date('Ymd') .
        str_pad((string)($count + 1), 4, '0', STR_PAD_LEFT);

    /*
    |--------------------------------------------------------------------------
    | Save Enquiry
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        INSERT INTO enquiries
        (
            enquiry_id,
            student_name,
            parent_name,
            phone,
            email,
            applying_class,
            message,
            status
        )
        VALUES
        (
            ?,?,?,?,?,?,?,?
        )
    ");

    $statement->execute([

        $enquiryId,

        $studentName,

        $parentName,

        $phone,

        $email,

        $applyingClass,

        $message,

        'new'

    ]);

    /*
    |--------------------------------------------------------------------------
    | Send Mail
    |--------------------------------------------------------------------------
    */

    $mail = new Mail();

    $mailData = [

        'enquiry_id' => $enquiryId,

        'student_name' => $studentName,

        'parent_name' => $parentName,

        'phone' => $phone,

        'email' => $email,

        'applying_class' => $applyingClass,

        'message' => $message

    ];

    $mail->sendAdmissionEnquiry($mailData);

    if (!empty($email)) {

        $mail->sendAdmissionAcknowledgement($mailData);

    }

    /*
    |--------------------------------------------------------------------------
    | Success Response
    |--------------------------------------------------------------------------
    */

    echo json_encode([

        'success' => true,

        'message' => 'Admission enquiry submitted successfully.',

        'enquiry_id' => $enquiryId

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
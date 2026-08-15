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

    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $class = trim($_POST['class'] ?? '');
    $contactMethod = trim($_POST['contact_method'] ?? '');
    $message = trim($_POST['message'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if ($name === '') {
        throw new Exception('Please enter your full name.');
    }

    if ($phone === '') {
        throw new Exception('Please enter your phone number.');
    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        throw new Exception('Please enter a valid 10 digit mobile number.');
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Please enter a valid email address.');
    }

    if ($subject === '') {
        throw new Exception('Please select a subject.');
    }

    if ($contactMethod === '') {
        throw new Exception('Please select preferred contact method.');
    }

    if ($message === '') {
        throw new Exception('Please enter your message.');
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Inquiry ID
    |--------------------------------------------------------------------------
    */

    $database = new Database();

    $pdo = $database->connection();

    $count = (int)$pdo->query(
        "SELECT COUNT(*) FROM contact_inquiries"
    )->fetchColumn();

    $inquiryId =
        'SRS' .
        date('Ymd') .
        str_pad((string)($count + 1), 4, '0', STR_PAD_LEFT);

    /*
    |--------------------------------------------------------------------------
    | Save Inquiry
    |--------------------------------------------------------------------------
    */

    $statement = $pdo->prepare("
        INSERT INTO contact_inquiries
        (
            inquiry_id,
            name,
            phone,
            email,
            subject,
            class,
            contact_method,
            message,
            ip_address
        )
        VALUES
        (
            ?,?,?,?,?,?,?,?,?
        )
    ");

    $statement->execute([

    

        $inquiryId,

        $name,

        $phone,

        $email,

        $subject,

        $class,

        $contactMethod,

        $message,

        $_SERVER['REMOTE_ADDR'] ?? ''

    ]);
$mail = new Mail();

$mail->sendContactEnquiry([
    'inquiry_id'     => $inquiryId,
    'name'           => $name,
    'phone'          => $phone,
    'email'          => $email,
    'subject'        => $subject,
    'class'          => $class,
    'contact_method' => $contactMethod,
    'message'        => $message
]);

if (!empty($email)) {

    $mail->sendAcknowledgement([

        'inquiry_id' => $inquiryId,

        'name' => $name,

        'email' => $email,

        'subject' => $subject

    ]);

}

    /*
    |--------------------------------------------------------------------------
    | Success Response
    |--------------------------------------------------------------------------
    */

    echo json_encode([

        'success' => true,

        'message' => 'Your enquiry has been submitted successfully.',

        'inquiry_id' => $inquiryId

    ]);

} catch (Throwable $exception) {

    http_response_code(400);

    echo json_encode([

        'success' => false,

        'message' => $exception->getMessage()

    ]);

}
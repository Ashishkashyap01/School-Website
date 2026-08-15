<?php

declare(strict_types=1);



session_start();





if (isset($_SESSION['admin'])) {

    header('Location: /srs/admin/dashboard');

    exit;

}



require_once __DIR__ . '/../../core/Database.php';



require_once __DIR__ . '/../../core/Mail.php';







/*

|--------------------------------------------------------------------------

| Helper Functions

|--------------------------------------------------------------------------

*/



function maskEmail(string $email): string

{

    [$name, $domain] = explode('@', $email);



    if (strlen($name) <= 4) {



        $masked = substr($name, 0, 1) . '***';



    } else {



        $masked =

            substr($name, 0, 3) .

            str_repeat('*', strlen($name) - 5) .

            substr($name, -2);



    }



    return $masked . '@' . $domain;

}



$error = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $email = trim($_POST['email'] ?? '');

    $password = $_POST['password'] ?? '';



    if ($email === '' || $password === '') {



        $error = 'Please enter your email and password.';



    } else {



        try {



            $database = new Database();

            $pdo = $database->connection();



            $sql = "

                SELECT

                    u.*,

                    r.name AS role_name

                FROM users u

                INNER JOIN roles r

                    ON r.id = u.role_id

                WHERE u.email = ?

                LIMIT 1

            ";



            $statement = $pdo->prepare($sql);

            $statement->execute([$email]);



            $user = $statement->fetch();



            if (

                $user &&

                $user['status'] === 'active' &&

                password_verify($password, $user['password'])

            ) {





/*

|--------------------------------------------------------------------------

| TODO : OTP Login

| Enable after verify-otp module is completed.

|--------------------------------------------------------------------------

*/







/*

                session_regenerate_id(true);



                $_SESSION['admin'] = [



                    'id'    => $user['id'],

                    'name'  => $user['full_name'],

                    'email' => $user['email'],

                    'role'  => $user['role_name'],

                    'image' => $user['profile_image']



                ];



                $update = $pdo->prepare("

                    UPDATE users

                    SET last_login = NOW()

                    WHERE id = ?

                ");



                $update->execute([$user['id']]);



            header('Location: /admin/dashboard');

            exit;

            */



            $otp = random_int(100000, 999999);



            $_SESSION['pending_admin'] = [



                'id'    => $user['id'],

                'name'  => $user['full_name'],

                'email' => $user['email'],

                'role'  => $user['role_name'],

                'image' => $user['profile_image']



            ];



            $_SESSION['login_otp'] = $otp;



            $_SESSION['login_otp_expiry'] = time() + 300;



            $_SESSION['login_otp_attempts'] = 0;



            $mail = new Mail();



            if (!$mail->sendLoginOTP([

                'name'  => $user['full_name'],

                'email' => $user['email'],

                'otp'   => $otp

            ])) {

            throw new Exception('Unable to send OTP. Please try again.');

            }



header('Location: /srs/admin/auth/login.php');

exit;

/*

|--------------------------------------------------------------------------

| TODO : Send Login OTP Email

|--------------------------------------------------------------------------

*/



 }



            $error = 'Invalid Email or Password.';



        } catch (Throwable $e) {



            $error = 'Database Error : ' . $e->getMessage();



        }



    }



}

/*

|--------------------------------------------------------------------------

| VERIFY OTP

|--------------------------------------------------------------------------

*/



if (

    $_SERVER['REQUEST_METHOD'] === 'POST' &&

    isset($_POST['verify_otp'])

) {



    $otp = trim($_POST['otp'] ?? '');



    if (!isset($_SESSION['pending_admin'])) {



        $error = 'Your session has expired. Please login again.';



    }



    elseif (time() > $_SESSION['login_otp_expiry']) {



        unset($_SESSION['pending_admin']);

        unset($_SESSION['login_otp']);

        unset($_SESSION['login_otp_expiry']);

        unset($_SESSION['login_otp_attempts']);



        $error = 'OTP has expired. Please login again.';



    }



    elseif ($_SESSION['login_otp_attempts'] >= 3) {



        unset($_SESSION['pending_admin']);

        unset($_SESSION['login_otp']);

        unset($_SESSION['login_otp_expiry']);

        unset($_SESSION['login_otp_attempts']);



        $error = 'Too many invalid attempts. Please login again.';



    }



    elseif ($otp != $_SESSION['login_otp']) {



        $_SESSION['login_otp_attempts']++;



        $error = 'Invalid OTP.';



    }



    else {



        session_regenerate_id(true);



        $_SESSION['admin'] = $_SESSION['pending_admin'];



        $database = new Database();



        $pdo = $database->connection();



        $update = $pdo->prepare("

            UPDATE users

            SET last_login = NOW()

            WHERE id = ?

        ");



        $update->execute([



            $_SESSION['admin']['id']



        ]);



        unset($_SESSION['pending_admin']);

        unset($_SESSION['login_otp']);

        unset($_SESSION['login_otp_expiry']);

        unset($_SESSION['login_otp_attempts']);



        header("Location: /srs/admin/dashboard");



        exit;



    }



}

?>

<!DOCTYPE html>

<html lang="en">



<head>



<meta charset="UTF-8">



<meta

name="viewport"

content="width=device-width, initial-scale=1.0">



<title>Admin Login | Sone Rising School</title>

<link

rel="icon"

type="image/png"

href="/srs/assets/images/logo.png">



<link

rel="stylesheet"

href="/srs/admin/assets/css/admin.css">

<link rel="stylesheet" href="/srs/admin/assets/css/login.css">



</head>



<body>



<div class="login-wrapper">



    <div class="login-card">



        <img

        src="/srs/assets/images/logo.png"

        alt="Logo"

        class="login-logo">



       <h2 id="loginTitle">



<?php if(isset($_SESSION['pending_admin'])): ?>



    Verify Your Identity

    



<?php else: ?>



    Admin Login



<?php endif; ?>



</h2>



<p id="loginSubtitle">

<?php if(isset($_SESSION['pending_admin'])): ?>

    Enter the verification code sent to your email.

<?php else: ?>

    Sone Rising School CMS

<?php endif; ?>

</p>



<div

id="loginForm"

class="<?= isset($_SESSION['pending_admin']) ? 'hide-card' : 'show-card'; ?>">



<form id="loginFormElement" method="POST" autocomplete="off">



    <input

    type="email"

    name="email"

    placeholder="Email Address"

    value="<?= htmlspecialchars($email ?? '') ?>"

    required>



     <div class="password-wrapper">

    <input
        type="password"
        id="password"
        name="password"
        placeholder="Password"
        required>
    <span id="togglePassword" class="password-eye">
        👁
    </span>

    <button
type="submit"
name="login">
    Login
</button>


</form>



</div>





<div

id="otpForm"

class="<?= isset($_SESSION['pending_admin']) ? 'show-card' : 'hide-card'; ?>">



<p>



Verification code sent to



<strong>



<?= isset($_SESSION['pending_admin'])

    ? maskEmail($_SESSION['pending_admin']['email'])

    : ''; ?>



</strong>



</p>





<div class="otp-timer">



    OTP expires in



    <span id="otpTimer">



        05:00



    </span>



</div>



<form method="POST">



<div class="otp-wrapper">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric"

    autocomplete="one-time-code">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric">



    <input 

    type="text"

    maxlength="1"

    class="otp-box"

    inputmode="numeric">



</div>





<input

type="hidden"

name="otp"

id="otpValue">





<button

type="submit"

name="verify_otp">



Verify OTP



</button>



</form>

</div>



    </div>



</div>



</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/srs/admin/assets/js/login.js"></script>

</html>
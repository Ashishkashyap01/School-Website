<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../app/Libraries/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../app/Libraries/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../app/Libraries/PHPMailer/src/SMTP.php';

class Mail
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/mail.php';
    }

    public function sendContactEnquiry(array $data): bool
    {
        $mail = new PHPMailer(true);

        try {

            /*
            |--------------------------------------------------------------------------
            | SMTP Configuration
            |--------------------------------------------------------------------------
            */

            $mail->isSMTP();

            $mail->Host = $this->config['host'];

            $mail->SMTPAuth = true;

            $mail->Username = $this->config['username'];

            $mail->Password = $this->config['password'];

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = $this->config['port'];

            /*
            |--------------------------------------------------------------------------
            | Sender
            |--------------------------------------------------------------------------
            */

            $mail->setFrom(

                $this->config['from_email'],

                $this->config['from_name']

            );

            /*
            |--------------------------------------------------------------------------
            | Receiver
            |--------------------------------------------------------------------------
            */

            $mail->addAddress(

                $this->config['admin_email']

            );

            /*
            |--------------------------------------------------------------------------
            | Reply To
            |--------------------------------------------------------------------------
            */

            if (!empty($data['email'])) {

                $mail->addReplyTo(

                    $data['email'],

                    $data['name']

                );

            }

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            $mail->isHTML(true);

            $mail->Subject =
                'New Contact Enquiry | Sone Rising School' .
                $data['inquiry_id'];


            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset="UTF-8">
            </head>

            <body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:30px 0;">

            <tr>

            <td align="center">

            <table width="700" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.08);">

            <tr>

            <td style="background:#7b1e1e;padding:30px;text-align:center;color:#fff;">

            <h1 style="margin:0;font-size:30px;">
            🏫 Sone Rising School
            </h1>

            <p style="margin-top:8px;font-size:15px;">
            A New Contact Enquiry Has Been Received
            </p>

            </td>

            </tr>

            <tr>

            <td style="padding:35px;">

            <p style="font-size:16px;">
            Hello <strong>Sone Rising School Team</strong>,
            </p>

            <p style="font-size:15px;color:#555;line-height:26px;">

            A new enquiry has been submitted through the
            <strong>School Website Contact Form.</strong>

            Please review the details below and contact the parent/student as soon as possible.

            </p>

            <table width="100%" cellpadding="10" cellspacing="0"
            style="border-collapse:collapse;border:1px solid #e5e5e5;margin-top:25px;">

            <tr style="background:#f8f8f8;">
            <th align="left">Inquiry ID</th>
            <td>'.$data['inquiry_id'].'</td>
            </tr>

            <tr>
            <th align="left">Name</th>
            <td>'.$data['name'].'</td>
            </tr>

            <tr style="background:#f8f8f8;">
            <th align="left">Phone</th>
            <td>'.$data['phone'].'</td>
            </tr>

            <tr>
            <th align="left">Email</th>
            <td>'.$data['email'].'</td>
            </tr>

            <tr style="background:#f8f8f8;">
            <th align="left">Subject</th>
            <td>'.$data['subject'].'</td>
            </tr>

            <tr>
            <th align="left">Class</th>
            <td>'.$data['class'].'</td>
            </tr>

            <tr style="background:#f8f8f8;">
            <th align="left">Preferred Contact</th>
            <td>'.$data['contact_method'].'</td>
            </tr>

            <tr>
            <th align="left">Message</th>
            <td>'.nl2br(htmlspecialchars($data['message'])).'</td>
            </tr>

            </table>

            <div style="margin-top:35px;background:#fff8e6;border-left:5px solid #ffc107;padding:20px;">

            <strong>Action Required</strong>

            <p style="margin-top:10px;color:#555;line-height:24px;">

            Please contact the applicant using the preferred contact method at the earliest.

            </p>

            </div>

            <p style="margin-top:35px;font-size:15px;">

            Regards,<br>

            <strong>Sone Rising School Website</strong>

            </p>

            </td>

            </tr>

            <tr>

            <td style="background:#2d2d2d;color:#ddd;text-align:center;padding:20px;font-size:13px;">

            © '.date('Y').' Sone Rising School<br>

            This is an automated email generated from the official website.

            </td>

            </tr>

            </table>

            </td>

            </tr>

            </table>

            </body>

            </html>
            ';
            $mail->send();

            return true;

        } catch (Exception $exception) {

            return false;

        }

    }



    
    public function sendAcknowledgement(array $data): bool
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host = $this->config['host'];

        $mail->SMTPAuth = true;

        $mail->Username = $this->config['username'];

        $mail->Password = $this->config['password'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = $this->config['port'];

        $mail->setFrom(
            $this->config['from_email'],
            $this->config['from_name']
        );

        $mail->addAddress(
            $data['email'],
            $data['name']
        );

        $mail->isHTML(true);

        $mail->Subject =
        'Thank You for Contacting Sone Rising School';

        $mail->Body='

<!DOCTYPE html>

<html>

<body style="margin:0;background:#f5f5f5;
font-family:Arial,sans-serif;">

<table width="100%" cellpadding="30">

<tr>

<td align="center">

<table width="700"
style="background:#fff;
border-radius:12px;
overflow:hidden;">

<tr>

<td
style="background:#8B0000;
color:#fff;
padding:30px;
text-align:center;">

<h1 style="margin:0;">
🏫 Sone Rising School
</h1>

<p>

Thank You For Contacting Us

</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>

Hello '.$data['name'].',

</h2>

<p
style="font-size:16px;
line-height:28px;">

Thank you for contacting

<b>Sone Rising School.</b>

<br><br>

We have successfully received your enquiry.

<br><br>

Our Admissions Team will review your request
and contact you shortly.

</p>

<table
width="100%"
cellpadding="10"
style="
margin-top:25px;
border-collapse:collapse;
">

<tr>

<td><b>Inquiry ID</b></td>

<td>'.$data['inquiry_id'].'</td>

</tr>

<tr>

<td><b>Subject</b></td>

<td>'.$data['subject'].'</td>

</tr>

</table>

<div
style="
margin-top:30px;
padding:20px;
background:#f9f9f9;
border-left:5px solid #8B0000;
">

<b>Need Assistance?</b>

<br><br>

☎ <a href="tel:+919308002335"
style="color:#333;text-decoration:none;font-weight:bold;">
+91-9308002335
</a>

<br><br>

📧 <a href="mailto:srsdehri2011@gmail.com"
style="color:#0d6efd;text-decoration:none;">
srsdehri2011@gmail.com
</a>

<br><br>

🌐 <a href="https://sonerisingschool.com"
target="_blank"
style="color:#0d6efd;text-decoration:none;">
https://sonerisingschool.com
</a>

</div>

<p
style="
margin-top:30px;
line-height:28px;
">

Thank you for choosing
<b>Sone Rising School.</b>

<br><br>

We look forward to welcoming you.

</p>

<p>

Warm Regards,

<br><br>

<b>Admissions Team</b>

<br>

Sone Rising School

</p>

</td>

</tr>

<tr>

<td
style="
background:#2b2b2b;
color:#fff;
text-align:center;
padding:20px;
font-size:13px;
">

© '.date('Y').'

Sone Rising School

<br><br>

This is an automated email.

Please do not reply.

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>

';

        $mail->send();

        return true;

    }

    catch(Exception $exception){

        return false;

    }

}




/*mail Admission*/

public function sendAdmissionEnquiry(array $data): bool
{
    $mail = new PHPMailer(true);

    try {

        /*
        |--------------------------------------------------------------------------
        | SMTP Configuration
        |--------------------------------------------------------------------------
        */

        $mail->isSMTP();

        $mail->Host = $this->config['host'];

        $mail->SMTPAuth = true;

        $mail->Username = $this->config['username'];

        $mail->Password = $this->config['password'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = $this->config['port'];

        /*
        |--------------------------------------------------------------------------
        | Sender
        |--------------------------------------------------------------------------
        */

        $mail->setFrom(
            $this->config['from_email'],
            $this->config['from_name']
        );

        /*
        |--------------------------------------------------------------------------
        | Receiver
        |--------------------------------------------------------------------------
        */

        $mail->addAddress(
            $this->config['admin_email']
        );

        /*
        |--------------------------------------------------------------------------
        | Reply To
        |--------------------------------------------------------------------------
        */

        if (!empty($data['email'])) {

            $mail->addReplyTo(
                $data['email'],
                $data['parent_name']
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Content
        |--------------------------------------------------------------------------
        */

        $mail->isHTML(true);

        $mail->Subject =
            'New Admission Enquiry | ' .
            $data['enquiry_id'];

        $mail->Body = '

<!DOCTYPE html>

<html>

<body style="margin:0;background:#f5f5f5;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="30">

<tr>

<td align="center">

<table width="700"
style="background:#fff;border-radius:12px;overflow:hidden;">

<tr>

<td
style="background:#8B0000;
color:#fff;
padding:30px;
text-align:center;">

<h1 style="margin:0;">
🎓 Admission Enquiry
</h1>

<p style="margin-top:10px;">
Sone Rising School
</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<p>

A new admission enquiry has been received.

</p>

<table
width="100%"
cellpadding="10"
style="border-collapse:collapse;margin-top:20px;">

<tr>

<td><b>Enquiry ID</b></td>

<td>'.$data['enquiry_id'].'</td>

</tr>

<tr>

<td><b>Student Name</b></td>

<td>'.$data['student_name'].'</td>

</tr>

<tr>

<td><b>Parent Name</b></td>

<td>'.$data['parent_name'].'</td>

</tr>

<tr>

<td><b>Phone</b></td>

<td>'.$data['phone'].'</td>

</tr>

<tr>

<td><b>Email</b></td>

<td>'.$data['email'].'</td>

</tr>

<tr>

<td><b>Applying Class</b></td>

<td>'.$data['applying_class'].'</td>

</tr>

<tr>

<td><b>Message</b></td>

<td>'.nl2br(htmlspecialchars($data['message'])).'</td>

</tr>

</table>

<p style="margin-top:30px;">

Please contact the parent as soon as possible.

</p>

</td>

</tr>

<tr>

<td
style="
background:#2d2d2d;
color:#fff;
text-align:center;
padding:20px;">

© '.date('Y').' Sone Rising School

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>

';

        $mail->send();

        return true;

    }

    catch(Exception $exception){

        return false;

    }

}

public function sendAdmissionAcknowledgement(array $data): bool
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host = $this->config['host'];

        $mail->SMTPAuth = true;

        $mail->Username = $this->config['username'];

        $mail->Password = $this->config['password'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = $this->config['port'];

        $mail->setFrom(
            $this->config['from_email'],
            $this->config['from_name']
        );

        $mail->addAddress(
            $data['email'],
            $data['parent_name']
        );

        $mail->isHTML(true);

        $mail->Subject =
            'Thank You for Your Admission Enquiry';

        $mail->Body='

<!DOCTYPE html>

<html>

<body style="margin:0;background:#f5f5f5;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="30">

<tr>

<td align="center">

<table width="700"
style="background:#fff;border-radius:12px;overflow:hidden;">

<tr>

<td
style="background:#8B0000;
color:#fff;
padding:30px;
text-align:center;">

<h1 style="margin:0;">
🎓 Sone Rising School
</h1>

<p>

Admission Enquiry Received

</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>

Dear '.$data['parent_name'].',

</h2>

<p
style="
font-size:16px;
line-height:28px;
">

Thank you for submitting your
<b>Admission Enquiry</b>.

<br><br>

We have successfully received your request.

<br><br>

Our Admissions Team will contact you shortly
to guide you through the admission process.

</p>

<table
width="100%"
cellpadding="10"
style="
margin-top:25px;
border-collapse:collapse;
">

<tr>

<td><b>Enquiry ID</b></td>

<td>'.$data['enquiry_id'].'</td>

</tr>

<tr>

<td><b>Student Name</b></td>

<td>'.$data['student_name'].'</td>

</tr>

<tr>

<td><b>Applying Class</b></td>

<td>'.$data['applying_class'].'</td>

</tr>

</table>

<div
style="
margin-top:30px;
padding:20px;
background:#f9f9f9;
border-left:5px solid #8B0000;
">

<b>Need Assistance?</b>

<br><br>

☎ +91-9308002335

<br><br>

📧 srsdehri2011@gmail.com


🌐 <a href="https://sonerisingschool.com"
target="_blank"
style="color:#0d6efd;text-decoration:none;">
https://sonerisingschool.com
</a>


</div>

<p
style="
margin-top:30px;
line-height:28px;
">

Thank you for choosing

<b>Sone Rising School.</b>

<br><br>

We look forward to welcoming your child.

</p>

<p>

Warm Regards,

<br><br>

<b>Admissions Team</b>

<br>

Sone Rising School

</p>

</td>

</tr>

<tr>

<td
style="
background:#2b2b2b;
color:#fff;
text-align:center;
padding:20px;
font-size:13px;
">

© '.date('Y').' Sone Rising School

<br><br>

This is an automated email.

Please do not reply.

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>

';

        $mail->send();

        return true;

    }

    catch(Exception $exception){

        return false;

    }

}


/*------------------------------------------------otp------------------------------------------------------*/



public function sendLoginOTP(array $data): bool
{
    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();

        $mail->Host = $this->config['host'];

        $mail->SMTPAuth = true;

        $mail->Username = $this->config['username'];

        $mail->Password = $this->config['password'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = $this->config['port'];

        $mail->setFrom(
            $this->config['from_email'],
            $this->config['from_name']
        );

        $mail->addAddress(
            $data['email'],
            $data['name']
        );

        $mail->isHTML(true);

        $mail->Subject = 'Your Login Verification Code';

        $mail->Body = '

<!DOCTYPE html>

<html>

<body style="margin:0;background:#f5f5f5;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="30">

<tr>

<td align="center">

<table width="650"
style="background:#ffffff;border-radius:12px;overflow:hidden;">

<tr>

<td
style="
background:#8B0000;
padding:30px;
text-align:center;
color:#ffffff;
">

<h1 style="margin:0;">
🔐 Admin Login Verification
</h1>

</td>

</tr>

<tr>

<td style="padding:40px;">

<h2>

Hello '.$data['name'].',

</h2>

<p style="font-size:16px;line-height:28px;">

A login attempt was made to the

<strong>Sone Rising School CMS.</strong>

</p>

<p>

Use the following One-Time Password (OTP):

</p>

<div
style="
font-size:42px;
font-weight:bold;
letter-spacing:10px;
text-align:center;
padding:25px;
background:#f8f8f8;
border:2px dashed #8B0000;
border-radius:10px;
margin:25px 0;
">

'.$data['otp'].'

</div>

<p>

This OTP is valid for

<strong>5 Minutes.</strong>

</p>

<p>

If you did not request this login,

please ignore this email immediately.

</p>

</td>

</tr>

<tr>

<td
style="
background:#2d2d2d;
color:#ffffff;
padding:20px;
text-align:center;
">

© '.date('Y').' Sone Rising School

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>';

        $mail->send();

        return true;

    }

    catch(Exception $e){

        return false;

    }
}


}

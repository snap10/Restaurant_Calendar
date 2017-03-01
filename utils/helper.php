<?php
require('utils/phpmailer/class.phpmailer.php');
require('utils/phpmailer/class.smtp.php');
/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 10.02.16
 * Time: 14:38
 */
class Helper
{


    public static function getUniqueCode()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );

    }


    public static function mailto($receiver,$subject, $body, $plainbody){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host     = 'mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '18023c88eb7012';
        $mail->Password = 'f3c6c8681f5250';
        $mail->Port = 2525;

        $mail->setFrom('no-reply@example.com', 'Mailer');
        $mail->addAddress($receiver);               // Name is optional
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $plainbody;

        if(!$mail->send()) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent to '.$receiver;
        }
    }

    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
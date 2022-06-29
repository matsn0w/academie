<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function send_mail($to, $date, $message , $reply)
{

	$mail = new PHPMailer;

	require_once 'config.php';

	$mail->Subject = 'Reactie op je contact verzoek van '.$date;
	$mail->Body    = '
    Dit is een reactie op je contact verzoek:<br />
    <hr><br />
    <div style="background-color: #eee; border: 1px solid #999;display: block; padding: 20px;">
    '.$message.'
    </div><br />
    <hr><br />
    '.$reply;

	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 'fail';
	} else {
		return 'success';
	}
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function send_mail($to)
{

	$mail = new PHPMailer;

	require_once 'config.php';

	$mail->Subject = 'Registratie HoogStad';
	$mail->Body    = '
                                    Hallo,<br />
                                    <br />
                                    Je registatie is succesvol ontvangen. Bedankt!<br />
                                    <br />
                                    Met vriendelijke groet,<br />
                                    HoogStad
                                    ';

	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 'fail';
	} else {
		return 'success';
	}
}
?>

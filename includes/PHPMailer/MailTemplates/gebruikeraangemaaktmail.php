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

	$mail->isHTML(true);

	$mail->Subject = 'Registratie HoogStad';
	$mail->Body    = '
	Hallo,<br />
	<br />
	Er is door een leiding gevende een account aangemaakt op HoogStad. We zullen z.s.m. naar de registratie kijken.<br />
	Wanneer de registratie goed gekeurd word krijgt u een mail met uw inlog gegevens.<br />
	<br />
	Wanneer deze mail niet voor u is bedoelt vragen wij u vriendelijk om deze mail te verwijderen en als niet verstuurd te zien.<br />
Met vriendelijke groet,<br />
HoogStad';

	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 'fail';
	} else {
		return 'success';
	}
}
?>

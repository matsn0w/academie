<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function send_mail($to, $username, $password, $site)
{

	$mail = new PHPMailer;

	require_once 'config.php';

	$mail->Subject = 'Inlog gegevens SyntaxOnline';
	$mail->Body    = '
	Hallo,<br />
	<br />
	Uw aanmelding is bekeken en geaccepteert. U kunt vanaf nu inloggen via de hier onderstaande gegevens.<br />
	<br />
	Inloggen kan via: '.$site.'<br />
	Gebruikersnaam: '.$username.'<br />
	Wachtwoord: '.$password.'<br />
	<br />
	Met vriendelijke groet,<br />
	SyntaxOnline';

	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 'fail';
	} else {
		return 'success';
	}
}
?>

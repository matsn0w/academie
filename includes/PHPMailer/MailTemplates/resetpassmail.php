<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function checkUser($email)
{
	global $db;

	$query = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");

	if(mysqli_num_rows($query) > 0)
	{
		return 'true';
	}else
	{
		return 'false';
	}
}

function UserID($email)
{
	global $db;

	$query = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
	$row = mysqli_fetch_assoc($query);

	return $row['id'];
}

function send_mail($to, $token, $site)
{

	$mail = new PHPMailer;

	require_once 'config.php';

	$mail->Subject = 'HoogStad Wachtwoord Reset';
	$link = $site.'/pages/resetpass.php?email='.$to.'&token='.$token;
	$mail->Body    = "
	Hallo,<br />
	<br />
	Deze mail ontvangt u omdat er voor uw account een wachtwoord reset is aangevraagt.<br />
	<br />
	Klik <a href='$link' target='_blank'>hier</a> om uw wachtwoord te resetten.<br />
	Wanneer het bovenstaande niet werkt kunt u ook naar het onderstaande URL gaan.<br />
	<i>". $link."</i><br />
	<br />
    Wanneer deze mail niet voor u is bedoelt vragen wij u vriendelijk om deze mail te verwijderen en als niet verstuurd te zien.<br />
	Met vriendelijke groet,<br />
	HoogStad";
    
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 'fail';
	} else {
		return 'success';
	}
}

?>

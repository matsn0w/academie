<?php

	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'politie.hoogstad.be';
	$mail->SMTPAuth = true;
	$mail->Username = 'no-reply@politie.hoogstad.be';
	$mail->Password = 'Autobot123*';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;


	$mail->setFrom('no-reply@politie.hoogstad.be', 'HoogStad');
	$mail->addAddress($to);
	$mail->addReplyTo('management@politie.hoogstad.be', 'Reply');

 ?>

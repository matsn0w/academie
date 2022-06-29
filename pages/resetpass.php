<?php

include ('../includes/class.database.php');

$uemail = $_GET['email'];
$token = $_GET['token'];

$userID = UserID($uemail);

function verifytoken($userID, $token)
{
	global $db;

	$query = mysqli_query($db, "SELECT valid FROM recovery_keys WHERE userID = $userID AND token = '$token'");
	$row = mysqli_fetch_assoc($query);

	if(mysqli_num_rows($query) > 0)
	{
		if($row['valid'] == 1)
		{
			return 1;
		}else
		{
			return 0;
		}
	}else
	{
		return 0;
	}

}
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

$verifytoken = verifytoken($userID, $token);




if(isset($_POST['submit']))
{
	$saltselect = $db->query("SELECT salt FROM users WHERE id = $userID");
	$row = $saltselect->fetch_assoc();
	$salt = $row["salt"];
	$new_password = $_POST['new_password'];
	$retype_password = $_POST['retype_password'];

	if($new_password == $retype_password)
	{
		$update_password = $db->query("UPDATE users SET password = '".crypt($_POST['new_password'], $salt)."' WHERE id = $userID");
		if($update_password)
		{
				mysqli_query($db, "UPDATE recovery_keys SET valid = 0 WHERE userID = $userID AND token ='$token'");
				$msg = 'Your password has changed successfully. Please login with your new passowrd. Click <a href="../">here</a> to go back to home.';
				$msgclass = 'bg-success';
		}
	}else
	{
		 $msg = "Password doesn't match";
		 $msgclass = 'bg-danger';
	}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mijn Syntax | Wachtwoord Reset</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

	<?php if(isset($msg)) { ?>
							<div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
					<?php } ?>
<div class="container">
	<div class="row">

	<?php if($verifytoken == 1) { ?>
    	<div class="col-lg-4 col-lg-offset-4">


				<form class="modalreg-content" action="" method="post">

							<div class="containerreg">
									<h1><center>Wachtwoord reset</center> </h1>
								<div class="form-group">
									<label for="new_password">Wachtwoord</label>
									<input type="password" name="new_password" class="form-control" id="new_password" required>
								</div>
								<div class="form-group">
									<label for="retype_password">Herhaal wachtwoord</label>
									<input type="password" name="retype_password" class="form-control" id="retype_password" required>
								</div>
								<div class="clearfix">
									<button type="button" class="cancelbtn"><a href="../">Cancel</a></button>
									<button type="submit" name="submit" class="signupbtn">Verstuur!</button>
								</div>
							</div>
			</form>
		</div>

        <?php }else {?>
	    	<div class="col-lg-4 col-lg-offset-4">
   		       	<h2>Invalid or Broken Token</h2>
	            <p>Opps! The link you have come with is maybe broken or already used. Please make sure that you copied the link correctly or request another token from <a href="../">here</a>.</p>
			</div>
        <?php }?>




	</div>


</div>






















<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
</body>
</html>

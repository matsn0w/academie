<?php
if(isset($_POST['sendContact'])){
    $naam = $db->real_escape_string($_POST['naam']);
    $achternaam = $db->real_escape_string($_POST['achternaam']);
    $email = $db->real_escape_string($_POST['email']);
    $bericht = $db->real_escape_string($_POST['bericht']);

    if(empty($naam)){
        echo 'Je bent vergeten je naam in te vullen!';
    }elseif(empty($achternaam)){
        echo 'Je bent vergeten je achternaam in te vullen!';
    }elseif(empty($email)){
        echo 'Je bent vergeten je email in te vullen!';
    }elseif(empty($bericht)){
        echo 'Je bent vergeten je bericht in te vullen!';
    }else{
        $insertQuery = $db->query("INSERT INTO contact (naam, email, achternaam, bericht, date) VALUES ('".$naam."', '".$email."', '".$achternaam."', '".$bericht."', NOW())");
        if($insertQuery){
            echo 'Je vraag is verzonden!';
        }else{
            echo 'Er ging iets mis! Probeer het later nog eens!';
        }

    }
}
?>
<form method="POST" action="" role="form">
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam:</label>
                    <input type="text" name="naam" class="form-control" id="exampleInputEmail1" />
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Achternaam:</label>
                    <input type="text" name="achternaam" class="form-control" id="exampleInputEmail1" />
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Email:</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" />
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Bericht:</label>
                    <textarea name="bericht" class="form-control"></textarea>
				</div>
				</div>
                <div class="form-group">
                    <input type="submit" class="form-control" style="width:85px" name="sendContact" value="Verzend!">
                </div>
</form>

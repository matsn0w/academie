<?php
if(isset($_POST['sendVakantie'])){
    $naam = $db->real_escape_string($_POST['naam']);
    $achternaam = $db->real_escape_string($_POST['achternaam']);
    $inactief = $db->real_escape_string($_POST['inactief']);
    $actief = $db->real_escape_string($_POST['actief']);
    $reden = $db->real_escape_string($_POST['reden']);

    if(empty($naam)){
        echo 'Je hebt geen naam ingevult!';
    }elseif(empty($achternaam)){
        echo 'Je hebt geen achternaam ingevult!';
    }elseif(empty($inactief)){
        echo 'Je hebt niet wanneer je in-actief bent!';
    }elseif(empty($actief)){
        echo 'Je hebt geen datum ingevult wanneer je actief bent!';
    }elseif(empty($reden)){
        echo 'Je hebt geen reden ingevult!';
    }else{
        $insertQuery = $db->query("INSERT INTO formvakantie (naam,achternaam,inactief,actief,reden,date) VALUES ('".$naam."', '".$achternaam."', '".$inactief."', '".$actief."', '".$reden."', NOW())");

        if($insertQuery){
            echo 'De vakantietijden zijn doorgegeven!';
        }else{
            echo 'Er ging iets mis! Probeer het later nog eens!';
        }

    }
}
?>
<form role="form" method="POST" action="">
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam:</label>
                    <input type="text" name="naam" class="form-control" id="exampleInputEmail1" required/>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Achternaam:</label>
                    <input type="text" name="achternaam" class="form-control" id="exampleInputEmail1" required/>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Inactief vanaf:</label>
                     <input type="date" name="inactief" class="form-control" id="exampleInputEmail1"/>
                </div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Actief vanaf:</label>
                     <input type="date" name="actief" class="form-control" id="exampleInputEmail1"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Reden:</label>
                    <textarea name="reden" class="form-control"></textarea>
				</div>
                <div class="form-group">
                    <input type="submit" class="form-control" style="width:85px" name="sendVakantie" value="Verzend!">
                </div>
</form>

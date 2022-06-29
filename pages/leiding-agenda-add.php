<?php 
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>

<div class="row">
    <div class="col-md-8">
        <br />

        <?php
        if(isset($_POST['save'])){
            $title = $db->real_escape_string($_POST['title']);
            $uidmaker = $userFetch['id'];
            $date = $db->real_escape_string($_POST['date']);
            $url = '';
            $afdeling = $db->real_escape_string($_POST['afdeling']);

            if(empty($title)){
                echo 'Geen titel ingevult!';
            }elseif(empty($date)){
                echo 'Geen datum ingevult!';
            }else{

                $query = $db->query("INSERT INTO agenda (made_uid, title, start, afdeling) VALUES ('".$uidmaker."', '".$title."', '".$date."', '".$afdeling."')");
                if($afdeling != 'leiding' || $afdeling != 'instructeur'){
                    $onderwerp = 'Agenda Item Gemaakt!';
                    $content = '
                    Je leidinggevende heeft een training ingepland! Bekijk snel de agenda!
                    ';
                        $getAfdeling = $db->query("SELECT username, id FROM users WHERE eenheid = '".$afdeling."'");
                        while($fetchAfdeling = $getAfdeling->fetch_array()){
                            $query .= $db->query("INSERT INTO mailbox (uid_from,name_from,uid_to,title,bericht,date,categorie) VALUES (
                                        '0',
                                        'Leidinggevende',
                                        '".$fetchAfdeling['id']."',
                                        '".$onderwerp."',
                                        '".$content."',
                                        NOW(),
                                        '3'
                            )");
                        }
                }
                if($query){
                    echo 'Succesvol aangemaakt!';
                }else{
                    echo 'Er is iets misgegaan!';
                }

            }

        }
        ?>
        <br />
        Maak hier een item aan voor de agenda!
        <form action="" method="post">
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Datum (YYYY-MM-DD HH:MM:SS)</label>
                <input type="text" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Afdeling</label>
                <select name="afdeling" class="form-control">
                    <option value="noodhulp">Noodhulp</option>
                    <option value="ambulance">Ambulance</option>
                    <option value="kmar">Koninklijke Marechaussee</option>
                    <option value="meldkamer">Meldkamer</option>
                    <option value="all">Iedereen</option>
                    <option value="leiding">Leidinggevende</option>
                    <option value="instructeur">Instructeur</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="save" value="Aanmaken" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php
}
?>

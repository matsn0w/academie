<tr>
    <th>Naam</th>
    <th>Roepnummer</th>
    <th>Accepteren</th>
</tr>
<?php
include_once("class.database.php");
if(isset($_GET['incid'])){
    $getCode = $db->query("SELECT * FROM gms_ingemeld WHERE status = '5' AND groep_id = '".$db->real_escape_string($_GET['incid'])."'");
}else{
    $getCode = $db->query("SELECT * FROM gms_ingemeld WHERE status = '5' AND groep_id = '".$fetchGroepInc['id']."'");
}
    while($fetchCode = $getCode->fetch_array()){
?>
<tr>
    <td>
        <?php echo $fetchCode['naam']; ?>
    </td>
    <td>
        <?php echo $fetchCode['roepnummer']; ?>
    </td>
    <td>
        <?php if(isset($_GET['incid'])){ }else{ ?>
        <form>
            <input type="submit" value="Accepteren" class="btn btn-primary" onclick="setDistrict(1, <?php echo $fetchCode['uid']; ?>)">
        </form>
        <?php } ?>
    </td>
</tr>
<?php }
//error_log('give-district.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

<tr>
    <th>Roepnummer</th>
    <th>Status 1</th>
    <th>Status 10</th>
</tr>
<?php
include_once("class.database.php");
if(isset($_GET['incid'])){
    $getCode = $db->query("SELECT * FROM gms_ingemeld WHERE status = '4' AND groep_id = '".$db->real_escape_string($_GET['incid'])."'");
}else{
    $getCode = $db->query("SELECT * FROM gms_ingemeld WHERE status = '4' AND groep_id = '".$fetchGroepInc['id']."'");
}
    while($fetchCode = $getCode->fetch_array()){
?>
<tr>
    <td>
        <?php echo $fetchCode['roepnummer']; ?>
    </td>
    <td>
        <form>
            <input type="text" value="<?php echo $fetchCode['uid']; ?>" style="display:none;" name="uid" id="uid">
            <?php if(isset($_GET['incid'])){ }else{?>
            <i onclick="acceptgrip()"><img src="img/vinkje.png"></i>
            <?php } ?>
        </form>
    </td>
    <td>
        <form>
            <input type="text" value="<?php echo $fetchCode['uid']; ?>" style="display:none;" name="uid" id="uid">
            <?php if(isset($_GET['incid'])){ }else{?>
            <i onclick="denygrip()"><img src="img/kruisje.png"></i>
            <?php } ?>
        </form>
    </td>
</tr>
<?php }
//error_log('code-9.php: '.mysqli_error($db) . "\n", 3, "C:\wamp64\www\roermond\gms\includes\error");
?>

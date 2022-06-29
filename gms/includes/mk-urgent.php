<?php
include_once("class.database.php");
if(isset($_GET['incid'])){
    $getMeldingen = $db->query("SELECT * FROM gms_log WHERE gelezen = '0' AND groep_id = '".$db->real_escape_string($_GET['incid'])."' AND urgent = 'ja' ORDER BY id ASC LIMIT 10");
}else{
    $getMeldingen = $db->query("SELECT * FROM gms_log WHERE gelezen = '0' AND groep_id = '".$fetchGroepInc['id']."' AND urgent = 'ja' ORDER BY id ASC LIMIT 10");
}
    while($fetchMeldingen = $getMeldingen->fetch_assoc()){

?>
<div id="logPing" class="log hoverstatus" data-time="<?php echo $fetchMeldingen['time']; ?>" onclick="changestatus(<?php echo $fetchMeldingen['gelezen']; ?>, <?php echo $fetchMeldingen['id']; ?>)">
    <div data-id="<?php echo $fetchMeldingen['id']; ?>"><b><?php echo $fetchMeldingen['titel']; ?></b></div>
    <?php echo $fetchMeldingen['bericht']; ?>
</div>
<?php }
//error_log('mk-status.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

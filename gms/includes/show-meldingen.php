<?php
include_once("class.database.php");

if($ingemeldFetch['status'] == '4'){
    ?><script>location.href='<?php echo $site; ?>/setGrip.php';</script><?php
}

    $getMeldingen = $db->query("SELECT * FROM gms_meldingen WHERE status = '0' ORDER BY id ASC");
    $countmelding = $getMeldingen->num_rows;
    while($fetchMeldingen = $getMeldingen->fetch_assoc()){

        $getKoppel = $db->query("SELECT * FROM gms_melding_koppel WHERE mid = '".$fetchMeldingen['id']."' AND uid = '".$ingemeldFetch['uid']."'");
        $fetchKoppel = $getKoppel->fetch_assoc();

        if($fetchKoppel['uid'] == $ingemeldFetch['uid']){



?>
<div data-uid="<?php echo $userFetch['id']; ?>" data-id="<?php echo $fetchMeldingen['id']; ?>">
    <b>INC.<?php echo $fetchMeldingen['id']; ?></b><br />
    <b>Melding:</b> <br /><?php echo $fetchMeldingen['melding']; ?> <br />
    <b>Melding info:</b> <br /><?php if($fetchMeldingen['meldinginfo'] == ''){echo 'Geen Info';}else{echo $fetchMeldingen['meldinginfo'];} ?><br />
    <b>Locatie:</b> <br /><?php echo $fetchMeldingen['locatie']; ?><br />
    <b>Prio:</b> <br /><?php echo $fetchMeldingen['prio']; ?><br /></div><br />

    <h2>Eenheden Gekoppeld:</h2>
<?php
$getKoppel2 = $db->query("SELECT * FROM gms_melding_koppel WHERE mid = '".$fetchMeldingen['id']."' ");
while($fetchKoppel2 = $getKoppel2->fetch_assoc()){
?>
    <b><?php echo $fetchKoppel2['roepnummer']; ?></b> - <?php echo $fetchKoppel2['eenheid']; ?><br />

<?php
}
}  }
//error_log('show-meldingen.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

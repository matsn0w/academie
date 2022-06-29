<?php
include_once("class.database.php");
?>
<p>Koppel eenheden aan een melding
    <table width="450px;">
        <tr>
            <th>Eenheid:</th>
            <th>Naam</th>
            <th>Roepnummer:</th>
            <th>Incident:</th>
        </tr>
        <?php
        $getEenheden = $db->query("SELECT * FROM gms_ingemeld WHERE status = '1' AND groep_id = '".$fetchGroepInc['id']."' ORDER BY eenheid");
        while($eenheidFetch = $getEenheden->fetch_array()){
        ?>
        <tr>
            <td><?php echo $eenheidFetch['eenheid']; ?></td>
            <td><?php echo $eenheidFetch['naam']; ?></td>
            <td><?php echo $eenheidFetch['roepnummer']; ?></td>
            <td>
                <select onchange="koppelMelding(this.value, <?php echo $eenheidFetch['uid']; ?>);" name="kanaal" class="form-control">
                    <option disabled selected>Geen</option>
                    <?php
                    $getMeldingID = $db->query("SELECT * FROM gms_meldingen WHERE mkid = '".$ingemeldFetch['groep_id']."' ORDER BY id");
                    while($fetchMeldingID = $getMeldingID->fetch_array()){
                    ?>
                    <option value="<?php echo $fetchMeldingID['id']; ?>">Inc. <?php echo $fetchMeldingID['id']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <?php }
//error_log('koppelmelding.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
        ?>
    </table>
    </p>

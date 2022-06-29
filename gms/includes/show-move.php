<?php
include_once("class.database.php");
?>
<p>Koppel eenheden aan een incidentenkanaal
    <table width="450px;">
        <tr>
            <th>Eenheid:</th>
            <th>Roepnummer:</th>
            <th>Kanaal:</th>
        </tr>
        <?php
        $getEenheden = $db->query("SELECT * FROM gms_ingemeld ORDER BY eenheid");
        error_log('show-move.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
        while($eenheidFetch = $getEenheden->fetch_array()){
        ?>
        <tr>
            <td><?php echo $eenheidFetch['naam']; ?></td>
            <td><?php echo $eenheidFetch['roepnummer']; ?></td>
            <td>
                <select onchange="moveInc(<?php echo $eenheidFetch['uid']; ?>, this.value);" name="kanaal" class="form-control">
                    <option disabled selected>Geen</option>
                    <?php
                    $getKanaal = $db->query("SELECT * FROM gms_kanalen ORDER BY id");
                    while($fetchKanaal = $getKanaal->fetch_array()){
                    ?>
                    <option value="<?php echo $fetchKanaal['kid']; ?>"><?php echo $fetchKanaal['naam']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <?php } ?>
    </table>
    </p>

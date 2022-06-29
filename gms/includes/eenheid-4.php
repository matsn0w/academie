<tr>
<th>Burger Naam</th>
<th>Eenheid</th>
<th>Vrijw.</th>
<th>Status 9</th>
</tr>
<?php
include_once("class.database.php");
$getEenheid = $db->query("SELECT * FROM gms_ingemeld
WHERE status = '1' AND eenheid = 'burger' ORDER BY id ASC");
while($fetchEenheid = $getEenheid->fetch_array()){
?>
<tr data-id="<?php echo $fetchEenheid['id']; ?>" class="hovermelding">
    <td><?php echo $fetchEenheid['naam']; ?></td>
    <td>Burger</td>
    <td>Geen</td>


        <td>
        <i style="cursor:pointer;"
           onclick="setstatus('9', <?php echo $fetchEenheid['uid']; ?>, 0); setlog('<?php echo $userFetch['id']; ?>', 'verwijdering', '<?php echo $userFetch['username']; ?> heeft iemand code 9 gemeld');"><img src="<?php echo $site; ?>/img/009.png"></i>
    </td>
</tr>
<?php }
//error_log('eenheid-4.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

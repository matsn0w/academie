<?php
include_once("class.database.php");
?>
<?php
$getIngemeld = $db->query("SELECT * FROM gms_ingemeld WHERE id > '".$db->real_escape_string($_GET['id'])."' ORDER BY id DESC ");
while($fetchIngemeld = $getIngemeld->fetch_array()){

?>
    <tr data-id="<?php echo $fetchIngemeld['id']; ?>">
        <th><?php echo $fetchIngemeld['naam']; ?></th>
        <td>[<?php echo $fetchIngemeld['roepnummer']; ?>]</td>
        <td><?php echo $fetchIngemeld['eenheid']; ?></td>
    </tr>
<?php }
//error_log('show-ingemeld.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

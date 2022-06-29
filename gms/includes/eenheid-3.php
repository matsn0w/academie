<tr>
<th>Roepnummer</th>
<th>Eenheid</th>
<th>Vrijw.</th>

<th>Status 9</th>
</tr>
<?php
include_once("class.database.php");
if(isset($_GET['incid'])){
   $getEenheid = $db->query('SELECT * FROM `gms_ingemeld` WHERE
(`eenheid` = "ambu" OR
`eenheid` = "Rapid Responder" OR
`eenheid` = "OVD-G/Rapid" OR
`eenheid` = "lifeliner") AND `status` = "1" AND groep_id = "'.$db->real_escape_string($_GET['incid']).'" ORDER BY `id` ASC');
}else{
$getEenheid = $db->query('SELECT * FROM `gms_ingemeld` WHERE
(`eenheid` = "ambu" OR
`eenheid` = "Rapid Responder" OR
`eenheid` = "OVD-G/Rapid" OR
`eenheid` = "lifeliner") AND `status` = "1" AND groep_id = "'.$fetchGroepInc['id'].'" ORDER BY `id` ASC');
}


while($fetchEenheid = $getEenheid->fetch_array()){
?>
<tr data-id="<?php echo $fetchEenheid['id']; ?>" class="hovermelding">
    <td><?php echo $fetchEenheid['roepnummer']; ?></td>
    <td><?php echo $fetchEenheid['eenheid']; ?></td>
    <td>
        <?php
            if($fetchEenheid['vrijw'] == 'brw'){echo 'Brandweer';
            }elseif($fetchEenheid['vrijw'] == '0'){echo 'Geen';
            }elseif($fetchEenheid['vrijw'] == 'at'){echo 'AT';
            }elseif($fetchEenheid['vrijw'] == 'ambu'){echo 'Ambulance';
            }elseif($fetchEenheid['vrijw'] == 'mmt'){echo 'MMT';
            }elseif($fetchEenheid['vrijw'] == 'duik'){echo 'Duiker';
            }elseif($fetchEenheid['vrijw'] == 'lvp'){echo 'Lvp';}

        ?>
    </td>

    <td>
        <i style="cursor:pointer;"
           onclick="setstatus('9', <?php echo $fetchEenheid['uid']; ?>, 0); setlog('<?php echo $userFetch['id']; ?>', 'verwijdering', '<?php echo $userFetch['username']; ?> heeft iemand code 9 gemeld');"><img src="<?php echo $site; ?>/img/009.png"></i>
    </td>
</tr>
<?php }
//error_log('eenheid-3.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

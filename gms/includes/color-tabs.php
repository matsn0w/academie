<?php
include_once("class.database.php");
            $getKoppeld = $db->query("SELECT * FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");
            $fetchKoppeld = $getKoppeld->fetch_assoc();
            if(empty($fetchKoppeld['uid'])){
                $style = 'style="background-color:green;color:white;"';
            }else{
                $style = 'style="background-color:red;color:white;"';
            }
            //error_log('color-tabs.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
            ?>
<a href="#panel-510268" <?php echo $style; ?> data-toggle="tab">Melding</a>

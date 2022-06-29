<div class="aantekeningen">
                        <strong>Aantekeningen:</strong><br />
                    <?php
include_once("class.database.php");
                    $getAantekening = $db->query("SELECT * FROM gms_melding_aantekening ORDER BY id");
                    while($fetchAantekening = $getAantekening->fetch_array()){
                    ?>
                        <i class="aantekening"><?php echo $fetchAantekening['aantekening']; ?></i><i onclick="deleteKladblok(<?php echo $fetchAantekening['id']; ?>)" class="aantekening-delete">X</i><br />
                    <?php }
                      //error_log('kladblok.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
                    ?>


                </div>

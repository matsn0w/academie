<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Trainingen bekijken</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li class="active">
                            <strong>Trainingen</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-12">
                Hier komen de aankomende trainingen te staan!<br />
                <br />
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titel</th>
                            <th>Voor</th>
                            <th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getTraining = $db->query("SELECT * FROM trainingen WHERE status = '0' AND eenheid = '".$userFetch['eenheid']."'");
                        $countTraining = $getTraining->num_rows;
                        if($countTraining <= 0){
                            echo '<tr><td></td><td>Geen trainingen gevonden!</td></tr>';
                        }
                        while($fetchTraining = $getTraining->fetch_array()){
                            $getUsername = $db->query("SELECT username, id FROM users WHERE id = '".$fetchCijfers['by_uid']."'");
                            $fetchUsername = $getUsername->fetch_assoc();
                        ?>
                        <tr onclick="location.href='<?php echo $site; ?>/trainingen/bekijk/<?php echo $fetchTraining['id']; ?>'">
                            <td><?php echo $fetchTraining['id']; ?></td>
                            <td><?php echo $fetchTraining['title']; ?></td>
                            <td><?php echo ucfirst($fetchTraining['eenheid']); ?></td>
                            <td><?php echo $fetchTraining['date']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

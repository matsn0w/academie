<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Cijfers bekijken</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li class="active">
                            <strong>Mijn Cijfers</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-12">
                Bekijk hier al je cijfers die je hebt gehaald met trainingen!<br />
                <br />
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titel</th>
                            <th>Punten</th>
                            <th>Cijfer</th>
                            <th>Door</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $getCijfers = $db->query("SELECT * FROM cijfers WHERE uid = '".$userFetch['id']."'");
                        $countCijfer = $getCijfers->num_rows;
                        if($countCijfer <= 0){
                            echo '<tr><td></td><td>Geen cijfers gevonden!</td></tr>';
                        }
                        while($fetchCijfers = $getCijfers->fetch_array()){
                            $getUsername = $db->query("SELECT username, id FROM users WHERE id = '".$fetchCijfers['by_uid']."'");
                            $fetchUsername = $getUsername->fetch_assoc();
                        ?>
                        <tr class="<?php if($fetchCijfers['cijfer'] >= 5.5){echo 'success';}else{echo 'danger';} ?>">
                            <td><?php echo $fetchCijfers['id']; ?></td>
                            <td><?php echo $fetchCijfers['title']; ?></td>
                            <td><?php echo $fetchCijfers['punten']; ?></td>
                            <td><?php echo $fetchCijfers['cijfer']; ?></td>
                            <td><?php echo $fetchUsername['username']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

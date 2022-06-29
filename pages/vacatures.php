<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Vacatures</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $site; ?>/home">Home</a>
            </li>
            <li class="active">
                <strong>Vacatures</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <h1>Beschikbare Vacatures.</h1>
            
            
            <table class="table">
                <tr>
                    <th>Titel:</th>
                    <th>Uitleg:</th>
                    <th>Datum:</th>
                </tr>
                <?php
                $getAanvraag = $db->query("SELECT * FROM vacatures ORDER BY date");
                while($fetchAanvraag = $getAanvraag->fetch_array()){
                ?>
                <tr onclick="location.href='<?php echo $site; ?>/vacature-lezen/<?php echo $fetchAanvraag['id']; ?>'">
                    <td><?php echo $fetchAanvraag['titel']; ?></td>
                    <td><?php echo substr($fetchAanvraag['text'],0,25).'..'; ?></td>
                    <td><?php echo $fetchAanvraag['date']; ?></td>
                    <td><?php if($fetchAanvraag['status'] == 1){echo'<span class="label label-primary">Open</span></td>';}else{echo'<span class="label label-danger">Gesloten</span></td>';} ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

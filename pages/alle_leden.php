<?php
    $getUserInfo = "SELECT * FROM users";
    $fetchInfoa = $db->query($getUserInfo);
    $i = 1;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profiel</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Alle Leden</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
        <div class="row wrapper">
          <?php foreach($fetchInfoa as $fetchInfo){

            if($i == 4)
            {
              ?></div><?php
              //End $i 1 t/m 4
              ?><div class="row wrapper"><?php
              //start new line
              $i = 1;
            }?>
          <!---Begin Profiel--->
          <?php
          if ($i <= 3)
          {
            ?>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Profiel</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <a href="<?php echo $site."/profiel/".$fetchInfo['id']; ?>"><img alt="image" class="img-responsive" style="width:200px; height:200px; border-radius: 50%; margin:0 auto;" src="<?php echo $fetchInfo['avatar']; ?>"></a>
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo ucfirst($fetchInfo['username']); ?></strong></h4>
                                <p><i class="fa fa-suitcase"></i> <?php echo $fetchInfo['eenheid']; ?></p>
                                <h5>
                                    Over Mijzelf
                                </h5>
                                <p>
                                    <?php echo $fetchInfo['overmijzelf']; ?>
                                </p>
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo $site; ?>/mailbox/bericht-maken" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Stuur bericht</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo $site; ?>/contact/klacht" class="btn btn-default btn-sm btn-block"><i class="fa fa-edit"></i> Geef aan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                    </div>
                <div class="col-md-8" style="display:none;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Krabbels</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
                                    <?php
                                    $getKrabbel = $db->query("SELECT * FROM krabbels WHERE trash = '0' AND uid_to = '".$db->real_escape_string($_GET['id'])."' ORDER BY date DESC LIMIT 6");
                                    $countKrabbel = $getKrabbel->num_rows;
                                    if($countKrabbel == '0'){
                                        echo 'Geen krabbels gevonden!';
                                    }
                                    while($fetchKrabbel = $getKrabbel->fetch_array()){
                                        $getUser = $db->query("SELECT id,username,avatar FROM users WHERE id = '".$fetchKrabbel['uid_from']."'");
                                        $getUsername = $getUser->fetch_assoc();
                                    ?>
                                    <div class="feed-element">
                                        <a href="#" class="pull-left">
                                            <a href="<?php echo $site."/profiel/".$fetchInfo['id']; ?>"><img alt="image" class="img-circle" src="<?php echo $getUsername['avatar']; ?>"></a>
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right"><?php echo show_date($fetchKrabbel['date']); ?></small>
                                            <strong><?php echo $getUsername['username']; ?></strong><br>
                                            <?php echo $fetchKrabbel['bericht']; ?><br />
                                            <small class="text-muted">
                                            <?php
                                            setlocale(LC_TIME, 'NL_nl');
                                            echo strftime('%e %B %Y om %H:%M', strtotime($fetchKrabbel['date']));
                                            ?>
                                            </small>

                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-pencil"></i> Stuur bericht</button>

                            </div>

                        </div>
                    </div>
                    <?php
                    $i = $i + 1;
                  }
              ?>

                </div>
          <?php }?>
            <!---Eind Profiel -->
        </div>

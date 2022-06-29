<?php
include_once("includes/class.database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Meldkamer systeem - NNPD-Clan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">


</head>

<body style="padding:10px;">
    <!---<div class="sitrap-background" style="opacity:0.8;">
        <div class="sitrap" style="opacity:1.0;">
            Sitrapje maken
        </div>
    </div>-->

        <a href="<?php echo $site; ?>/meldkamer.php">Terug naar MK</a>
        <div class="tabbable" id="tabs-866256">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-346954" data-toggle="tab">Noodhulp</a>
					</li>
					<li>
						<a href="#panel-550052" data-toggle="tab">Brandweer</a>
					</li>
                    <li>
						<a href="#panel-550053" data-toggle="tab">Ambulance</a>
					</li>

				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-346954">
						<p><br />
                            YYYY-MM-DD


            <table class="table">
				<thead>
					<tr>
                        <th>
                            Naam
                        </th>
                        <?php
                        $getUsers = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchUsers = $getUsers->fetch_array()){
                        ?>
                        <th>
							<?php echo $fetchUsers['date']; ?>
						</th>
                        <?php } ?>
					</tr>
				</thead>
				<tbody>

                    <?php
                    $getUser = $db->query("SELECT * FROM users WHERE eenheid = 'nh'");
                    while($fetchUser = $getUser->fetch_array()){
                    ?>
					<tr>
                        <td>
                            <?php echo $fetchUser['username']; ?>
                        </td>
                        <?php
                        $getDate = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchDate = $getDate->fetch_array()){
                        ?>
                        <td>

                            <?php
                            //MIDDAG->>>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '16:00:00' AND time <= '19:59:59'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Middag';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Middag<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '16:00:00'){echo 'checked';} ?> >
                            <?php } ?><br />

                            <?php
                            #AVOND->>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '20:00:00'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Avond';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Avond<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '20:00:00'){echo 'checked';} ?> >
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>

				</tbody>
			</table>
						</p>
					</div>
					<div class="tab-pane" id="panel-550052">
						<p><br />
                            YYYY-MM-DD


            <table class="table">
				<thead>
					<tr>
                        <th>
                            Naam
                        </th>
                        <?php
                        $getUsers = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchUsers = $getUsers->fetch_array()){
                        ?>
                        <th>
							<?php echo $fetchUsers['date']; ?>
						</th>
                        <?php } ?>
					</tr>
				</thead>
				<tbody>

                    <?php
                    $getUser = $db->query("SELECT * FROM users WHERE eenheid = 'brw'");
                    while($fetchUser = $getUser->fetch_array()){
                    ?>
					<tr>
                        <td>
                            <?php echo $fetchUser['username']; ?>
                        </td>
                        <?php
                        $getDate = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchDate = $getDate->fetch_array()){
                        ?>
                        <td>

                            <?php
                            //MIDDAG->>>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '16:00:00' AND time <= '19:59:59'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Middag';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Middag<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '16:00:00'){echo 'checked';} ?> >
                            <?php } ?><br />

                            <?php
                            #AVOND->>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '20:00:00'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Avond';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Avond<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '20:00:00'){echo 'checked';} ?> >
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>

				</tbody>
			</table>
						</p>
					</div>
                    <div class="tab-pane" id="panel-550053">
						<p><br />
                            YYYY-MM-DD


            <table class="table">
				<thead>
					<tr>
                        <th>
                            Naam
                        </th>
                        <?php
                        $getUsers = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchUsers = $getUsers->fetch_array()){
                        ?>
                        <th>
							<?php echo $fetchUsers['date']; ?>
						</th>
                        <?php } ?>
					</tr>
				</thead>
				<tbody>

                    <?php
                    $getUser = $db->query("SELECT * FROM users WHERE eenheid = 'ambu'");
                    while($fetchUser = $getUser->fetch_array()){
                    ?>
					<tr>
                        <td>
                            <?php echo $fetchUser['username']; ?>
                        </td>
                        <?php
                        $getDate = $db->query("SELECT * FROM gms_datums ORDER BY date DESC LIMIT 10");
                        while($fetchDate = $getDate->fetch_array()){
                        ?>
                        <td>

                            <?php
                            //MIDDAG->>>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '16:00:00' AND time <= '19:59:59'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Middag';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Middag<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '16:00:00'){echo 'checked';} ?> >
                            <?php } ?><br />

                            <?php
                            #AVOND->>>>>>>>>>>>>>
                            $getActivity = $db->query("SELECT * FROM gms_aanwezigheid WHERE uid = '".$fetchUser['id']."' AND date = '".$fetchDate['date']."' AND time >= '20:00:00'");
                            $countActivity = $getActivity->num_rows;
                            if($countActivity <= 0){
                                echo 'Geen Avond';
                            }
                            while($fetchActivity = $getActivity->fetch_assoc()){
                            ?>
                            Avond<br /><input type="checkbox" <?php if($fetchActivity['date'] == $fetchDate['date'] && $fetchActivity['time'] >= '20:00:00'){echo 'checked';} ?> >
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>

				</tbody>
			</table>
						</p>
					</div>
				</div>
			</div>

</body>
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ion.sound.js"></script>
    <script type="text/javascript" src="js/ion.sound.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</html>

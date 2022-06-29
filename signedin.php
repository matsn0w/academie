<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hoogstad | Academie</title>

    <link href="<?php echo $site; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" href="<?php echo $site; ?>/img/favicon.png" type="image/gif" sizes="64x64">

    <!-- Toastr style -->
    <link href="<?php echo $site; ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="<?php echo $site; ?>/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

    <!-- Gritter -->
    <link href="<?php echo $site; ?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

            <script src="<?php echo $site; ?>/js/jquery-2.1.1.js"></script>
        <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
        <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>

    <!-- Toastr -->
    <script src="<?php echo $site; ?>/js/plugins/toastr/toastr.min.js"></script>

    <link href="<?php echo $site; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/style.css" rel="stylesheet">

</head>

<body>
  <?php
      if(empty($userFetch['teamspeak'])){
        echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Je hebt je TeamSpeak gebruikersnaam nog niet ingevuld! Dit kun je onder "Mijn Account" --> "Instellingen" doen.</div>';
      }
  ?>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" style="width:48px; height:48px; border-radius: 50%;" src="<?php echo $userFetch['avatar']; ?>" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $userFetch['username']; ?></strong>
                             </span> <span class="text-muted text-xs block">Mijn Account <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo $site; ?>/profiel/<?php echo $userFetch['id']; ?>">Profiel</a></li>
                                <li><a href="<?php echo $site; ?>/instellingen">Instellingen</a></li>
                                <li><a href="<?php echo $site; ?>/changepw">Wachtwoord Wijzigen</a></li>
                                <li><a href="<?php echo $site; ?>/mailbox">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $site; ?>/loguit">Loguit</a></li>
                            </ul>
                        </div>
                    </li>
                    <li <?php if($_GET['p'] == 'home'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/home"><i class="fa fa-circle-o-notch fa-spin"></i> <span class="nav-label">Dashboard</span></a>
                    </li>

                    <li <?php if($_GET['p'] == 'alle_leden'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/alle_leden"><i class="fa fa-users"></i> <span class="nav-label">Alle Leden</span></a>
                    </li>

                    <li <?php if($_GET['p'] == 'training-aanvragen'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/training-aanvragen"><i class="fa fa-tasks"></i> <span class="nav-label">Training</span></a>
                    </li>
                    <li <?php if($_GET['p'] == 'vacatures'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/vacatures"><i class="fa fa-envelope"></i> <span class="nav-label">Vacatures</span></a>
                    </li>
                    <li <?php if($_GET['p'] == 'cijfers'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/cijfers"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Cijfers</span></a>
                    </li>
                    <!--<li <?php if($_GET['p'] == 'clanpack'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/clanpack"><i class="fa fa-download"></i> <span class="nav-label">Clanpack</span></a>
                    </li>-->
                    <li <?php if(preg_match('/mailbox/',$_GET['p'])){echo 'class="active"'; } ?>>
                        <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox</span><span class="label label-warning pull-right"><?php echo $emailCount; ?></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $site; ?>/mailbox">Mailbox</a></li>
                            <li><a href="<?php echo $site; ?>/mailbox/bericht-maken">Verzend Mail</a></li>
                            <li><a href="<?php echo $site; ?>/mailbox/verzonden">Verzonden Mails</a></li>
                        </ul>
                    </li>
                    <!--<li <?php if($_GET['p'] == 'gms'){echo 'class="active"'; } ?>>
                        <a href="<?php echo $site; ?>/portal/gms"><i class="fa fa-th-large"></i> <span class="nav-label">GMS</span></a>
                    </li>-->
                    <li <?php if(preg_match('/^contact(.*)/',$_GET['p'])){echo 'class="active"'; } ?>>
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Contact</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level" aria-expanded="true">
                            <li><a href="<?php echo $site; ?>/contact/bestuur">Bestuur</a></li>
                            <li><a href="<?php echo $site; ?>/contact/eenheid">Instructeur</a></li>
              							<li><a href="<?php echo $site; ?>/contact/klachten">Klacht</a></li>
              							<li><a href="<?php echo $site; ?>/contact/vakantie">Vakantie</a></li>
                        </ul>
                    </li>
                    <?php if($instructeur == 1){ ?>
                    <li <?php if(strpos($_GET['p'],'instructeur') !== false){echo 'class="active"'; } ?>>
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Instructeur</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $site; ?>/instructeur/add-news">Maak nieuws artikel</a></li>
                            <li><a href="<?php echo $site; ?>/instructeur/leden">Ledenbeheer</a></li>
                            <li><a href="<?php echo $site; ?>/instructeur/contact">Contact door leden</a></li>
                            <li><a href="<?php echo $site; ?>/instructeur/send-mail">Verzend Bericht (mailbox)</a></li>
                            <li><a href="<?php echo $site; ?>/instructeur/cijfer">Cijfers Beheren</a></li>
                            <li><a href="<?php echo $site; ?>/instructeur/aanvraag-training">Training Aanvragen</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($leiding == 1){ ?>
                    <li <?php if(strpos($_GET['p'],'leiding') !== false){echo 'class="active"'; } ?>>
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Leiding</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $site; ?>/leiding/add-news">Maak nieuws artikel</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/leden">Ledenbeheer</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/formulieren">Formulieren</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/send-mail">Verzend Bericht (mailbox)</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/tijdlijn">Tijdlijn aanmaken</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/aanmeldingen">Aanmeldingen</a></li>
                            <li><a href="<?php echo $site; ?>/leiding/vacature">Vacature Beheer</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($systeem == 1){ ?>
                    <li <?php if(strpos($_GET['p'],'systeem') !== false){echo 'class="active"'; } ?>>
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Bestuur</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $site; ?>/systeem/geef-rank">Rank geven</a></li>
                            <li><a href="<?php echo $site; ?>/systeem/contact">Contact door leden</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welkom op Hoogstad </span>
                </li>
                <?php //--------------------------------------------------------------------------------- ?>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning"><?php echo $emailCount; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                        $getMail = $db->query("SELECT * FROM mailbox WHERE uid_to = '".$userFetch['id']."' AND trash = '0' ORDER BY date DESC LIMIT 3");
                        $countMails = $getMail->num_rows;
                        if($countMails == 0){
                            echo '&nbsp; Geen Mails!';
                        }
                        while($fetchMail = $getMail->fetch_array()){
                            $getUserinfo = $db->query("SELECT id, username, avatar FROM users WHERE id = '".$fetchMail['uid_from']."'");
                            $getUser = $getUserinfo->fetch_assoc();
                        ?>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="<?php echo $site; ?>/profiel/<?php echo $fetchMail['uid_from']; ?>" class="pull-left">
                                    <img alt="image" class="img-circle" src="
                                                                             <?php
                                                                            if($fetchMail['uid_from'] == 0){
                                                                                echo 'https://scontent.cdninstagram.com/hphotos-xfp1/t51.2885-15/s320x320/e35/11934717_193477954326553_1459668290_n.jpg';
                                                                            }else{
                                                                                echo $getUser['avatar'];
                                                                            }
                                                                             ?>" >
                                </a>
                                <div class="media-body">
                                    <small class="pull-right"><?php echo show_date($fetchMail['date']); ?></small>
                                    Van: <strong><?php
                                    if($fetchMail['uid_from'] == 0){
                                        echo $fetchMail['name_from'];
                                    }else{
                                        echo $getUser['username'];
                                    }
                                    ?></strong>. <br>
                                    <?php echo $fetchMail['title']; ?><br />
                                    <small class="text-muted">
                                        <?php
                                        setlocale(LC_TIME, 'NL_nl');
                                        echo strftime('%e %B %Y om %H:%M', strtotime($fetchMail['date']));
                                        ?>
                                    </small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                        <?php } ?>
                            <div class="text-center link-block">
                                <a href="<?php echo $site; ?>/mailbox">
                                    <i class="fa fa-envelope"></i> <strong>Bekijk alle berichten</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                <?php /*

                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                */?>

                <li>
                    <a href="<?php echo $site; ?>/loguit">
                        <i class="fa fa-sign-out"></i> Loguit
                    </a>
                </li>
            </ul>

        </nav>
        </div>


            <?php
                    error_reporting(E_ALL);
                    if(isset($_GET['p'])) {
                        $allowedPages = array();
                        $openDir = opendir('./pages/');

                        while(false !== ($entry = readdir($openDir))) {
                            $allowedPages[$entry] = $entry;
                        }

                        closedir($openDir);

                        $_GET['p'] = preg_replace('/([^.]+)(?:\.[^.]+)?$/', "$1.php", $_GET['p']);
                        $_GET['p'] = preg_replace('/\.[^.]+$/', '.php', $_GET['p']);

                        if(in_array($_GET['p'], $allowedPages)) {

                            include_once './pages/'.$allowedPages[$_GET['p']];
                        } else {
                            include('pages/404.php');

                        }
                    }
            ?>

        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="<?php echo $site; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo $site; ?>/js/scripts.js"></script>

    <!-- Flot -->
    <script src="<?php echo $site; ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo $site; ?>/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $site; ?>/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $site; ?>/js/inspinia.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo $site; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo $site; ?>/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo $site; ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo $site; ?>/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo $site; ?>/js/plugins/chartJs/Chart.min.js"></script>





    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                //toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#464f88"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });
    </script>

</body>
</html>

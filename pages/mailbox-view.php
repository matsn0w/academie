<?php
$getMail = $db->query("SELECT * FROM mailbox WHERE id = '".$db->real_escape_string($_GET['id'])."'");
$fetchMail = $getMail->fetch_assoc();
if($fetchMail['gelezen'] == '0'){
    if($fetchMail['uid_to'] == $userFetch['id']){
        $db->query("UPDATE mailbox SET gelezen = '1' WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    }
}
?>
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="<?php echo $site; ?>/mailbox/bericht-maken">Verzend Mail</a>
                            <div class="space-25"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="<?php echo $site; ?>/mailbox"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning pull-right"><?php echo $emailCount; ?></span> </a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/bericht-maken"> <i class="fa fa-envelope-o"></i> Verzend Mail</a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/belangrijk"> <i class="fa fa-certificate"></i> Belangrijk <span class="label label-danger pull-right"><?php echo $emailCount2; ?></span></a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/prullenbak"> <i class="fa fa-trash-o"></i> Prullenbak</a></li>
                            </ul>
                            <h5>Categorieën</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Leden </a></li>
                                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Instructeur</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-navy"></i> Leidinggevende</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Systeem Beheerder</a></li>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="<?php echo $site; ?>/mailbox/reply/<?php echo $db->real_escape_string($_GET['id']); ?>" class="btn btn-white btn-sm"><i class="fa fa-reply"></i> Beantwoord</a>
                    <?php //<a href="#" class="btn btn-white btn-sm"><i class="fa fa-print"></i> </a> ?>
                    <a href="<?php echo $site; ?>/mailbox/delete/<?php echo $db->real_escape_string($_GET['id']); ?>" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> </a>
                </div>
                <h2>
                    Bekijk Bericht
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">


                    <h3>
                        <span class="font-noraml">Onderwerp: </span><?php echo $fetchMail['title']; ?>
                    </h3>
                    <h5>
                        <span class="pull-right font-noraml"><?php
                            setlocale(LC_TIME, 'NL_nl');
                            echo strftime('%e %B %Y om %H:%M', strtotime($fetchMail['date']));
                            ?></span>
                        <?php
                        $getUsername = $db->query("SELECT id, username FROM users WHERE id = '".$fetchMail['uid_from']."'");
                        $getUser = $getUsername->fetch_assoc();
                        ?>
                        <span class="font-noraml">Van: </span><?php if($fetchMail['uid_from'] == '0'){echo $fetchMail['name_from'];}else{ echo $getUser['username']; } ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <p>
                        <?php echo $fetchMail['bericht']; ?>
                    </p>
                </div>
                        <div class="mail-body text-right tooltip-demo">
                                <a class="btn btn-sm btn-white" href="<?php echo $site; ?>/mailbox/reply/<?php echo $db->real_escape_string($_GET['id']); ?>"><i class="fa fa-reply"></i> Beantwoord</a>
                                <?php //<button title="" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button> ?>
                                <a href="<?php echo $site; ?>/mailbox/delete/<?php echo $db->real_escape_string($_GET['id']); ?>" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> </a>
                        </div>
                        <div class="clearfix"></div>


                </div>
            </div>
        </div>
        </div>

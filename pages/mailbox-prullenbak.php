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

                <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Zoek email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Zoek
                            </button>
                        </div>
                    </div>
                </form>

                <h2>
                    Prullenbak (<?php echo $emailCount4; ?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                    <?php
                    if(isset($_POST['submitDel'])){
                        $check = $_POST['mailCheck'];

                            foreach ($check as $hobys=>$value) {
                                $userQ = $db->query("SELECT id, uid_from, uid_to FROM mailbox WHERE id = '".$value."'");
                                $userF = $userQ->fetch_assoc();
                                if($userF['uid_to'] == $userFetch['id']){
                                    $db->query("DELETE FROM mailbox WHERE id = '".$value."'");
                                }else{
                                    ?><script>toastr.error('Deze mail is niet van jou!', 'Oeps');</script><?php
                                }
                            }
                    }
                    if(isset($_POST['submitBekeken'])){
                        $check = $_POST['mailCheck'];

                            foreach ($check as $hobys=>$value) {
                                $userQ = $db->query("SELECT id, uid_from, uid_to FROM mailbox WHERE id = '".$value."'");
                                $userF = $userQ->fetch_assoc();
                                if($userF['uid_to'] == $userFetch['id']){
                                    $db->query("UPDATE mailbox SET gelezen = '1' WHERE id = '".$value."'");
                                }else{
                                    ?><script>toastr.error('Deze mail is niet van jou!', 'Oeps');</script><?php
                                }
                            }
                    }
                    if(isset($_POST['submitBelangrijk'])){
                        $check = $_POST['mailCheck'];

                            foreach ($check as $hobys=>$value) {
                                $userQ = $db->query("SELECT id, uid_from, uid_to FROM mailbox WHERE id = '".$value."'");
                                $userF = $userQ->fetch_assoc();
                                if($userF['uid_to'] == $userFetch['id']){
                                    $db->query("UPDATE mailbox SET important = '1' WHERE id = '".$value."'");
                                }else{
                                    ?><script>toastr.error('Deze mail is niet van jou!', 'Oeps');</script><?php
                                }
                            }
                    }
                    ?>
                    <form action="" method="POST">

                    <button class="btn btn-white btn-sm" onclick="refresh_page()"><i class="fa fa-refresh"></i> Refresh</button>
                    <button type="submit" name="submitBekeken" class="btn btn-white btn-sm"><i class="fa fa-eye"></i> Bekeken </button>
                    <button type="submit" name="submitBelangrijk" class="btn btn-white btn-sm"><i class="fa fa-exclamation"></i> Belangrijk</button>
                    <button type="submit" name="submitDel" class="btn btn-white btn-sm"><i class="fa fa-trash-o"></i> Verwijderen</button>


                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
                <?php
                $getMail = $db->query("SELECT * FROM mailbox WHERE uid_to = '".$userFetch['id']."' AND trash = '1' ORDER BY date");
                $countMail = $getMail->num_rows;
                if($countMail == 0){
                    echo '&nbsp; Je hebt geen mails!';
                }
                while($fetchMail = $getMail->fetch_array()){
                    $getUser = $db->query("SELECT * FROM users WHERE id = '".$fetchMail['uid_from']."'");
                    $fetchUser = $getUser->fetch_assoc();
                ?>
                <tr <?php if($fetchMail['gelezen'] == '0'){ echo 'class="unread"'; }else{ echo 'class="read"';} ?> >
                    <td class="check-mail">
                        <input type="checkbox" value="<?php echo $fetchMail['id']; ?>" name="mailCheck[]" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="<?php echo $site; ?>/mailbox/view/<?php echo $fetchMail['id']; ?>"><?php if($fetchMail['uid_from'] == '0'){echo $fetchMail['name_from'];}else{echo $fetchUser['username'];} ?></a> <?php echo categorie_mail($fetchMail['categorie']); ?> </td>
                    <td class="mail-subject"><a href="<?php echo $site; ?>/mailbox/view/<?php echo $fetchMail['id']; ?>"><?php echo $fetchMail['title']; ?></a></td>
                    <td class=""><i class="fa fa-exclamation" style="float:right;"></i></td>
                    <td class="text-right mail-date"><?php echo show_date($fetchMail['date']); ?></td>
                </tr>
                <?php } ?>
                    </form>
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>

<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Cijfers bekijken</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li class="active">
                            <strong>Cijfers beheren</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-5">
                <br />
                Voeg een cijfer toe aan een lid.<br />
                <br />
                <?php
                if(isset($_POST['submitCijfer'])){
                    $uid = $db->real_escape_string($_POST['uid']);
                    $title = $db->real_escape_string($_POST['title']);
                    $punten = $db->real_escape_string($_POST['punten']);
                    $cijfer = $db->real_escape_string($_POST['cijfer']);

                    if(empty($title)){
                        ?><script>toastr.error('Je hebt geen titel ingevult!', 'Oeps');</script><?php
                    }elseif(empty($punten)){
                        ?><script>toastr.error('Je hebt geen punten ingevult!', 'Oeps');</script><?php
                    }elseif(empty($cijfer)){
                        ?><script>toastr.error('Je hebt geen cijfer ingevult!', 'Oeps');</script><?php
                    }else{

                        $query = $db->query("INSERT INTO cijfers (uid, title, punten, cijfer, by_uid) VALUES (
                        '".$uid."',
                        '".$title."',
                        '".$punten."',
                        '".$cijfer."',
                        '".$userFetch['id']."'
                        )");

                        if($query){
                            ?><script>location.href="<?php echo $site; ?>/instructeur/cijfer";</script><?php
                        }else{
                            ?><script>toastr.error('Het cijfer kon niet toegevoegd worden!', 'Oeps');</script><?php
                        }
                        echo "<script language='javascript'>window.location.href = '".$site."/instructeur/cijfer'</script>";

                    }
                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Voor:</label>
                        <select name="uid" class="form-control">
                            <?php
                            $getUsers = $db->query("SELECT username,id FROM users ORDER BY id");
                            while($fetchUsers = $getUsers->fetch_array()){
                            ?>
                            <option value="<?php echo $fetchUsers['id']; ?>"><?php echo $fetchUsers['username']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Titel:</label>
                        <input type="text" name="title" class="form-control" placeholder="Aspirantjes training">
                    </div>
                    <div class="form-group">
                        <label>Punten:</label>
                        <input type="text" name="punten" class="form-control" placeholder="10/15">
                    </div>
                    <div class="form-group">
                        <label>Cijfer:</label>
                        <input type="text" name="cijfer" class="form-control" placeholder="9.5">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submitCijfer" class="btn btn-primary" value="Geef Cijfer">
                    </div>
                </form>

            </div>
<?php } ?>

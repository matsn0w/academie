<?php
if(isset($_GET['id'])){
    $id = $db->real_escape_string($_GET['id']);
    
    $userQ = $db->query("SELECT id, uid_from, uid_to FROM mailbox WHERE id = '".$id."'");
    $userF = $userQ->fetch_assoc();
    if($userF['uid_to'] == $userFetch['id']){
        $db->query("UPDATE mailbox SET trash = '1' WHERE id = '".$id."'");
        ?><script>location.href="<?php echo $site; ?>/mailbox";</script><?php
    }else{
        ?><script>location.href="<?php echo $site; ?>/mailbox";</script><?php
    }
    
}
?>
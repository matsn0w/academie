<script src="<?php echo $site; ?>/js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $site; ?>/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<?php
if(isset($_SESSION['email'])){
include_once("class.database.php");

$getAlert = $db->query("SELECT * FROM alerts WHERE gelezen = '0' AND uid = '".$userFetch['id']."'");
while($fetchAlert = $getAlert->fetch_array()){
    
    if($fetchAlert['type'] == 1){
        ?><script>window.onload = function () { swal("<?php echo $fetchAlert['title']; ?>", "<?php echo $fetchAlert['bericht']; ?>"); };</script><?php
        $db->query("UPDATE alerts SET gelezen = '1' WHERE id = '".$fetchAlert['id']."'");
    }elseif($fetchAlert['type'] == 2){
        ?><script>window.onload = function () { swal("<?php echo $fetchAlert['title']; ?>", "<?php echo $fetchAlert['bericht']; ?>", "error"); };</script><?php
        $db->query("UPDATE alerts SET gelezen = '1' WHERE id = '".$fetchAlert['id']."'");
    }
    
}
}
?>
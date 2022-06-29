<?php
include_once("class.database.php");
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$getIn = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$userFetch['id']."'");
$fetchIn = $getIn->fetch_array();

    if($fetchIn['id'] <= 0){
        unset($_SESSION['grip']);
        ?><script>window.location.href = "<?php echo $site; ?>/inmelden.php";</script><?php
    }
//error_log('checkingemeld.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

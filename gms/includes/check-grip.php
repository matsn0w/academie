<?php
include_once("class.database.php");

if($ingemeldFetch['status'] != '4'){
    ?><script>location.href='<?php echo $site; ?>/eenheid.php';</script><?php
}

?>
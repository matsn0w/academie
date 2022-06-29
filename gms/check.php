<meta http-equiv="refresh" content="5" />
<?php
include_once("includes/class.database.php");

if($ingemeldFetch['district'] == '1' || $ingemeldFetch['district'] == '2' || $ingemeldFetch['district'] == '3'){
    header("Location: eenheid.php");
}else{
    $status = 'Even geduld A.U.B!';
    echo $status;
}

?>

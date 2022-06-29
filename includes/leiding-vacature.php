<?php
include_once("class.database.php");

$resultaat = $db->query("SELECT * FROM vacature_reactie ORDER BY date");
$arr = array();

while($fetch = $resultaat->fetch_assoc()){
    $username = $db->query("SELECT id,username FROM users WHERE id = '".$fetch['uid']."'");
    $fetchU = $username->fetch_assoc();
    $arr[] = array(
        "id" => $fetch['id'],
        "naam" => $fetchU['username'],
        "vacature" => $fetch['vacature'],
        "date" => $fetch['date']
    );
}
echo json_encode($arr);

?>

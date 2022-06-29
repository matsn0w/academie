<?php
include_once('class.database.php');
if(isset($_SESSION['email'])){
    $rank = array();
    $getRank = $db->query("SELECT * FROM user_rank WHERE uid = '".$userFetch['id']."'");
    while($fetchRank = $getRank->fetch_assoc()){
        
        $rankName = $db->query("SELECT * FROM ranks WHERE id = '".$fetchRank['rank_id']."'");
        $rankFetch = $rankName->fetch_assoc();
        
        $nh = $rankFetch['nh'];
        $brw = $rankFetch['brw'];
        $ambu = $rankFetch['ambu'];
        $kmar = $rankFetch['Kmar'];
        $mk = $rankFetch['mk'];
        $leiding = $rankFetch['leiding'];
        $instructeur = $rankFetch['instructeur'];
        $systeem = $rankFetch['systeem'];
        $vertrouwenspersoon = $rankFetch['vertrouwenspersoon'];
        
    }
}
?>
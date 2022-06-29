<?php
session_start();
include_once("class.ranks.php");

$resultaat = $db->query("SELECT * FROM agenda WHERE status = '0' ORDER BY id");
$arr = array();
while($fetch = $resultaat->fetch_array()){
    
    if($fetch['afdeling'] == 'instructeur'){
        if($instructeur == 1){
            $arr[] = array(
            'made_uid' => $fetch['made_uid'],
            'title' => $fetch['title'],
            'start' => $fetch['start'],
            'url' => $site."/agenda/bekijk/".$fetch['id'],
            'status' => $fetch['status']
            );
        }
    }
    
    if($leiding != 1){
        
    }else{
        if($fetch['afdeling'] == 'leiding'){
            $arr[] = array(
            'made_uid' => $fetch['made_uid'],
            'title' => $fetch['title'],
            'start' => $fetch['start'],
            'url' => $site."/agenda/bekijk/".$fetch['id'],
            'status' => $fetch['status']
            );
        }
    }
    
        if($fetch['afdeling'] == $userFetch['eenheid'] || $fetch['afdeling'] == 'all'){
                $arr[] = array(
                'made_uid' => $fetch['made_uid'],
                'title' => $fetch['title'],
                'start' => $fetch['start'],
                'url' => $site."/agenda/bekijk/".$fetch['id'],
                'status' => $fetch['status']
                );
            
        }
    
    
}
echo json_encode($arr);

?>
<?php 
if(isset($_SESSION['email'])){
    $emailQuery = $db->query("SELECT * FROM mailbox WHERE trash = '0' AND gelezen = '0' AND uid_to = '".$userFetch['id']."'");
    $emailCount = $emailQuery->num_rows;

    $emailQuery2 = $db->query("SELECT * FROM mailbox WHERE trash = '0' AND important = '1' AND uid_to = '".$userFetch['id']."'");
    $emailCount2 = $emailQuery2->num_rows;
    
    $emailQuery3 = $db->query("SELECT * FROM mailbox WHERE trash = '0' AND uid_from = '".$userFetch['id']."'");
    $emailCount3 = $emailQuery3->num_rows;
    
    $emailQuery4 = $db->query("SELECT * FROM mailbox WHERE trash = '1' AND uid_to = '".$userFetch['id']."'");
    $emailCount4 = $emailQuery4->num_rows;
    
    $trainingQuery = $db->query("SELECT * FROM trainingen WHERE eenheid = '".$userFetch['eenheid']."' AND status = '0'");
    $trainingCount = $trainingQuery->num_rows;
    
    $cijferQuery = $db->query("SELECT * FROM cijfers WHERE uid = '".$userFetch['id']."'");
    $cijferCount = $cijferQuery->num_rows;

    function categorie_mail($cat){
        if($cat == 1){
            echo '<span class="label label-warning pull-right">Leden</span>';
        }else if($cat == 2){
            echo '<span class="label label-danger pull-right">Instructeur</span>';
        }else if($cat == 3){
            echo '<span class="label label-primary pull-right">Leidinggevende</span>';
        }else if($cat == 4){
            echo '<span class="label label-info pull-right">Systeem Beheerder</span>';
        }
    }
    function show_date($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'jaar',
            'm' => 'maand',
            'w' => 'weken',
            'd' => 'dagen',
            'h' => 'uur',
            'i' => 'minuten',
            's' => 'seconden',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' geleden' : 'Net';
    }


}
?>
<?php 
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
?>

<div class="row">
    <div class="col-md-8">
        <br />
        
        <?php 
        if(isset($_POST['save'])){
            $title = $db->real_escape_string($_POST['title']);
            $date = $db->real_escape_string($_POST['date']);
            $uitleg = $db->real_escape_string($_POST['uitleg']);
            
            if(empty($title)){
                echo 'Geen titel ingevult!';
            }elseif(empty($date)){
                echo 'Geen datum ingevult!';
            }else{
                
                $query = $db->query("INSERT INTO trainingen (title, date, uitleg) VALUES ('".$title."', '".$date."', '".$uitleg."')");
                
                if($query){
                    echo 'Succesvol aangemaakt!';
                }else{
                    echo 'Er is iets misgegaan!';
                }
                
            }
            
        }
        ?>
        <br />
        Maak hier een training aan!
        <form action="" method="post">
            <div class="form-group">
                <label>Titel</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Datum (YYYY-MM-DD HH:MM:SS)</label>
                <input type="text" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Uitleg</label>
                <textarea name="uitleg" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="save" value="Aanmaken" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php
}
?>
<div class="col-md-12"><?php
$success = false;
if (isset($_POST['license'])) {
    $license = $_POST['license'];
    $base = __DIR__;
    $textfile = fopen("./includes/licensie.txt", "w") or die("Unable to open file!");
    $contents = $license."\n";
    fwrite($textfile, $contents);
    fclose($textfile);
    $success = true;
}

if ($success) {
    echo 'License toegevoegd';
}else{
        ?>
        <form method="post" action="">
            Licentie: <input name="license" class="form-control">
            <input type="submit" value="Add" class="btn btn-primary">
        </form>
        <?php } ?>
    </div>
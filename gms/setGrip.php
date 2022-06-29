<?php
include_once("includes/class.database.php");
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
window.onload = function() {
var Timer = setInterval(function () {

        $("#checkgrip").load("includes/check-grip.php");

}, 3000);

$(document).ready(function() {
    Timer;
    $("#checkgrip").load("includes/check-grip.php");

});

    }
function acceptgrip(){
    var grip = $("#grip").val();
    var uid = $("#uid").val();

    if (grip == '' || uid == '') {
        alert("Sommige velden zijn niet ingevult!");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
        $.post("includes/submit-grip.php", {
        grip: grip,
        uid: uid
        }, function(data) {
            location.href='<?php echo $site; ?>/eenheid.php';

        });


    }
}


</script>
<center style="font-size:60px;">
    <div id="checkgrip">test</div>
    <br />
    Klik op het groene vinkje als je weer op <b>status 1</b> wilt.<br />
<form>
            <input type="text" value="<?php echo $userFetch['id']; ?>" style="display:none;" name="uid" id="uid">
            <i onclick="acceptgrip()"><img width="200" height="200" src="http://www.autorijschoolideaal.nl/wp-content/uploads/2013/01/groen-vinkje-en-de-rode-min_17-518072245.jpg"></i>
</form>
</center>

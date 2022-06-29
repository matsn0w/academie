<?php
if($leiding != 1 || $instructeur != 1){
  echo "<center><h1>Geen toegang!</h1></center>";
}else{
?>
  <?php
  $getNews = $db->query("SELECT * FROM news WHERE id = '".$db->real_escape_string($_GET['id'])."'");
  $fetchNews = $getNews->fetch_array();
  ?>
  <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>
                  <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-sm-4" style="width: 100%;">
                      <h2>Maak een nieuws artikel</h2>
                      <ol class="breadcrumb">
                          <li>
                              <a href="<?php echo $site; ?>/home">Home</a>
                          </li>
                          <li>
                              <a>Bewerk nieuwsartikel</a>
                          </li>
                          <li class="active">
                              <strong><?php echo $fetchNews['titel']; ?></strong>
                          </li>
                      </ol>
                  </div>
              </div>
          <div class="row">
              <div class="col-lg-12">
                  <div class="wrapper wrapper-content animated fadeInUp">
                      <div class="ibox">
                          <div class="ibox-content">
                              <div class="row m-t-sm">
                                  <div class="col-lg-12">
                                  <div class="panel blank-panel">

                                  <div class="panel-body">

                                  <div class="tab-content">
                                      <?php
                                      if(isset($_POST['UpdateForm'])){
                                          $onderwerp = $db->real_escape_string($_POST['title']);
                                          $bericht = $db->real_escape_string($_POST['bericht']);
                                          $label = $db->real_escape_string($_POST['label']);

                                          if(empty($onderwerp)){
                                              ?><script>toastr.error("Je hebt geen onderwerp gekozen!", "Oeps")</script><?php
                                          }
                                          elseif(empty($label)){
                                              ?><script>toastr.error("Je hebt geen label gekozen!", "Oeps")</script><?php
                                          }elseif(empty($bericht)){
                                              ?><script>toastr.error("Je hebt geen bericht gescheven!", "Oeps")</script><?php
                                          }else{
                                              $query = $db->query("UPDATE `news` SET `titel`='".$onderwerp."',`message`='".$bericht."',`label`='".$label."' WHERE id = '".$fetchNews['id']."'");

                                              if($query){
                                                  ?><script>toastr.success("Bericht Verzonden!", "Succes!")</script><?php
                                              }else{
                                                  ?><script>toastr.error("Er is iets misgegaan met het versturen!", "Oeps")</script><?php
                                              }
                                              echo "<script language='javascript'>window.location.href = '".$site."/home'</script>";

                                          }
                                      }
                                      if(isset($_POST['DelForm'])){

                                        $query = $db->query("DELETE FROM `news` WHERE id = '".$fetchNews['id']."'");

                                        if($query){
                                            ?><script>toastr.success("Bericht Verzonden!", "Succes!")</script><?php
                                        }else{
                                            ?><script>toastr.error("Er is iets misgegaan met het versturen!", "Oeps")</script><?php
                                        }
                                        echo "<script language='javascript'>window.location.href = '".$site."/home'</script>";
                                      }
                                      ?>
                                      <div class="col-md-12">
                                      <form action="" method="POST">
                                          <div class="form-group">
                                              Titel
                                              <input type="text" name="title" class="form-control" value="<?php echo $fetchNews['titel']; ?>">
                                          </div>
                                          <div class="form-group">
                                              label
                                              <select name="label" class="form-control" required>
                                                <option value="" disabled selected>Kies</option>
                                                <option value="algemeen" <?php if($fetchNews['label'] == "algemeen"){ echo "selected";} ?>>Algemeen</option>
                                                <option value="noodhulp" <?php if($fetchNews['label'] == "noodhulp"){ echo "selected";} ?>>Politie</option>
                                                <option value="meldkamer" <?php if($fetchNews['label'] == "meldkamer"){ echo "selected";} ?>>Meldkamer</option>
                                                <option value="ambulance" <?php if($fetchNews['label'] == "ambulance"){ echo "selected";} ?>>Ambulance</option>
                                                <option value="brandweer" <?php if($fetchNews['label'] == "brandweer"){ echo "selected";} ?>>Brandweer</option>
                                                <option value="kmar" <?php if($fetchNews['label'] == "kmar"){ echo "selected";} ?>>Koninklijke Marechaussee</option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                              Bericht
                                              <textarea name="bericht" rows="20" class="form-control" placeholder="Typ hier je bericht, deze wordt verzonden onder de naam instructeur!"><?php echo $fetchNews['message']; ?></textarea>
                                          </div>
                                          <div class="form-group">
                                              <input type="submit" value="Opslaan" class="btn btn-primary" name="UpdateForm">
                                              <input type="submit" value="Verwijderen" class="btn btn-danger" name="DelForm">
                                          </div>

                                      </form>
                                      </div>
                                  </div>

                                  </div>

                                  </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
<?php } ?>

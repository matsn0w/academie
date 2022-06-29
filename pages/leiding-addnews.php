<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
                <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Maak een nieuws artikel</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Home</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li class="active">
                            <strong>Maak nieuws artikel</strong>
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
                                    if(isset($_POST['sendForm'])){
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
                                            $query = $db->query("INSERT INTO news (made_by, label, titel, message, date) VALUES (
                                            '".$userFetch['username']."',
                                            '".$label."',
                                            '".$onderwerp."',
                                            '".$bericht."',
                                            NOW()
                                            )");

                                            if($query){
                                                ?><script>toastr.success("Bericht Verzonden!", "Succes!")</script><?php
                                            }else{
                                                ?><script>toastr.error("Er is iets misgegaan met het versturen!", "Oeps")</script><?php
                                            }
                                            echo "<script language='javascript'>window.location.href = '".$site."/home'</script>";


                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            Titel
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            label
                                            <select name="label" class="form-control" required>
                                              <option value="" disabled selected>Kies</option>
                                              <option value="algemeen">Algemeen</option>
                                              <option value="noodhulp">Politie</option>
                                              <option value="meldkamer">Meldkamer</option>
                                              <option value="ambulance">Ambulance</option>
                                              <option value="brandweer">Brandweer</option>
                                              <option value="kmar">Koninklijke Marechaussee</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            Bericht
                                            <textarea name="bericht" rows="20" class="form-control" placeholder="Typ hier je bericht, deze wordt verzonden onder de naam instructeur!"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Verzend" class="btn btn-primary" name="sendForm">
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

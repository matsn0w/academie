<style>
input[type=submit] {
    background: url(<?php echo $site; ?>/img/Delete.png);
    border: 0;
    display: block;
    height: 16px;
    width: 16px;
}
</style>                <div class="row">

                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Eigen</span>
                                <h5>Mijn Cijfers</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $cijferCount; ?></h1>
                                <small>Cijfers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Ongelezen</span>
                                <h5>Mails</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $emailCount; ?></h1>
                                <small>Ongelezen Mails</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-warning pull-right"><?php echo ucfirst($userFetch['eenheid']);?></span>
                                <h5>Trainingen</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $trainingCount; ?></h1>
                                <small>Trainingen</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-lg-6" style="width: 100%;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><i class="fa fa-newspaper-o"></i> <span class="nav-label">Nieuws</span></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                          <?php
                              $getNewsAlgemeen = "SELECT * FROM news WHERE label = 'algemeen' ORDER BY `news`.`date` DESC";
                              $fetchNewsAlgemeena = $db->query($getNewsAlgemeen);

                              $getNewsNoodhulp = "SELECT * FROM news WHERE label = 'noodhulp' ORDER BY `news`.`date` DESC";
                              $fetchNewsNoodhulpa = $db->query($getNewsNoodhulp);

                              $getNewsMeldkamer = "SELECT * FROM news WHERE label = 'meldkamer' ORDER BY `news`.`date` DESC";
                              $fetchNewsMeldkamera = $db->query($getNewsMeldkamer);

                              $getNewsAmbulance = "SELECT * FROM news WHERE label = 'ambulance' ORDER BY `news`.`date` DESC";
                              $fetchNewsAmbulancea = $db->query($getNewsAmbulance);

                              $getNewsBrandweer = "SELECT * FROM news WHERE label = 'brandweer' ORDER BY `news`.`date` DESC";
                              $fetchNewsBrandweera = $db->query($getNewsBrandweer);

                              $getNewsKMAR = "SELECT * FROM news WHERE label = 'kmar' ORDER BY `news`.`date` DESC";
                              $fetchNewsKMARa = $db->query($getNewsKMAR);
                          ?>
                          <link rel="stylesheet" href="<?php echo $site; ?>/css/news.css">

                              <div class="tabbable" id="tabs-206435">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                <a href="#algemeen" data-toggle="tab">Algemeen</a>
                              </li>
                              <?php if($userFetch['eenheid'] == "noodhulp" || $leiding == 1 || $instructeur == 1){?>
                                <li>
                                    <a href="#noodhulp" data-toggle="tab">Noodhulp</a>
                                </li>
                              <?php }?>
                              <?php if($userFetch['eenheid'] == "meldkamer" || $leiding == 1 || $instructeur == 1){?>
                                <li>
                                    <a href="#meldkamer" data-toggle="tab">Meldkamer</a>
                                </li>
                              <?php }?>
                              <?php if($userFetch['eenheid'] == "ambulance" || $leiding == 1 || $instructeur == 1){?>
                                <li>
                                    <a href="#ambulance" data-toggle="tab">Ambulance</a>
                                </li>
                              <?php }?>
                              <?php if($userFetch['eenheid'] == "brandweer" || $leiding == 1 || $instructeur == 1){?>
                                <li>
                                    <a href="#brandweer" data-toggle="tab">Brandweer</a>
                                </li>
                              <?php }?>
                              <?php if($userFetch['eenheid'] == "kmar" || $leiding == 1 || $instructeur == 1){?>
                                <li>
                                    <a href="#kmar" data-toggle="tab">Koninklijke Marechaussee</a>
                                </li>
                              <?php }?>
                          </ul>
                          <div class="tab-content">
                                      <div class="tab-pane active" id="algemeen">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsAlgemeena as $fetchNewsAlgemeen){ ?>
                            <?php
                            $getUserInfoAlgemeen = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsAlgemeen['made_by']."'");
                            $fetchUserInfoAlgemeen = $getUserInfoAlgemeen->fetch_assoc();
                            ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                    <h5><?php echo $fetchNewsAlgemeen['titel']; ?></h5>
                                    <div class="ibox-tools">
                                      <span class="w3-opacity"><?php echo $fetchNewsAlgemeen['date']; ?></span>
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a>
                                          <?php
                                          if($leiding != 1 || $instructeur != 1){
                                          }else{
                                          ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsAlgemeen['id']; ?>'"></i>
                                        <?php }?>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content" style="max-height:100%">
                                  <!-- Page Container -->
                                  <div>
                                    <!-- The Grid -->
                                    <div>
                                      <!-- Left Column -->
                                      <div class="w3-col m3">
                                        <!-- Profile -->
                                        <div class="w3-card w3-round w3-white">
                                          <div class="w3-container">
                                           <h4 class="w3-center"><center>Auteur</center></h4>
                                           <p class="w3-center"><center><img src="<?php echo $fetchUserInfoAlgemeen['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                           <hr>
                                           <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsAlgemeen['made_by']; ?></p>
                                           <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoAlgemeen['eenheid']; ?></p>
                                         </div>
                                        </div>
                                        <br>
                                      <!-- End Left Column -->
                                      </div>

                                      <!-- Middle Column -->
                                      <div class="w3-col m7" style="width: 100%;">

                                        <div class="w3-container w3-card w3-white w3-round"><br>
                                          <h2><?php echo $fetchNewsAlgemeen['titel']; ?></h2>
                                          <hr class="w3-clear">
                                          <?php echo $fetchNewsAlgemeen['message']; ?>
                                        </div>

                                      <!-- End Middle Column -->
                                      </div>

                                    <!-- End Grid -->
                                    </div>

                                  <!-- End Page Container -->
                                  </div>
                                </div>
                            </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                  </div>
                                      <div class="tab-pane" id="noodhulp">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsNoodhulpa as $fetchNewsNoodhulp){ ?>
                            <?php
                            $getUserInfoNoodhulp = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsNoodhulp['made_by']."'");
                            $fetchUserInfoNoodhulp = $getUserInfoNoodhulp->fetch_assoc();
                            ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                    <h5><?php echo $fetchNewsNoodhulp['titel']; ?></h5>
                                    <div class="ibox-tools">
                                      <span class="w3-opacity"><?php echo $fetchNewsNoodhulp['date']; ?></span>
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a>
                                          <?php
                                          if($leiding != 1 || $instructeur != 1){
                                          }else{
                                          ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsNoodHulp['id']; ?>'"></i>
                                        <?php }?>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content" style="max-height:100%">
                                  <!-- Page Container -->
                                  <div>
                                    <!-- The Grid -->
                                    <div>
                                      <!-- Left Column -->
                                      <div class="w3-col m3">
                                        <!-- Profile -->
                                        <div class="w3-card w3-round w3-white">
                                          <div class="w3-container">
                                           <h4 class="w3-center"><center>Auteur</center></h4>
                                           <p class="w3-center"><center><img src="<?php echo $fetchUserInfoNoodhulp['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                           <hr>
                                           <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsNoodhulp['made_by']; ?></p>
                                           <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoNoodhulp['eenheid']; ?></p>
                                          </div>
                                        </div>
                                        <br>
                                      <!-- End Left Column -->
                                      </div>

                                      <!-- Middle Column -->
                                      <div class="w3-col m7" style="width: 100%;">

                                        <div class="w3-container w3-card w3-white w3-round"><br>
                                          <h2><?php echo $fetchNewsNoodhulp['titel']; ?></h2>
                                          <hr class="w3-clear">
                                          <?php echo $fetchNewsNoodhulp['message']; ?>
                                        </div>

                                      <!-- End Middle Column -->
                                      </div>

                                    <!-- End Grid -->
                                    </div>

                                  <!-- End Page Container -->
                                  </div>
                                </div>
                            </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                      </div>
                                      <div class="tab-pane" id="meldkamer">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsMeldkamera as $fetchNewsMeldkamer){ ?>
                          <?php
                          $getUserInfoMeldkamer = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsMeldkamer['made_by']."'");
                          $fetchUserInfoMeldkamer = $getUserInfoMeldkamer->fetch_assoc();
                          ?>
                          <div class="ibox float-e-margins">
                              <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                  <h5><?php echo $fetchNewsMeldkamer['titel']; ?></h5>
                                  <div class="ibox-tools">
                                    <span class="w3-opacity"><?php echo $fetchNewsMeldkamer['date']; ?></span>
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a>
                                        <?php
                                        if($leiding != 1 || $instructeur != 1){
                                        }else{
                                        ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsMeldkamer['id']; ?>'"></i>
                                      <?php }?>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content" style="max-height:100%">
                                <!-- Page Container -->
                                <div>
                                  <!-- The Grid -->
                                  <div>
                                    <!-- Left Column -->
                                    <div class="w3-col m3">
                                      <!-- Profile -->
                                      <div class="w3-card w3-round w3-white">
                                        <div class="w3-container">
                                         <h4 class="w3-center"><center>Auteur</center></h4>
                                         <p class="w3-center"><center><img src="<?php echo $fetchUserInfoMeldkamer['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                         <hr>
                                         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsMeldkamer['made_by']; ?></p>
                                         <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoMeldkamer['eenheid']; ?></p>
                                        </div>
                                      </div>
                                      <br>
                                    <!-- End Left Column -->
                                    </div>

                                    <!-- Middle Column -->
                                    <div class="w3-col m7" style="width: 100%;">

                                      <div class="w3-container w3-card w3-white w3-round"><br>
                                        <h2><?php echo $fetchNewsMeldkamer['titel']; ?></h2>
                                        <hr class="w3-clear">
                                        <?php echo $fetchNewsMeldkamer['message']; ?>
                                      </div>

                                    <!-- End Middle Column -->
                                    </div>

                                  <!-- End Grid -->
                                  </div>

                                <!-- End Page Container -->
                                </div>
                              </div>
                          </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                      </div>
                                      <div class="tab-pane" id="ambulance">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsAmbulancea as $fetchNewsAmbulance){ ?>
                          <?php
                          $getUserInfoAmbulance = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsAmbulance['made_by']."'");
                          $fetchUserInfoAmbulance = $getUserInfoAmbulance->fetch_assoc();
                          ?>
                          <div class="ibox float-e-margins">
                              <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                  <h5><?php echo $fetchNewsAmbulance['titel']; ?></h5>
                                  <div class="ibox-tools">
                                    <span class="w3-opacity"><?php echo $fetchNewsAmbulance['date']; ?></span>
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a>
                                        <?php
                                        if($leiding != 1 || $instructeur != 1){
                                        }else{
                                        ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsAmbulance['id']; ?>'"></i>
                                      <?php }?>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content" style="max-height:100%">
                                <!-- Page Container -->
                                <div>
                                  <!-- The Grid -->
                                  <div>
                                    <!-- Left Column -->
                                    <div class="w3-col m3">
                                      <!-- Profile -->
                                      <div class="w3-card w3-round w3-white">
                                        <div class="w3-container">
                                         <h4 class="w3-center"><center>Auteur</center></h4>
                                         <p class="w3-center"><center><img src="<?php echo $fetchUserInfoAmbulance['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                         <hr>
                                         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsAmbulance['made_by']; ?></p>
                                         <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoAmbulance['eenheid']; ?></p>
                                        </div>
                                      </div>
                                      <br>
                                    <!-- End Left Column -->
                                    </div>

                                    <!-- Middle Column -->
                                    <div class="w3-col m7" style="width: 100%;">

                                      <div class="w3-container w3-card w3-white w3-round"><br>
                                        <h2><?php echo $fetchNewsAmbulance['titel']; ?></h2>
                                        <hr class="w3-clear">
                                        <?php echo $fetchNewsAmbulance['message']; ?>
                                      </div>

                                    <!-- End Middle Column -->
                                    </div>

                                  <!-- End Grid -->
                                  </div>

                                <!-- End Page Container -->
                                </div>
                              </div>
                          </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                      </div>
                                      <div class="tab-pane" id="brandweer">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsBrandweera as $fetchNewsBrandweer){ ?>
                          <?php
                          $getUserInfoBrandweer = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsBrandweer['made_by']."'");
                          $fetchUserInfoBrandweer = $getUserInfoBrandweer->fetch_assoc();
                          ?>
                          <div class="ibox float-e-margins">
                              <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                  <h5><?php echo $fetchNewsBrandweer['titel']; ?></h5>
                                  <div class="ibox-tools">
                                    <span class="w3-opacity"><?php echo $fetchNewsBrandweer['date']; ?></span>
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a>
                                        <?php
                                        if($leiding != 1 || $instructeur != 1){
                                        }else{
                                        ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsBrandweer['id']; ?>'"></i>
                                      <?php }?>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content" style="max-height:100%">
                                <!-- Page Container -->
                                <div>
                                  <!-- The Grid -->
                                  <div>
                                    <!-- Left Column -->
                                    <div class="w3-col m3">
                                      <!-- Profile -->
                                      <div class="w3-card w3-round w3-white">
                                        <div class="w3-container">
                                         <h4 class="w3-center"><center>Auteur</center></h4>
                                         <p class="w3-center"><center><img src="<?php echo $fetchUserInfoBrandweer['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                         <hr>
                                         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsBrandweer['made_by']; ?></p>
                                         <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoBrandweer['eenheid']; ?></p>
                                        </div>
                                      </div>
                                      <br>
                                    <!-- End Left Column -->
                                    </div>

                                    <!-- Middle Column -->
                                    <div class="w3-col m7" style="width: 100%;">

                                      <div class="w3-container w3-card w3-white w3-round"><br>
                                        <h2><?php echo $fetchNewsBrandweer['titel']; ?></h2>
                                        <hr class="w3-clear">
                                        <?php echo $fetchNewsBrandweer['message']; ?>
                                      </div>

                                    <!-- End Middle Column -->
                                    </div>

                                  <!-- End Grid -->
                                  </div>

                                <!-- End Page Container -->
                                </div>
                              </div>
                          </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                      </div>
                                      <div class="tab-pane" id="kmar">
                                          <div class="margindown"></div>
                          <!----------------------------------------------content-------------------------------------------------------------------------->
                          <?php foreach($fetchNewsKMARa as $fetchNewsKMAR){ ?>
                          <?php
                          $getUserInfoKMAR = $db->query("SELECT * FROM users WHERE username = '".$fetchNewsKMAR['made_by']."'");
                          $fetchUserInfoKMAR = $getUserInfoKMAR->fetch_assoc();
                          ?>
                          <div class="ibox float-e-margins">
                              <div class="ibox-title" style="background-color: #2f4050; color: white;">
                                  <h5><?php echo $fetchNewsKMAR['titel']; ?></h5>
                                  <div class="ibox-tools">
                                    <span class="w3-opacity"><?php echo $fetchNewsKMAR['date']; ?></span>
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a>
                                        <?php
                                        if($leiding != 1 || $instructeur != 1){
                                        }else{
                                        ?><i class="fa fa-edit" onclick="location.href='<?php echo $site; ?>/editnews/<?php echo $fetchNewsKMAR['id']; ?>'"></i>
                                      <?php }?>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content" style="max-height:100%">
                                <!-- Page Container -->
                                <div>
                                  <!-- The Grid -->
                                  <div>
                                    <!-- Left Column -->
                                    <div class="w3-col m3">
                                      <!-- Profile -->
                                      <div class="w3-card w3-round w3-white">
                                        <div class="w3-container">
                                         <h4 class="w3-center"><center>Auteur</center></h4>
                                         <p class="w3-center"><center><img src="<?php echo $fetchUserInfoKMAR['avatar']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></center></p>
                                         <hr>
                                         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>Naam: <?php echo $fetchNewsKMAR['made_by']; ?></p>
                                         <p><i class="fa fa-suitcase fa-fw w3-margin-right w3-text-theme"></i>Eenheid: <?php echo $fetchUserInfoKMAR['eenheid']; ?></p>
                                        </div>
                                      </div>
                                      <br>
                                    <!-- End Left Column -->
                                    </div>

                                    <!-- Middle Column -->
                                    <div class="w3-col m7" style="width: 100%;">

                                      <div class="w3-container w3-card w3-white w3-round"><br>
                                        <h2><?php echo $fetchNewsKMAR['titel']; ?></h2>
                                        <hr class="w3-clear">
                                        <?php echo $fetchNewsKMAR['message']; ?>
                                      </div>

                                    <!-- End Middle Column -->
                                    </div>

                                  <!-- End Grid -->
                                  </div>

                                <!-- End Page Container -->
                                </div>
                              </div>
                          </div>
                          <?php }?>
                          <!----------------------------------------------end content-------------------------------------------------------------------------->
                                      </div>
                              </div>

                                      </div>
                                  </div>

                        </div>
                    </div>
                </div>

                </div>

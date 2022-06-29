<?php
if($leiding != 1){
    echo 'Geen toegang';
}else{
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $site; ?>/home">Dashboard</a>
            </li>
            <li>
                <a>Leiding</a>
            </li>
            <li class="active">
                <strong>Formulieren</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="tabbable" id="tabs-206608">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#contact" data-toggle="tab">Contact</a>
					</li>
                    <!--<li>
                        <a href="#clanpack" data-toggle="tab">Clanpack Idee(ën)</a>
                    </li>-->
                    <li>
                        <a href="#klachten" data-toggle="tab">Klachten</a>
                    </li>
                    <!--<li>
                        <a href="#gegevens" data-toggle="tab">Nieuwe Gegevens</a>
                    </li>
                    <li>
                        <a href="#promotie" data-toggle="tab">Promotie</a>
                    </li>-->
                    <li>
                        <a href="#vakantie" data-toggle="tab">Vakantie</a>
                    </li>
				</ul>
				<div class="tab-content">
                    <div class="tab-pane active" id="contact">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
            <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="width:280px;">
							Naam:
						</th>
						<th style="width:460px;">
							E-mail:
						</th>
						<th style="width:200px;">
							Datum:
						</th>
                        	<th style="width:200px;">
							Status:
						</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactexternQ = $db->query("SELECT * FROM extern_contact ORDER BY date DESC");
                    while($contactexternF = $contactexternQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactexternF['status'] == 1){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/contact/<?php echo $contactexternF['id']; ?>'">
						<td>
							<?php echo $contactexternF['naam']; ?>
						</td>
						<td>
							<?php echo $contactexternF['email']; ?>
						</td>
						<td>
							<?php
                            $dateconverted = strtotime( $contactexternF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
                        <td>
                          <?php if($contactexternF['status'] == 0){echo '<span class="pull-left label label-primary">OPEN</span>';}else{echo '<span class="pull-left label label-danger">GESLOTEN</span>';} ?>
                        </td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                </div>
                    <div class="tab-pane" id="algemeen">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
            <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							E-mail:
						</th>
						<th>
							Leeftijd:
						</th>
						<th>
							Wilt gesprek met:
						</th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formalgemeen ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/algemeen/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
                        </td>
                        <td>
                            <?php echo $contactF['achternaam']; ?>
						</td>
						<td>
							<?php echo $contactF['email']; ?>
						</td>
                        <td>
							<?php echo $contactF['leeftijd']; ?>
						</td>
						<td>
							<?php echo ucfirst($contactF['gesprek']); ?>
						</td>
                        <td>
							<?php
                            $dateconverted = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
                    <div class="tab-pane" id="clanpack">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
                         <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="width: 200px;">
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							 Idee(ën) voor het clanpack:
						</th>
                        <th style="width:250px">
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formclanpack ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/clanpack/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
						</td>
                        <td>
                            <?php echo $contactF['achternaam']; ?>
                        </td>
						<td>
							<?php echo substr($contactF['idee'], 0, 50); ?>
						</td>
                        <td>
							<?php
                            $dateconverted = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
                    <div class="tab-pane" id="klachten">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
                         <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							Tegen:
						</th>
                        <th>
                            Klacht:
                        </th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formklachten ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/klachten/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
                        </td>
                        <td>
						    <?php echo $contactF['achternaam']; ?>
                        </td>
                        <td>
                            <?php echo $contactF['tegen']; ?>
                        </td>
						<td>
							<?php echo substr($contactF['klacht'], 0, 50); ?>
						</td>
                        <td>
							<?php
                            $dateconverted = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
                    <div class="tab-pane" id="gegevens">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
                         <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							Nieuwe gegevens:
						</th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formgegevens ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/gegevens/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
						</td>
                        <td>
                            <?php echo $contactF['achternaam']; ?>
                        </td>
						<td>
							<?php echo substr($contactF['text'], 0, 50); ?>
						</td>
                        <td>
							<?php
                            $dateconverted = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
                    <div class="tab-pane" id="promotie">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
            <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							Voor wie:
						</th>
                        <th>
                            Reden:
                        </th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formpromotie ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/promotie/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
						</td>
                        <td>
                            <?php echo $contactF['achternaam']; ?>
                        </td>
                        <td>
                            <?php echo $contactF['voor']; ?>
                        </td>
						<td>
							<?php echo substr($contactF['waarom'], 0, 50); ?>
						</td>
                        <td>
							<?php
                            $dateconverted = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
                    <div class="tab-pane" id="vakantie">
                        <div class="margindown"></div>
<!------------------------------------------------------------------------------------------------------------------------>
            <table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Naam:
						</th>
                        <th>
                            Achternaam:
                        </th>
						<th>
							Inactief vanaf:
						</th>
                        <th>
                            Actief vanaf:
                        </th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $contactQ = $db->query("SELECT * FROM formvakantie ORDER BY date DESC");
                    while($contactF = $contactQ->fetch_array()){
                    ?>
					<tr class="mousepointer <?php if($contactF['status'] == 0){echo 'success';} ?>" onclick="location.href='<?php echo $site; ?>/leiding/form/vakantie/<?php echo $contactF['id']; ?>'">
						<td>
							<?php echo $contactF['naam']; ?>
						</td>
                        <td>
                            <?php echo $contactF['achternaam']; ?>
                        </td>
                        <td>
                            <?php
                            $dateconverted1 = strtotime( $contactF['inactief'] );
                            echo date( 'd-m-Y', $dateconverted1);
                            ?>
                        </td>
						<td>
							<?php
                            $dateconverted2 = strtotime( $contactF['actief'] );
                            echo date( 'd-m-Y', $dateconverted2);
                            ?>
						</td>
                        <td>
							<?php
                            $dateconverted3 = strtotime( $contactF['date'] );
                            echo date( 'd-m-Y H:i:s', $dateconverted3);
                            ?>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
<!------------------------------------------------------------------------------------------------------------------------>
                    </div>
            </div>

                    </div>
                </div>
<?php } ?>

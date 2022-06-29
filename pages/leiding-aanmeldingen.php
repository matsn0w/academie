<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Aanmeldingen</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li class="active">
                            <strong>Aanmeldingen</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-12">
                <br />
            <div class="tabbable" id="tabs-206608">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#wachtend" data-toggle="tab">Wachtend</a>
					</li>
					<li>
						<a href="#geaccepteerd" data-toggle="tab">Geaccepteerd</a>
					</li>
				</ul>
                <br />
				<div class="tab-content">
                    <div class="tab-pane active" id="wachtend">

            <table class="table table-bordered">
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
                            Afdeling:
                        </th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody class="mousepointer">
                    <?php
                        $aanmeldingQ = $db->query("SELECT id,naam,achternaam,email,afdeling,date FROM aanmeldingen WHERE accepted = '0' ORDER BY date DESC");
                        while($aanmeldingF = $aanmeldingQ->fetch_array()){
                    ?>
					<tr onclick="window.location='<?php echo $site; ?>/leiding/aanmelding/<?php echo $aanmeldingF['id']; ?>'" class="hovering">
						<td>
							<?php echo $aanmeldingF['naam']; ?>
						</td>
						<td>
							<?php echo $aanmeldingF['achternaam']; ?>
						</td>
						<td>
							<?php echo $aanmeldingF['email']; ?>
						</td>
                        <td>
                            <?php echo $aanmeldingF['afdeling']; ?>
                        </td>
                        <td>
                            <?php echo $aanmeldingF['date']; ?>
                        </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>


                </div>
                    <div class="tab-pane" id="geaccepteerd">
                        <div class="margindown"></div>
                                    <table class="table table-bordered">
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
                            Afdeling:
                        </th>
                        <th>
                            Datum:
                        </th>
					</tr>
				</thead>
				<tbody class="mousepointer">
                    <?php
                        $aanmeldingQ = $db->query("SELECT id,naam,achternaam,email,afdeling,date FROM aanmeldingen WHERE accepted = '1' ORDER BY date DESC");
                        while($aanmeldingF = $aanmeldingQ->fetch_array()){
                    ?>
					<tr onclick="window.location='<?php echo $site; ?>/leiding/aanmelding/<?php echo $aanmeldingF['id']; ?>'" class="success">
						<td>
							<?php echo $aanmeldingF['naam']; ?>
						</td>
						<td>
							<?php echo $aanmeldingF['achternaam']; ?>
						</td>
						<td>
							<?php echo $aanmeldingF['email']; ?>
						</td>
                        <td>
                            <?php echo $aanmeldingF['afdeling']; ?>
                        </td>
                        <td>
                            <?php echo $aanmeldingF['date']; ?>
                        </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
                    </div>
            </div>

                    </div>
                </div>
                    <?php } ?>

<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>
<style>
.thomasoranje{
    background:orange;
}
.thomasgeel{
    background:yellow;
}
.succes{
    background:#80FE93;
}
.danielrood{
    background:#FF7979;
}
</style>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Poorten</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li class="active">
                            <strong>Poorten</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-12">
                        <table class="table">
				<thead>
					<tr>
						<th>
							Naam
						</th>
						<th>
							Achternaam
						</th>
						<th>
							Roepnummer
						</th>
                        <th>
                            Eenheid
                        </th>
                        <th>
                            Poorten
                        </th>
					</tr>
				</thead>
				<tbody class="mousepointer">
                    <?php
                    $poortQuery = $db->query("SELECT * FROM users WHERE NOT eenheid = 'meldkamer' ORDER BY username");
                    while($poortFetch = $poortQuery->fetch_array()){
                    ?>
					<tr class="<?php if($poortFetch['poort'] == 'dicht'){echo 'danielrood';}else if($poortFetch['poort'] == 'onbekend'){echo 'warning';}elseif($poortFetch['poort'] == 'upnp open'){echo 'thomasoranje';}elseif($poortFetch['poort'] == 'nat open'){echo 'thomasgeel';}else{echo 'succes';} ?>">
						<td>
							<?php echo $poortFetch['naam']; ?>
						</td>
						<td>
							<?php echo $poortFetch['achternaam']; ?>
						</td>
						<td>
							<?php echo $poortFetch['roepnummer']; ?>
						</td>
						<td>
							<?php echo $poortFetch['eenheid']; ?>
						</td>
                        <td>
<select name="pstatus" id="<?php echo $poortFetch['id']; ?>" onchange="savePoorten(this);">
    <option value="onbekend" <?php if($poortFetch['poort'] == 'onbekend'){echo 'selected';} ?> >Onbekend</option>
    <option value="open" <?php if($poortFetch['poort'] == 'open'){echo 'selected';} ?> >Open</option>
    <option value="dicht" <?php if($poortFetch['poort'] == 'dicht'){echo 'selected';} ?> >Dicht</option>
    <option value="upnp open" <?php if($poortFetch['poort'] == 'upnp open'){echo 'selected';} ?> >UPNP, Dicht!</option>
    <option value="nat open" <?php if($poortFetch['poort'] == 'nat open'){echo 'selected';} ?> >NAT Type, Dicht!</option>
</select>
                        </td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
                    </div>
                </div>
<script src="<?php echo $site; ?>/includes/changePrikbord.js"></script>
<?php } ?>

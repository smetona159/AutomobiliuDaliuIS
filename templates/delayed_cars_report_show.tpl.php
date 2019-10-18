<ul id="reportInfo">
	<li class="title">Vėluojamų grąžinti automobilių ataskaita</li>
	<li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
	<li>Paslaugų užsakymo laikotarpis:
		<span>
			<?php
				if(!empty($data['dataNuo'])) {
					if(!empty($data['dataIki'])) {
						echo "nuo {$data['dataNuo']} iki {$data['dataIki']}";
					} else {
						echo "nuo {$data['dataNuo']}";
					}
				} else {
					if(!empty($data['dataIki'])) {
						echo "iki {$data['dataIki']}";
					} else {
						echo "nenurodyta";
					}
				}
			?>
		</span>
	</li>
</ul>
<?php
	if(sizeof($delayedCarsData) > 0) { ?>
		<table class="reportTable">
			<tr class="gray">
				<th>Sutartis</th>
				<th>Klientas</th>
				<th class="width150">Planuota grąžinti</th>
				<th class="width150">Grąžinta</th>
			</tr>

			<?php
				// suformuojame lentelę
				foreach($delayedCarsData as $key => $val) {
					echo
						"<tr>"
							. "<td>#{$val['nr']}, {$val['sutarties_data']}</td>"
							. "<td>{$val['vardas']} {$val['pavarde']}</td>"
							. "<td>{$val['planuojama_grazinimo_data_laikas']}</td>"
							. "<td>{$val['grazinta']}</td>"
						. "</tr>";
				}
			?>
		</table>
		<a href="index.php?module=contract&action=report_delayed_cars" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else { 
?>
		<div class="warningBox">
			Nurodytu laikotartpiu nerasta negrąžintų automobilių
		</div>
<?php
	}
?>
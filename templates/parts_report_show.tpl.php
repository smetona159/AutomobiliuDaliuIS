<ul id="reportInfo">
	<li class="title">Užsakytų paslaugų ataskaita</li>
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
	if(sizeof($servicesData) > 0) { ?>
		<table class="reportTable">
			<tr class="gray">
				<th>ID</th>
				<th>Paslauga</th>
				<th class="width100">Užsakyta kartų</th>
				<th class="width100">Užsakyta už</th>
			</tr>
			
			<?php
				// suformuojame lentelę
				foreach($servicesData as $key => $val) {
					echo
						"<tr>"
							. "<td>{$val['id']}</td>"
							. "<td>{$val['pavadinimas']}</td>"
							. "<td>{$val['uzsakyta']}</td>"
							. "<td>{$val['bendra_suma']} &euro;</td>"
						. "</tr>";
				}
			?>
			
		  	<tr>
				<td class='groupSeparator' colspan='4'>Suma</td>
			</tr>
			
			<tr class="aggregate">
				<td></td>
				<td class="label"></td>
				<td class="border"><?php echo "{$servicesStats[0]['uzsakyta']}"; ?></td>
				<td class="border"><?php echo "{$servicesStats[0]['bendra_suma']}"; ?> &euro;</td>
			</tr>
		</table>
		<a href="index.php?module=service&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotartpiu paslaugų užsakyta nebuvo.
		</div>
<?php
	}
?>
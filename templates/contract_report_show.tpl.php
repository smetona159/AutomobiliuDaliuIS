<ul id="reportInfo">
	<li class="title">Sudarytų sutarčių ataskaita</li>
	<li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
	<li>Sutarčių sudarymo laikotarpis:
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
	if(sizeof($contractData) > 0) { ?>
		<table class="reportTable">
			<tr>
				<th>Sutartis</th>
				<th>Data</th>
				<th class="width150">Sudarytų sutarčių vertė</th>
				<th class="width150">Užsakyta paslaugų vertė</th>
			</tr>

			<?php
				// suformuojame lentelę
				for($i = 0; $i < sizeof($contractData); $i++) {
					
					if($i == 0 || $contractData[$i]['asmens_kodas'] != $contractData[$i-1]['asmens_kodas']) {
						echo
							  "<tr>"
								. "<td class='groupSeparator' colspan='4'>{$contractData[$i]['vardas']} {$contractData[$i]['pavarde']}</td>"
							. "</tr>";
					}
					
					if($contractData[$i]['sutarties_paslaugu_kaina'] == 0) {
						$contractData[$i]['sutarties_paslaugu_kaina'] = "neužsakyta";
					} else {
						$contractData[$i]['sutarties_paslaugu_kaina'] .= " &euro;";
					}
					
					echo
						"<tr>"
							. "<td>#{$contractData[$i]['nr']}</td>"
							. "<td>{$contractData[$i]['sutarties_data']}</td>"
							. "<td>{$contractData[$i]['sutarties_kaina']} &euro;</td>"
							. "<td>{$contractData[$i]['sutarties_paslaugu_kaina']}</td>"
						. "</tr>";
					if($i == (sizeof($contractData) - 1) || $contractData[$i]['asmens_kodas'] != $contractData[$i+1]['asmens_kodas']) {
						if($contractData[$i]['bendra_kliento_paslaugu_kaina'] == 0) {
							$contractData[$i]['bendra_kliento_paslaugu_kaina'] = "neužsakyta";
						} else {
							$contractData[$i]['bendra_kliento_paslaugu_kaina'] .= " &euro;";
						}
						
						echo 
							"<tr class='aggregate'>"
								. "<td colspan='2'></td>"
								. "<td class='border'>{$contractData[$i]['bendra_kliento_sutarciu_kaina']} &euro;</td>"
								. "<td class='border'>{$contractData[$i]['bendra_kliento_paslaugu_kaina']}</td>"
							. "</tr>";
					}
				}
			?>
			

		  	<tr>
				<td class='groupSeparator' colspan='4'>Bendra suma</td>
			</tr>
			
			<tr class="aggregate">
				<td class="label" style="text-align: right" colspan="2"></td>
				<td class="border"><?php echo $totalPrice[0]['nuomos_suma']; ?> &euro;</td>
				<td class="border">
					<?php
						if($totalServicePrice[0]['paslaugu_suma'] == 0) {
							$totalServicePrice[0]['paslaugu_suma'] = "neužsakyta";
						} else {
							$totalServicePrice[0]['paslaugu_suma'] .= " &euro;";
						}
						
						echo $totalServicePrice[0]['paslaugu_suma'];
					?>
				</td>
			</tr>
		</table>
		<a href="index.php?module=contract&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotartpiu sutarčių sudaryta nebuvo.
		</div>
<?php
	}
?>
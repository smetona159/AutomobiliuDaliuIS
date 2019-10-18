<ul id="reportInfo">
	<li class="title">Sudaryta darbuotojų ataskaita</li>
	
	<li>Darbuotojų sutarčių sudarymo datos laikotarpis:
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
	if(sizeof($uzsakymo_sutarciuData) > 0) { ?>
		<table class="reportTable">
			<tr>
				<th>Sutarties pradžios data</th>
				<th>Asmens ID</th>
                                <th>Parduotuvės ID</th>
				
			</tr>

			<?php
				// suformuojame lentelÄ™
				for($i = 0; $i < sizeof($uzsakymo_sutarciuData); $i++) {
					echo
                                            "<tr>"
                                                . "<td>{$uzsakymo_sutarciuData[$i]['sutarties_prad']}</td>"
                                                . "<td>{$uzsakymo_sutarciuData[$i]['fk_Asmuoasmens_kodas']}</td>"
                                                . "<td>{$uzsakymo_sutarciuData[$i]['fk_Parduotuveid_Parduotuve']}</td>"
                                                . "</tr>";
                                    
                                }
			?>
                         <tr>
                           <td class='groupSeparator' colspan='5'>Iš viso sudaryta sutarčių šiuo laikotarpiu: <?php echo $uzsakymo_sutarciuCount ?> darbuotojo sutartys</td>
			</tr>
		</table>
		<a href="index.php?module=darbuotojas&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">Nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotarpiu jokių darbuotojų sutarčių nebuvo sudaryta.
		</div>
<?php
	}
?>
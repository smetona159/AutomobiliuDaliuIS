<ul id="reportInfo">
	<li class="title">Sudaryta dalių ataskaita</li>
	
	<li>Dalių pagaminimo datos laikotarpis:
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
	if(sizeof($zaidimuData) > 0) { ?>
		<table class="reportTable">
			<tr>
				<th>Pagaminimo data</th>
				<th>Dalies pavadinimas</th>
                                <th>Kaina</th>
				<th>Modelio </th>
                                <th>Dalies tipas</th>
			</tr>

			<?php
				// suformuojame lentelÄ™
				for($i = 0; $i < sizeof($zaidimuData); $i++) {
					echo
                                            "<tr>"
                                                . "<td>{$zaidimuData[$i]['pagaminimo_data']}</td>"
                                                . "<td>{$zaidimuData[$i]['dalies_pavadinimas']}</td>"
                                                . "<td>{$zaidimuData[$i]['kaina']}</td>"
                                                . "<td>{$zaidimuData[$i]['fk_Modelisid_Modelis']}</td>"
                                                . "<td>{$zaidimuData[$i]['fk_Dalies_tipastipo_id']}</td>"
                                                . "</tr>";
                                    
                                }
			?>
                         <tr>
                           <td class='groupSeparator' colspan='5'>Iš viso pagaminta dalių šiuo laikotarpiu: <?php echo $zaidimuCount  ?> dalių</td>
			</tr>
		</table>
		<a href="index.php?module=dalis&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">Nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotarpiu jokių dalių nebuvo pagaminta.
		</div>
<?php
	}
?>
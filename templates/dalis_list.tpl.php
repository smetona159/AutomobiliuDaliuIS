<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Dalys</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja Dalis</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Dalis nebuvo pašalintas, nes yra įtrauktas į užsakomų dalių lentelė (-es).
	</div>
<?php } ?>

<table class="listTable">
	<tr>
		<th>Dalies kodas</th>
		<th>Kaina</th>
		<th>Pavadinimas</th>
		<th>Pagaminimo data</th>
                <th>Gamintojas</th>
		<th>Modelis</th>
                <th>Dalies tipas</th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['dalies_kodas']}</td>"
					. "<td>{$val['kaina']}</td>"
                                        . "<td>{$val['dalies_pavadinimas']}</td>"   
                                        . "<td>{$val['pagaminimo_data']}</td>"
					. "<td>{$val['gamintojas']}</td>"
                                        . "<td>{$val['fk_Modelisid_Modelis']}</td>"
                                        . "<td>{$val['fk_Dalies_tipastipo_id']}</td>"            
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['dalies_kodas']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['dalies_kodas']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>
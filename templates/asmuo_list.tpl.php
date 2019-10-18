<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Asmenys</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas asmuo</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Asmuo nebuvo pašalintas.
	</div>
<?php } ?>

<table class="listTable">
	<tr>
		<th>Asmens kodas</th>
		<th>Vardas</th>
                <th>Pavardė</th>
                <th>Telefonas</th>
                <th>El. paštas</th>
                
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
                                        . "<td>{$val['asmens_kodas']}</td>"
					. "<td>{$val['vardas']}</td>"
                                        . "<td>{$val['pavarde']}</td>"
                                        . "<td>{$val['telefono_nr']}</td>"
                                        . "<td>{$val['el_pastas']}</td>"
                                        
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['asmens_kodas']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['asmens_kodas']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>
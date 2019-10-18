<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Darbuotojai</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas Darbuotojas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Darbuotojas nebuvo pašalintas.
	</div>
<?php }?>

<table class="listTable">
	<tr>
                <th>Sutarties nr.</th>
		<th>Pareigos</th>
                <th>Sutarties pradžia</th>
                <th>Sutarties pabaiga</th>
                <th>Asmens ID</th>
                <th>Parduotuvės ID</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelÄ™

		foreach($data as $key => $val) {
			echo      
                                "<tr>"
                                        . "<td>{$val['sutarties_nr']}</td>"
					. "<td>{$val['pareigos']}</td>"
                                        . "<td>{$val['sutarties_prad']}</td>"
                                        . "<td>{$val['sutarties_pab']}</td>"
                                        . "<td>{$val['asmen']}</td>"
                                        . "<td>{$val['parduot']}</td>"
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['sutarties_nr']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['sutarties_nr']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>
<?php
	// Ä¯traukiame puslapiÅ³ Å¡ablonÄ…
	include 'templates/paging.tpl.php';
?>
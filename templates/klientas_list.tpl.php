<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Klientai</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas klientas</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Klientas nebuvo pašalintas.
	</div>
<?php }?>

<table class="listTable">
	<tr>
                <th>Atsiėmimo miestas</th>
		<th>Kliento ID</th>
                <th>Asmens ID</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelÄ™
		foreach($data as $key => $val) {
			echo       "<tr>"
                                        . "<td>{$val['atsiemimo_miestas']}</td>"
					. "<td>{$val['id_Klientas']}</td>"
                                        . "<td>{$val['asmen']}</td>"
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id_Klientas']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['id_Klientas']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>
<?php
	// Ä¯traukiame puslapiÅ³ Å¡ablonÄ…
	include 'templates/paging.tpl.php';
?>
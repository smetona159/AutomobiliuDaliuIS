<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Parduotuvės</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja parduotuvė</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Parduotuvė nebuvo pašalintas.
	</div>
<?php }?>

<table class="listTable">
	<tr>
                <th>ID</th>
		<th>Miestas</th>
                <th>Adresas</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelÄ™
		foreach($data as $key => $val) {
			echo       "<tr>"
                                        . "<td>{$val['id_Parduotuve']}</td>"
					. "<td>{$val['miestas']}</td>"
                                        . "<td>{$val['adresas']}</td>"
                                        . "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id_Parduotuve']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['id_Parduotuve']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>
<?php
	// Ä¯traukiame puslapiÅ³ Å¡ablonÄ…
	include 'templates/paging.tpl.php';
?>
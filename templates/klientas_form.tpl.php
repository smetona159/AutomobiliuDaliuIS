<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Klientai</a></li>
	<li><?php if(!empty($id)) echo "Kliento redagavimas"; else echo "Naujas klientas"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Neįvesti arba neteisingai įvesti šie laukai:
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			<legend>Kliento informacija</legend>
			<p>
				<label class="field" for="atsiemimo_miestas">Atsiėmimo miestas<?php echo in_array('atsiemimo_miestas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="atsiemimo_miestas" class="textbox textbox-150" value="<?php echo isset($data['atsiemimo_miestas']) ? $data['atsiemimo_miestas'] : ''; ?>">
				<?php if(key_exists('atsiemimo_miestas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['atsiemimo_miestas']} simb.)</span>"; ?>
                        </p>
                        <p>
                                <label class="field" for="asmuo">Asmuo<?php echo in_array('asmuo', $required) ? '<span> *</span>' : ''; ?></label>
                                <select id="asmuo" name="asmuo">
                                <option value="-1">Pasirinkite asmenį</option>
                                <?php
                                    $brandsObj = new asmuo();
                                    $brands = $brandsObj->getAsmuoList();
                                    foreach($brands as $key => $val) {
                                        $selected = "";
                                        if(isset($data['asmuo']) && $data['asmuo'] == $val['asmens_kodas']) {
								$selected = " selected='selected'";
					}
                                        echo "<option{$selected} value='{$val['asmens_kodas']}'>{$val['asmens_kodas']}, {$val['vardas']}, {$val['pavarde']} </option>";
                                    }
                                ?>
                                </select>
                         </p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['id_Klientas'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id_Klientas']; ?>" />
		<?php } ?>
	</form>
</div>
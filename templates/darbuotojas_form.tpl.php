<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Darbuotojai</a></li>
	<li><?php if(!empty($id)) echo "Darbuotojo redagavimas"; else echo "Naujas darbuotojas"; ?></li>
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
			<legend>Darbuotojo informacija</legend>
			<p>
				<label class="field" for="sutarties_nr">Sutarties nr.<?php echo in_array('sutarties_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="sutarties_nr" name="sutarties_nr" class="textbox textbox-150" value="<?php echo isset($data['sutarties_nr']) ? $data['sutarties_nr'] : ''; ?>">
				<?php if(key_exists('sutarties_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['sutarties_nr']} simb.)</span>"; ?>
                        </p>
                        <p>
                                <label class="field" for="pareigos">Pareigos<?php echo in_array('pareigos', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Pareigos" name="pareigos" class="textbox textbox-150" value="<?php echo isset($data['pareigos']) ? $data['pareigos'] : ''; ?>">
				<?php 
                                if(key_exists('pareigos', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pareigos']} simb.)</span>"; ?>
                         </p>
                         <p>
                                <label class="field" for="sutarties_prad">Sutarties pradžia<?php echo in_array('sutarties_prad', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="sutarties_prad" name="sutarties_prad" class="textbox textbox- date" value="<?php echo isset($data['sutarties_prad']) ? $data['sutarties_prad'] : ''; ?>">
				<?php 
                                if(key_exists('sutarties_prad', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['sutarties_prad']} simb.)</span>"; ?>
                         </p>
                         <p>
                                <label class="field" for="sutarties_pab">Sutarties pabaiga<?php echo in_array('sutarties_pab', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Sutarties_pabaiga" name="sutarties_pab" class="textbox textbox- date" value="<?php echo isset($data['sutarties_pab']) ? $data['sutarties_pab'] : ''; ?>">
				<?php 
                                if(key_exists('sutarties_pab', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['sutarties_pab']} simb.)</span>"; ?>
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
                        <p>
                                <label class="field" for="parduotuve">Parduotuvės ID<?php echo in_array('parduotuve', $required) ? '<span> *</span>' : ''; ?></label>
                                <select id="parduotuvesID" name="parduotuve">
                                <option value="-1">Pasirinkite parduotuvę</option>
                                <?php
                                    $brandsObj = new parduotuve();
                                    $brands = $brandsObj->getParduotuveList();
                                    foreach($brands as $key => $val) {
                                        $selected = "";
                                        if(isset($data['parduotuve']) && $data['parduotuve'] == $val['id_Parduotuve']) {
								$selected = " selected='selected'";
					}
                                        echo "<option{$selected} value='{$val['id_Parduotuve']}'>{$val['miestas']}, {$val['adresas']}</option>";
                                    }
                                ?>
                                </select>
                         </p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['sutarties_nr'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['sutarties_nr']; ?>" />
		<?php } ?>
	</form>
</div>
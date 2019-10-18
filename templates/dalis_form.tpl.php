<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Dalys</a></li>
	<li><?php if(!empty($id)) echo "Dalies redagavimas"; else echo "Nauja dalis"; ?></li>
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
			<legend>Dalies informacija</legend>
                        
                        <p>
				<label class="field" for="name">Dalies kodas<?php echo in_array('dalies_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="dalies_kodas" class="textbox textbox-150" value="<?php echo isset($data['dalies_kodas']) ? $data['dalies_kodas'] : ''; ?>">
				<?php if(key_exists('dalies_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['dalies_kodas']} simb.)</span>"; ?>
                        </p>
                        <p>
				<label class="field" for="name">Kaina<?php echo in_array('kaina', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="kaina" class="textbox textbox-150" value="<?php echo isset($data['kaina']) ? $data['kaina'] : ''; ?>">
				<?php if(key_exists('kaina', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['kaina']} simb.)</span>"; ?>
                        </p>
			<p>
				<label class="field" for="name">Dalies pavadinimas<?php echo in_array('dalies_pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="dalies_pavadinimas" class="textbox textbox-150" value="<?php echo isset($data['dalies_pavadinimas']) ? $data['dalies_pavadinimas'] : ''; ?>">
				<?php if(key_exists('dalies_pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['dalies_pavadinimas']} simb.)</span>"; ?>
                        </p>
			<p>
				<label class="field" for="pagaminimo_data">Pagaminimo data<?php echo in_array('pagaminimo_data', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="Isleidimo_data" name="pagaminimo_data" class="textbox textbox- date" value="<?php echo isset($data['pagaminimo_data']) ? $data['pagaminimo_data'] : ''; ?>">
				<?php 
                                if(key_exists('pagaminimo_data', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pagaminimo_data']} simb.)</span>"; ?>
                        </p>
                        <p>
				<label class="field" for="name">Gamintojas<?php echo in_array('gamintojas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="gamintojas" class="textbox textbox-150" value="<?php echo isset($data['gamintojas']) ? $data['gamintojas'] : ''; ?>">
				<?php if(key_exists('gamintojas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['gamintojas']} simb.)</span>"; ?>
                        </p>
                        <p>
                                <label class="field" for="modelis">Modelis<?php echo in_array('modelis', $required) ? '<span> *</span>' : ''; ?></label>
                                <select id="modelis" name="modelis">
                                <option value="-1">Pasirinkite modelį</option>
                                <?php
                                    $brandsObj = new modelis();
                                    
                                    $brands = $brandsObj->getModelisList();
                                    var_dump($brands);
                                    
                                    foreach($brands as $key => $val) {
                                        $selected = "";
                                        if(isset($data['modelis']) && $data['modelis'] == $val['id_Modelis']) {
								$selected = " selected='selected'";
					}
                                        echo "<option{$selected} value='{$val['id_Modelis']}'>{$val['pavadinimas']}</option>";
                                    }
                                ?>
                                </select>
                         </p>
                         <p>
                                <label class="field" for="tipas">Dalies tipas<?php echo in_array('tipas', $required) ? '<span> *</span>' : ''; ?></label>
                                <select id="tipas" name="tipas">
                                <option value="-1">Pasirinkite tipą</option>
                                <?php
                                    $brandsObj = new dalies_tipas();
                                    $brands = $brandsObj->getTipasList();
                                    foreach($brands as $key => $val) {
                                        $selected = "";
                                        if(isset($data['tipas']) && $data['tipas'] == $val['tipo_id']) {
								$selected = " selected='selected'";
					}
                                        echo "<option{$selected} value='{$val['tipo_id']}'>{$val['tipo_reiksme']}</option>";
                                    }
                                ?>
                                </select>
                         </p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['dalies_kodas'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['dalies_kodas']; ?>" />
		<?php } ?>
	</form>
</div>
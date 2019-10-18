<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Asmenys</a></li>
	<li><?php if(!empty($id)) echo "Asmens redagavimas"; else echo "Naujas asmuo"; ?></li>
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
			<legend>Asmens informacija</legend>
			<p>
				<label class="field" for="id">Asmens kodas<?php echo in_array('asmens_kodas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="id" name="asmens_kodas" class="textbox textbox-150" value="<?php echo isset($data['asmens_kodas']) ? $data['asmens_kodas'] : ''; ?>">
				<?php if(key_exists('asmens_kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['asmens_kodas']} simb.)</span>"; ?>
                        </p>
                        <p>
                                <label class="field" for="vardas">Vardas<?php echo in_array('vardas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="vardas" name="vardas" class="textbox textbox-150" value="<?php echo isset($data['vardas']) ? $data['vardas'] : ''; ?>">
				<?php 
                                if(key_exists('Vardas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['vardas']} simb.)</span>"; ?>
                         </p>
                         <p>
                                <label class="field" for="pavarde">Pavardė<?php echo in_array('pavarde', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pavarde" name="pavarde" class="textbox textbox-150" value="<?php echo isset($data['pavarde']) ? $data['pavarde'] : ''; ?>">
				<?php 
                                if(key_exists('pavarde', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pavarde']} simb.)</span>"; ?>
                         </p>
                         <p>
                                <label class="field" for="telefono_nr">Telefono_nr<?php echo in_array('telefono_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="telefono_nr" name="telefono_nr" class="textbox textbox-150" value="<?php echo isset($data['telefono_nr']) ? $data['telefono_nr'] : ''; ?>">
				<?php 
                                if(key_exists('telefono_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['telefono_nr']} simb.)</span>"; ?>
                         </p>
                         <p>
                                <label class="field" for="el_pastas">El. paštas<?php echo in_array('El_pastas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="el_pastas" name="el_pastas" class="textbox textbox-150" value="<?php echo isset($data['el_pastas']) ? $data['el_pastas'] : ''; ?>">
				<?php 
                                if(key_exists('El_pastas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['el_pastas']} simb.)</span>"; ?>
                         </p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['asmens_kodas'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['asmens_kodas']; ?>" />
		<?php } ?>
	</form>
</div>
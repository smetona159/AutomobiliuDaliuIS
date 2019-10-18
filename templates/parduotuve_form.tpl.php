<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Parduotuvės</a></li>
	<li><?php if(!empty($id)) echo "Parduotuvės redagavimas"; else echo "Nauja parduotuvė"; ?></li>
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
			<legend>Parduotuvės informacija</legend>
			<p>
				<label class="field" for="name">Miestas<?php echo in_array('miestas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="miestas" class="textbox textbox-150" value="<?php echo isset($data['miestas']) ? $data['miestas'] : ''; ?>">
				<?php if(key_exists('miestas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['miestas']} simb.)</span>"; ?>
                        </p>
                        <p>
                                <label class="field" for="adresas">Adresas<?php echo in_array('adresas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="adresas" name="adresas" class="textbox textbox-150" value="<?php echo isset($data['adresas']) ? $data['adresas'] : ''; ?>">
				<?php 
                                if(key_exists('adresas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['adresas']} simb.)</span>"; ?>
                         </p>
		</fieldset>
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['id_Parduotuve'])) { ?>
			<input type="hidden" name="id" value="<?php echo $data['id_Parduotuve']; ?>" />
		<?php } ?>
	</form>
</div>
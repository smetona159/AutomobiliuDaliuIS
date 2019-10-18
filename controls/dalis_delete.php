<?php

include 'libraries/dalis.class.php';
$carsObj = new dalis();

if(!empty($id)) {
	// patikriname, ar automobilis neįtrauktas į sutartis
	$count = $carsObj->getUzsakoma_dalisCountOfDalis($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// šaliname automobilį
		$carsObj->deleteDalis($id);
	} else {
		// nepašalinome, nes automobilis įtrauktas bent į vieną sutartį, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}

	// nukreipiame į automobilių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}
?>
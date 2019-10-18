<?php

include 'libraries/asmuo.class.php';
$brandsObj = new asmuo();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('asmens_kodas','el_pastas','vardas','pavarde','telefono_nr');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'asmens_kodas' => 20,
        'el_pastas' => 30,
        'vardas' => 20,
        'pavarde' => 20,
        'telefono_nr' => 20,
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'asmens_kodas' => 'positivenumber',
                'el_pastas' => 'anything',
                'vardas' => 'anything',
                'pavarde' => 'anything',
                'telefono_nr' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$brandsObj->insertAsmuo($dataPrepared);

		// nukreipiame į markių puslapį
		header("Location: index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
}

// įtraukiame šabloną
include 'templates/asmuo_form.tpl.php';

?>
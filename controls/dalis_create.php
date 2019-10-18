<?php

include 'libraries/dalis.class.php';
$carsObj = new dalis();

include 'libraries/modelis.class.php'; //modelis 
$brandsObj = new modelis();

include 'libraries/dalies_tipas.class.php'; //tipas 
$modelsObj = new dalies_tipas();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('dalies_kodas','kaina', 'dalies_pavadinimas', 'pagaminimo_data', 'gamintojas', 'fk_Dalies_tipastipo_id ');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
                'dalies_kodas' => 'anything',
		'kaina' => 'positivenumber',
		'dalies_pavadinimas' => 'anything',
		'pagaminimo_data' => 'date',
		'gamintojas' => 'anything',
                'fk_Modelisid_Modelis ' => 'anything',
                'fk_Dalies_tipastipo_id' => 'anything'
		);

	// sukuriame laukų validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$carsObj->insertDalis($dataPrepared);

		// nukreipiame vartotoją į automobilių puslapį
		header("Location: index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	if(!empty($id)) {
		// išrenkame automobilį
		$data = $carsObj->getDalis($id);
	}
}

// įtraukiame šabloną
include 'templates/dalis_form.tpl.php';

?>
<?php

include 'libraries/klientas.class.php';
$brandsObj = new klientas();

include 'libraries/asmuo.class.php';
$brandssObj = new asmuo();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('atsiemimo_miestas','fk_Asmuoasmens_kodas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'atsiemimo_miestas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'atsiemimo_miestas' => 'words',
                'fk_Asmuoasmens_kodas' => 'anything');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$brandsObj->updateKlientas($dataPrepared);

		// nukreipiame į markių puslapį
		if (!headers_sent($filename, $linenum)) {
                        header("Location: index.php?module={$module}&action=list");
                        exit;

                // You would most likely trigger an error here.
                    } else {
                        echo "Cannot redirect, for now please click this <a " .
                             "href=\"index.php?module={$module}&action=list\">link</a> instead\n";
                        exit;
                    }
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
} else {
	// išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $brandsObj->getKlientas($id);
}

// įtraukiame šabloną
include 'templates/klientas_form.tpl.php';

?>
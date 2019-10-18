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

		// atnaujiname duomenis
		$brandsObj->updateAsmuo($dataPrepared);

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
	$data = $brandsObj->getAsmuo($id);
}

// įtraukiame šabloną
include 'templates/asmuo_form.tpl.php';

?>
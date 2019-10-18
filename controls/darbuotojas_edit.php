<?php

include 'libraries/darbuotojas.class.php';
$brandsObj = new darbuotojas();

include 'libraries/asmuo.class.php';
$brandssObj = new asmuo();

include 'libraries/parduotuve.class.php';
$brandsssObj = new parduotuve();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('sutarties_nr','pareigos','sutarties_prad','fk_Asmuoasmens_kodas','fk_Parduotuveid_Parduotuve');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'sutarties_nr' => 10,
        'pareigos' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'sutarties_nr' => 'anything',
                'pareigos' => 'words',
                'sutarties_prad' => 'date',
                'sutarties_pab' => 'date',
                'fk_Asmuoasmens_kodas' => 'positivenumber',
                'fk_Parduotuveid_Parduotuve' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$brandsObj->updateDarbuotojas($dataPrepared);

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
	$data = $brandsObj->getDarbuotojas($id);
}

// įtraukiame šabloną
include 'templates/darbuotojas_form.tpl.php';

?>
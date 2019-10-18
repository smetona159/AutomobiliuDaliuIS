<?php
	
include 'libraries/darbuotojas.class.php';
$brandsObj = new darbuotojas();

include 'libraries/asmuo.class.php';
$brandssObj = new asmuo();

include 'libraries/parduotuve.class.php';
$brandsssObj = new parduotuve();

$formErrors = null;
$data = array();

// nustatome privalomus formos laukus
$required = array('sutarties_nr','pareigos','sutarties_prad','fk_Asmuoasmens_kodas','fk_Parduotuveid_Parduotuve');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'sutarties_nr' => 10,
        'pareigos' => 20
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	/*include 'utils/validator.class.php';
*/
	// nustatome laukų validatorių tipus
	$validations = array (
		'sutarties_nr' => 'anything',
                'pareigos' => 'words',
                'sutarties_prad' => 'date',
                'sutarties_pab' => 'date',
                'fk_Asmuoasmens_kodas' => 'positivenumber',
                'fk_Parduotuveparduotuves_id' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$brandsObj->insertDarbuotojas($dataPrepared);

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
}

// įtraukiame šabloną
include 'templates/darbuotojas_form.tpl.php';

?>
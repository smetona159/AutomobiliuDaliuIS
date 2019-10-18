<?php
	
include 'libraries/contracts.class.php';
$contractsObj = new contracts();

include 'libraries/services.class.php';
$servicesObj = new services();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'kainos', 'datos');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'pavadinimas' => 40,
	'aprasymas' => 300
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'pavadinimas' => 'anything',
		'aprasymas' => 'anything',
		'kainos' => 'price',
		'datos' => 'date');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$servicesObj->updateService($dataPrepared);

		// pašaliname paslaugos kainas, kurios nėra naudojamos sutartyse
		$deleteQueryClause = "";
		if(sizeof($dataPrepared['kainos']) > 0) {
			foreach($dataPrepared['kainos'] as $key=>$val) {
				if($dataPrepared['neaktyvus'][$key] == 1) {
					$deleteQueryClause .= " AND NOT `galioja_nuo`='" . $dataPrepared['datos'][$key] . "'";
				}
			}
		}
		$servicesObj->deleteServicePrices($dataPrepared['id'], $deleteQueryClause);

		// atnaujiname paslaugos kainas, kurios nėra naudojamos sutartyse
		$servicesObj->insertServicePrices($dataPrepared);

		// nukreipiame į paslaugų puslapį
		header("Location: index.php?module={$module}&action=list");

		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
		if(isset($_POST['kainos']) && sizeof($_POST['kainos']) > 0) {
			$i = 0;
			foreach($_POST['kainos'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['kaina'] = $val;
				$data['paslaugos_kainos'][$i]['galioja_nuo'] = $_POST['datos'][$key];
				$data['paslaugos_kainos'][$i]['neaktyvus'] = $_POST['neaktyvus'][$key];
				$i++;
			}
		}
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	if(!empty($id)) {
		$data = $servicesObj->getService($id);
		$tmp = $servicesObj->getServicePrices($id);
		if(sizeof($tmp) > 0) {
			foreach($tmp as $key => $val) {
				// jeigu paslaugos kaina yra naudojama, jos koreguoti neleidziame ir įvedimo laukelį padarome neaktyvų
				$priceCount = $contractsObj->getPricesCountOfOrderedServices($id, $val['galioja_nuo']);
				if($priceCount > 0) {
					$val['neaktyvus'] = 1;
				}
				$data['paslaugos_kainos'][] = $val;
			}
		}
	}
}

// įtraukiame šabloną
include 'templates/service_form.tpl.php';

?>
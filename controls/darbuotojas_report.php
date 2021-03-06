<?php

include 'libraries/darbuotojas.class.php';
$uzsakymoSutartisObj = new darbuotojas();

$formErrors = null;
$fields = array();

$data = array();
if(empty($_POST['submit'])) {
	// rodome ataskaitos parametrÅ³ Ä¯vedimo formÄ…
	include 'templates/darbuotojas_report_form.tpl.php';
} else {
	// nustatome laukÅ³ validatoriÅ³ tipus
	$validations = array (
		'dataNuo' => 'date',
		'dataIki' => 'date'
	);

	// sukuriame validatoriaus objektÄ…
	include 'utils/validator.class.php';
	$validator = new validator($validations);

	if($validator->validate($_POST)) {
		// suformuojame laukÅ³ reikÅ¡miÅ³ masyvÄ… SQL uÅ¾klausai
            
		$data = $validator->preparePostFieldsForSQL();
		
		// iÅ¡renkame ataskaitos duomenis
		$uzsakymo_sutarciuData = $uzsakymoSutartisObj->getCustomerDarbuotojas($data['dataNuo'], $data['dataIki']);
                $uzsakymo_sutarciuCount = $uzsakymoSutartisObj->getCustomerDarbuotojasCount($data['dataNuo'], $data['dataIki']);
		
		// rodome ataskaitÄ…
		include 'templates/darbuotojas_report_show.php';
	} else {
		// gauname klaidÅ³ praneÅ¡imÄ…
		$formErrors = $validator->getErrorHTML();
		// gauname Ä¯vestus laukus
		$fields = $_POST;

		// rodome ataskaitos parametrÅ³ Ä¯vedimo formÄ… su klaidomis
		include 'templates/darbuotojas_report_form.tpl.php';
	}
}
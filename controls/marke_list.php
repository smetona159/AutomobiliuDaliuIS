<?php
	
include 'libraries/contracts.class.php';
$contractsObj = new contracts();

include 'libraries/services.class.php';
$servicesObj = new services();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $servicesObj->getServicesListCount();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);	

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio paslaugas
$data = $servicesObj->getServicesList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/parts_list.tpl.php';

?>
<?php

// sukuriame zaidimu klasės objektą
include 'libraries/dalis.class.php';
$carsObj = new dalis();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $carsObj->getDalisListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio automobilius
$data = $carsObj->getDalisList($paging->size, $paging->first);	

// įtraukiame šabloną
include 'templates/dalis_list.tpl.php';

?>
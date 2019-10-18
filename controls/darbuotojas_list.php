<?php

// sukuriame markių klasės objektą
include 'libraries/darbuotojas.class.php';
$brandsObj = new darbuotojas();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $brandsObj->getDarbuotojasListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $brandsObj->getDarbuotojasList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/darbuotojas_list.tpl.php';

?>
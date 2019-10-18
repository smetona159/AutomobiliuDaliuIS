<?php

// sukuriame markių klasės objektą
include 'libraries/parduotuve.class.php';
$brandsObj = new parduotuve();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $brandsObj->getParduotuveListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $brandsObj->getParduotuveList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/parduotuve_list.tpl.php';

?>
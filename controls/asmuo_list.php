<?php

// sukuriame markių klasės objektą
include 'libraries/asmuo.class.php';
$brandsObj = new asmuo();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $brandsObj->getAsmuoListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $brandsObj->getAsmuoList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/asmuo_list.tpl.php';

?>
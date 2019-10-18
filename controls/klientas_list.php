<?php

// sukuriame klientų klasės objektą
include 'libraries/klientas.class.php';
$customersObj = new klientas();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $customersObj->getKlientasListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio klientus
$data = $customersObj->getKlientasList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/klientas_list.tpl.php';

?>
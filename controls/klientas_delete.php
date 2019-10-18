<?php

include 'libraries/klientas.class.php';
$brandsObj = new klientas();

if(!empty($id)) {
	// patikriname, ar šalinama markė nepriskirta modeliui
	$count = $brandsObj->getSutartisCountOfKlientas($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// šaliname markę
		$brandsObj->deleteKlientas($id);
	} else {
		// nepašalinome, nes markė priskirta modeliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}

	// nukreipiame į markių puslapį
	if (!headers_sent($filename, $linenum)) {
                        header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
                        exit;

                // You would most likely trigger an error here.
                    } else {
                        echo "Cannot redirect, for now please click this <a " .
                             "href=\"index.php?module={$module}&action=list{$removeErrorParameter}\">link</a> instead\n";
                        exit;
                    }
}

?>
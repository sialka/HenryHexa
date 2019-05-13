<?php

function dd($var) {

	print_r($var);
	exit;

}

function WithoutExtension($file) {

	return substr_replace($file, '', -4);

}

function RouteMount($file) {

	$changeA = substr_replace($file, '', -4);
	$changeB = str_replace('.', '-', $changeA);
	$changeFinal = $changeB . ".txt";

	return $changeFinal;

}

?>

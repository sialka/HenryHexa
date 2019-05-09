<?php

use App\Message;
use App\Page;

$app->get('/', function () {

	$msgPis = Message::getMessage();
	$msgFile = Message::getMessage();

	$page = new Page();

	$page->setTpl("index", [
		'msgPis' => $msgPis,
		'msgFile' => $msgFile,
	]);

});

?>
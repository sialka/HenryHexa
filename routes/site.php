<?php

use App\src\MessagePisFile;
use App\src\Page;
use App\src\SendFile;

$app->get('/', function () {

	$msgPis = MessagePisFile::getMessage(True);
	$msgFile = MessagePisFile::getMessage(False);

	$page = new Page();

	$page->setTpl("index", [
		'msgPis' => $msgPis,
		'msgFile' => $msgFile,
	]);

});

$app->post('/upload', function () {

	if (!isset($_FILES['file']) || $_FILES['file']['name'] == null) {
		MessagePisFile::setMessage(False, False, "Favor selecionar um arquivo");
	} else {

		$arquivo = new SendFile();

		$result = $arquivo->download($_FILES['file']);

		if ($result) {
			MessagePisFile::setMessage(False, True, "Arquivo enviado com sucesso");
		} else {
			MessagePisFile::setMessage(False, False, "Já existe um arquivo com esse nome");
		}

	}

	header("Location: /");
	exit;

});

?>
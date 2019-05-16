<?php

use App\src\MessagePisFile;
use App\src\Page;
use App\src\SendFile;
use App\src\FileTXT;
use App\src\Pis;

$app->post("/search", function(){	

	$pis = (isset($_POST['pis'])) ? $_POST['pis'] : NULL;
	$file = (isset($_POST['file'])) ? $_POST['file'] : NULL;		

	if (!$pis){
		MessagePisFile::setMessage(True,False,"Favor informar o PIS");
		header("Location: /");
		exit;	
	}

	if (!$file){
		MessagePisFile::setMessage(True,False,"Favor selecionar o arquivo");
		header("Location: /");
		exit;	
	}

	$validPis = Pis::is_valid($pis);

	if (!$validPis) {
		MessagePisFile::setMessage(True,False,"PIS inválido");
		header("Location: /");
		exit;	
	}

	$validFile = FileTXT::is_valid($file);

	if (!$validFile) {
		MessagePisFile::setMessage(True,False,"Arquivo inválido");
		header("Location: /");
		exit;	
	}
	

});

$app->get("/delete/:file", function ($file) {	
	
	FileTXT::deleteFile($file);

	header("Location: /");
	exit;
});

$app->get('/', function () {

	$msgPis = MessagePisFile::getMessage(True);
	$msgFile = MessagePisFile::getMessage(False);	

	$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;	

	$pagination = FileTXT::getPage($page);	

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++) {

		array_push($pages, [
			'href' => '/?' . http_build_query([
				'page' => $x + 1,				
			]),
			'text' => $x + 1,
		]);
	}			

	$html = new Page();	

	$html->setTpl("index", [
		'msgPis' => $msgPis,
		'msgFile' => $msgFile,		
		'files' => $pagination['data'],
		'pages' => $pages,
		'page' => $page,
		
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
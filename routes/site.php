<?php

use App\src\Message;
use App\src\Page;
use App\src\Upload;
use App\src\FileTXT;
use App\src\Pis;

$app->post("/search", function(){	

	$pis = (isset($_POST['pis'])) ? $_POST['pis'] : NULL;
	$file = (isset($_POST['filetxt'])) ? $_POST['filetxt'] : NULL;		

	if (!$pis){
		Message::setMessage('pis','danger',"Favor informar o PIS");
		header("Location: /");
		exit;	
	}

	if (!$file){
		Message::setMessage('pis','danger',"Favor selecionar o arquivo");
		header("Location: /");
		exit;	
	}

	$validPis = Pis::is_valid($pis);

	if (!$validPis) {
		Message::setMessage('pis','danger',"PIS inválido");
		header("Location: /");
		exit;	
	}

	$validFile = FileTXT::is_valid($file);

	if (!$validFile) {
		Message::setMessage('pis','danger',"Arquivo inválido");
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

	$msgPis = Message::getMessage('pis');
	$msgFile = Message::getMessage('file');	

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
		Message::setMessage('file', 'danger', "Favor selecionar um arquivo");
	} else {

		$arquivo = new Upload();

		$result = $arquivo->Upload($_FILES['file']);

		if ($result) {
			Message::setMessage('file', 'success', "Arquivo enviado com sucesso");
		} else {
			Message::setMessage('file', 'danger', "Já existe um arquivo com esse nome");
		}

	}

	header("Location: /");
	exit;

});

?>
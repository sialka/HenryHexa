<?php

namespace app\src;

use App\src\Message;
use App\src\ValidDoc;

class FileTXT {

	public static function path(){
		return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;	
	}

	public static function loadFilesPath() {		

		$files = array_diff(scandir(FileTXT::path()), array('..', '.'));

		return $files;

	}

	public static function getPage($page = 1, $itemsPerPage = 3) {

		$start = ($page - 1) * $itemsPerPage;				

		$oldfiles = array_diff(scandir(FileTXT::path()), array('..', '.'));		

		$files = [];
		$results = [];

		foreach($oldfiles as $key => $value){
			array_push($files, $value);
		}		

		for ($i=0; $i < $itemsPerPage; $i++) { 
			
			if ($start < count($files)){				
				array_push($results, $files[$start]);
			}
			$start++;
		}

		return [
			'data' => $results,
			'total' => (int) count($files),
			'pages' => ceil(count($files) / $itemsPerPage),
		];		
	}	

	public static function deleteFile($file) {

		$deleted = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $file . ".txt";

		if (file_exists($deleted)) {

			unlink($deleted);
			Message::setMessage('pis', 'success', "Arquivo deletado com sucesso");

		} else {

			Message::setMessage('pis', 'danger', "Arquivo não existe");

		}

	}

	public static function is_valid($file){	
		
		$full_path_name = FileTXT::path().trim($file).'.txt';
			
		$checkFile = fopen($full_path_name,"r");					
		
		$data_file = array();		

		while (!feof ($checkFile)) 
		{
			$line = fgets($checkFile);				
			array_push($data_file, $line);				
		}
		fclose($checkFile);		
		
		if (count($data_file) < 3){
			return false;
		}		

		$line = $data_file[0];
		$cnpj = substr($line, 11, 14);				

		if (!ValidDoc::CNPJ_is_valid($cnpj)){
			return false;
		}
		
		return true;
	}
}

?>
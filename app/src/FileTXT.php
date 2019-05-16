<?php

namespace app\src;

use App\src\Message;

class FileTXT {

	public static function loadFilesPath() {

		$dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;

		$files = array_diff(scandir($dir), array('..', '.'));

		return $files;

	}

	public static function getPage($page = 1, $itemsPerPage = 3) {

		$start = ($page - 1) * $itemsPerPage;		

		$path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;

		$oldfiles = array_diff(scandir($path,1), array('..', '.'));		

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

		

	}
}

?>
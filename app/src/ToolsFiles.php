<?php

namespace app\src;

use App\src\MessagePisFile;

class ToolsFiles {

	public static function loadFilesPath() {

		$dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;

		$files = array_diff(scandir($dir), array('..', '.'));

		return $files;

	}

	public static function deleteFile($file) {

		$deleted = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $file . ".txt";

		if (file_exists($deleted)) {

			unlink($deleted);
			MessagePisFile::setMessage(True, True, "Arquivo deletado com sucesso");

		} else {

			MessagePisFile::setMessage(True, False, "Arquivo não existe");

		}

	}
}

?>
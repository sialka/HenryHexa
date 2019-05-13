<?php

namespace App\src;

class SendFile {

	public function download() {

		$fileName = $_FILES['file']['name'];

		// dd($_FILES);

		$file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $fileName;

		if (file_exists($file)) {
			return false;
		}

		move_uploaded_file($_FILES['file']['tmp_name'], $file);

		return true;

	}
}

?>
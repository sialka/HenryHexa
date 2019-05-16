<?php

namespace App\src;

class Upload {

	public function upload() {

		$fileName = $_FILES['file']['name'];

		$file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . RouteMount($fileName);

		if (file_exists($file)) {
			return false;
		}

		move_uploaded_file($_FILES['file']['tmp_name'], $file);

		return true;

	}
}

?>
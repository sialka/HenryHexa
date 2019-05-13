<?php

namespace App\src;

class MessagePisFile {

	const MESSAGEPIS = "MessagePis";
	const MESSAGEFILE = "MessageFile";

	private static $text = [
		'css' => '',
		'message' => '',
	];

	public static function setMessage($pis, $css, $msg) {

		// MESSAGEPIS
		if ($pis) {

			// alert-success
			if ($css) {

				$_SESSION[MessagePisFile::MESSAGEPIS] = MessagePisFile::$text = [
					'css' => 'alert-success',
					'message' => $msg,
				];

				// alert-danger
			} else {

				$_SESSION[MessagePisFile::MESSAGEPIS] = MessagePisFile::$text = [
					'css' => 'alert-danger',
					'message' => $msg,
				];

			}

			// MESSAGEFILE
		} else {

			//	alert-success
			if ($css) {

				$_SESSION[MessagePisFile::MESSAGEFILE] = MessagePisFile::$text = [
					'css' => 'alert-success',
					'message' => $msg,
				];

				// alert-danger
			} else {

				$_SESSION[MessagePisFile::MESSAGEFILE] = MessagePisFile::$text = [
					'css' => 'alert-danger',
					'message' => $msg,
				];

			}
		}

	}

	public static function getMessage($pis) {

		// MESSAGEPIS
		if ($pis) {

			$msg = (isset($_SESSION[MessagePisFile::MESSAGEPIS])) ? $_SESSION[MessagePisFile::MESSAGEPIS] : "";

			$_SESSION[MessagePisFile::MESSAGEPIS] = NULL;

			// MESSAGEFILE
		} else {

			$msg = (isset($_SESSION[MessagePisFile::MESSAGEFILE])) ? $_SESSION[MessagePisFile::MESSAGEFILE] : "";

			$_SESSION[MessagePisFile::MESSAGEFILE] = NULL;

		}

		return $msg;

	}

}

?>
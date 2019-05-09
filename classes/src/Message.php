<?php

namespace App;

class Message {

	const MESSAGE = "Message";
	private static $text = [
		'css' => '',
		'message' => '',
	];

	public static function setMessage($type, $msg) {

		// dd(Message::$message);

		if ($type) {
			$_SESSION[Message::MESSAGE] = Message::$text = [
				'css' => 'alert-success',
				'message' => $msg,
			];
		} else {
			$_SESSION[Message::MESSAGE] = Message::$text = [
				'css' => 'alert-danger',
				'message' => $msg,
			];
		}

	}

	public static function getMessage() {

		$msg = (isset($_SESSION[Message::MESSAGE])) ? $_SESSION[Message::MESSAGE] : "";

		$_SESSION[Message::MESSAGE] = NULL;

		return $msg;

	}

}

?>
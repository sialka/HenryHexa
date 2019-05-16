<?php

namespace App\src;

class Message {

	const MESSAGEPIS = "MessagePis";
	const MESSAGEFILE = "MessageFile";

	private static $text = [
		'css' => '',
		'message' => '',
	];

	public static function setMessage($who, $css, $msg) {

		
		if ($who == 'pis') {
			
			if ($css == 'success') {

				$_SESSION[Message::MESSAGEPIS] = Message::$text = [
					'css' => 'alert-success',
					'message' => $msg,
				];
			
			} 			
				
			if ($css == 'danger') {

				$_SESSION[Message::MESSAGEPIS] = Message::$text = [
					'css' => 'alert-danger',
					'message' => $msg,
				];

			}

		} 		
		
		if ($who == 'file') {
			
			if ($css == 'success') {

				$_SESSION[Message::MESSAGEFILE] = Message::$text = [
					'css' => 'alert-success',
					'message' => $msg,
				];
				
			} 
			
			if ($css == 'danger') {

				$_SESSION[Message::MESSAGEFILE] = Message::$text = [
					'css' => 'alert-danger',
					'message' => $msg,
				];

			}
		}

	}

	public static function getMessage($who) {

		// MESSAGEPIS
		if ($who == 'pis') {

			$msg = (isset($_SESSION[Message::MESSAGEPIS])) ? $_SESSION[Message::MESSAGEPIS] : "";

			$_SESSION[Message::MESSAGEPIS] = NULL;

			// MESSAGEFILE
		} 
		
		if ($who == 'file') {

			$msg = (isset($_SESSION[Message::MESSAGEFILE])) ? $_SESSION[Message::MESSAGEFILE] : "";

			$_SESSION[Message::MESSAGEFILE] = NULL;

		}

		return $msg;

	}

}

?>
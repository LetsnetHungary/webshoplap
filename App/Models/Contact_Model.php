<?php
	class Contact_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function sendMail(){
			$sender = $_POST['sender'];
			$mail = $_POST['mail'];
			$subject = $_POST['subject'];
			$text = $_POST['text'];
			$time_sent = date("Y.m.d G:i");

			$owner_mail = "kovioli@gmail.com";
			//$content = str_replace("\n", " ", $content); // ide 3 paraméter kell, hogy mire cseréljen, az is ;)
			$ending = "\n\n" . "Sent by " .$mail . "\n" . "Időpont: " . $time_sent;
			$msg = $text . $ending;
			mail($owner_mail, $subject, $msg);
		}

	}

<?php
	class Contact_API_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function msgAuth(){
			$sender = $_POST['sender'];
			$mail = $_POST['mail'];
			$subject = $_POST['subject'];
			$text = $_POST['text'];

			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				echo "email address incorrect";
				header("Location: ../Contact?mail_error");
				return;
			}
			else{
				$this->sendMail();
			}

		}

		public function sendMail(){
			$sender = $_POST['sender'];
			$mail = $_POST['mail'];
			$subject = $_POST['subject'];
			$text = $_POST['text'];
			$time_sent = date("Y.m.d G:i");

			$owner_mail = "hegel.akos@letsnet.hu";
			//$content = str_replace("\n", " ", $content); // ide 3 paraméter kell, hogy mire cseréljen, az is ;)
			$ending = "</br></br>" . "Sent by " . $mail . "</br>" . "Időpont: " . $time_sent;
			$msg = $text . $ending;
			print_r($msg);
			// mail($owner_mail, $subject, $msg);

		}

	}

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
			elseif (!preg_match("/^[a-zA-Z]*$/", $sender) || !preg_match("/^[a-zA-Z]*$/", $subject) || !preg_match("/^[a-zA-Z]*$/", $text)) {
				echo "invalid characters have been used!";
				header("Location: ../Contact?char_error");
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

			$owner_mail = "kovioli@gmail.com";
			//$content = str_replace("\n", " ", $content); // ide 3 paraméter kell, hogy mire cseréljen, az is ;)
			$ending = "</br></br>" . "Sent by " . $mail . "</br>" . "Időpont: " . $time_sent;
			$msg = $text . $ending;
			print_r($msg);
			// mail($owner_mail, $subject, $msg);

		}

	}

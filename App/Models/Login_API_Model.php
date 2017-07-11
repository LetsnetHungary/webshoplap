<?php
	class Login_API_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function logIn($email, $pw){
			$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $db->prepare("SELECT * FROM users WHERE users.email = :email ");
			$stmt->execute(array(
				":email" => $email
			));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// $pw_hash = password_hash($result[0]['password'], PASSWORD_BCRYPT); <- ezzel lehet a regisztráció passait hashelni
			if (count($result) == 0) {
				echo "Nem létezik ilyen felhasználó";
			}
			else { //létezik a felhasználó
				if (password_verify($pw, $result[0]['password'])) { //megfelelő a jelszó
					if ($result[0]['is_admin'] == 1) {
						$this->sessionFun($email, 1);
						// echo "Sikeresen bejelentkeztél, " . $_SESSION['email'];
						header("Location: Admin");
					}
					else {
						$this->sessionFun($email, 0);
						echo "Sikeres felhasználó bejelentkezés";
						header("Location: Profile");
						return;
					}
				}
				else { //jelszó nem megfelelő
						echo "Hibás jelszó!";
				}
			} //1. else vége
			// return $result;
		} //logIn fun vége

		public function sessionFun($email, $is_admin){
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['is_admin'] = $is_admin;
			$_SESSION['loggedin'] = time();
		}

		public function addUser(){
			$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			for ($i=1; $i < 10; $i++) {
				$email = "valaki" . $i . "@test.com";
				$pass = "pass" . $i;
				$pass = password_hash($pass, PASSWORD_BCRYPT);
				$stmt = $db->prepare("INSERT INTO `users`(`email`, `password`, `is_admin`) VALUES (:email, :password, :is_admin)");
				$stmt->execute(array(
					":email" => $email,
					":password" => $pass,
					":is_admin" => ($i%2)
				));
			}
		}


	}

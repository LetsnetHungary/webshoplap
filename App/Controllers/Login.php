<?php
	class Login extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
			ob_start();
			session_start();
			$this->viewInit("Login");
			$this->isLoggedIn();
			ob_flush();
		}

		public function isLoggedIn(){
			if ($_SESSION['is_admin']==1) {
				if(isset($_SESSION['email'])) {
					header("Location: Admin");
				}
			}
			else {
				if(isset($_SESSION['email'])) {
					header("Location: Profile");
				}
			}
		}
  }

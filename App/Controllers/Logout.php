<?php
	class Logout extends CoreApp\Controller {

		public function __construct() {
			ob_start();
			session_start();
			parent::__construct(__CLASS__);
			$this->isLoggedIn();
			ob_flush();
		}
		public function isLoggedIn(){
			header("Location: Login");
			$_SESSION = [];
		}
	}

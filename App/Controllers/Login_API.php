<?php
	class Login_API extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
      $this->loadModel(__CLASS__);
			$this->userAuth();

		}
		public function userAuth(){
			$this->model->logIn($_POST['email'], $_POST['password']);			
		}
  }

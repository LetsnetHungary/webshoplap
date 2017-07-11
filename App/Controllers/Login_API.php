<?php
	class Login extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
      $this->loadModel(__CLASS__);
		}
  }

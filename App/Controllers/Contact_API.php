<?php
	class Contact_API extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
      $this->loadModel(__CLASS__);
		}
    public function sendMail(){
      $this->model->msgAuth();
      //$this->model->sendMail();
    }
}

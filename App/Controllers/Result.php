<?php
	class Label extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Label", function () {
				$this->view->shops = $this->model->getShops();
				$this->view->labelname = $_GET["name"];
			});
		}
	}

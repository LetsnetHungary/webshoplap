<?php
	class Profile extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Profile", function () {
				$this->view->shop = $this->model->getShop();
				$this->view->categories = $this->model->getCategories();
			});
		}
	}

<?php
	class Admin extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Admin", function() {
				$this->view->categories = $this->model->getCategories();
			});
		}
	}

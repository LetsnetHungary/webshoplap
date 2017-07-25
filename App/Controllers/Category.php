<?php
	class Category extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Category", function () {
				$this->view->shops = $this->model->getShops();
				$this->view->catname = $this->model->getCatName();
			});
		}
	}

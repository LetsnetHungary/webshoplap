<?php
	class Category extends CoreApp\Controller {
		
		public function __construct($fuckid) {
			$_GET['fuckid'] = $fuckid;
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Category", function () {
				$id = $this->model->getCatID($_GET['fuckid']);
				$this->view->shops = $this->model->getShops($id);
				$this->view->catname = $this->model->getCatName($id);
			});
		}
	}

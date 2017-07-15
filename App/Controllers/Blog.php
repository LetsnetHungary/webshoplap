<?php
	class Blog extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
			$this->model = $this->loadModel(__CLASS__);
			$this->viewInit("Blog", function() {
				if (isset($_GET['post_id'])) {
					$this->view->blog_post = $this->model->postLekeres();

				}
				else{
					$this->view->blog_post = $this->model->blogLekeres();
				}
			});

		}
        /*
		public function cikkMegjelenites(){
			$this->model->blogLekeres();
		}*/
	}

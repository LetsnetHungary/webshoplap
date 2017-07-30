<?php
	class Blog extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
			$this->model = $this->loadModel(__CLASS__);
			$this->viewInit("Blog", function() {
					$this->view->blog_post = $this->model->blogLekeres();
					$this->view->SEO->seo->title = isset($_GET['post_id']) ? $this->view->blog_post[$_GET['post_id']]['blog_title'] : "Blog";
			});

		}
        /*
		public function cikkMegjelenites(){
			$this->model->blogLekeres();
		}*/
	}

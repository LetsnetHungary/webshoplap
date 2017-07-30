<?php
	class Blog extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
			$this->model = $this->loadModel(__CLASS__);
			$this->viewInit("Blog", function() {
					$this->view->blog_post = $this->model->blogLekeres();
					$this->view->SEO->seo->title = $this->view->blog_post[0]['blog_title'];
			});

		}
        /*
		public function cikkMegjelenites(){
			$this->model->blogLekeres();
		}*/
	}

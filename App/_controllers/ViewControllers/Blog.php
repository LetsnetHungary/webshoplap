<?php
	class Blog extends CoreApp\ViewController {

		public function __construct() {
			parent::__construct(__CLASS__);
			$this->model = $this->loadModel(__CLASS__);

		}
		public function cikkMegjelenites(){
			$this->model->blogLekeres();
		}



		/*
		public function modelDidLoad() {
			echo "<br> model loaded<br> ";
		}

		public function viewRenderEnded() {
			echo "<br>render ended";
		}
		*/
	}
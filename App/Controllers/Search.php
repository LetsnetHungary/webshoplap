<?php
	class Search extends CoreApp\Controller {

		public function __construct() {
			parent::__construct(__CLASS__);
      $this->loadModel(__CLASS__);
			$this->viewInit("Search", function(){
				$this->view->shops = $this->searchResult();
        $this->view->products = $this->productResult();
			});
		}
    public function searchResult(){
      //print_r($_POST); die();
      $key_word = $_GET['search_word'];
      return $this->model->search($key_word);
    }
    public function productResult() {
      return $this->model->product($_GET['search_word']);
    }
  }
 

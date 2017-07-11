<?php
    class Admin_API extends CoreApp\Controller {
        public function __construct() {
            parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
        }
        public function getShops() {
          $id = $_POST["id"];
          echo $this->model->getShops($id);
          return;
        }
        public function removeShop() {
          $id = $_POST["id"];
          $this->model->removeShop($id);
          return;
        }
    }
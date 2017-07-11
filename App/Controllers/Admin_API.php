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
        public function removeCategory() {
          $id = $_POST["id"];
          $this->model->removeCategory($id);
          return;
        }
        public function addCategory() {
            $name = $_POST["name"];
            $this->model->addCategory($name);
            return;
        }
        public function addShop() {
            $shop = $_POST["shop"];
            $shop = json_decode($shop);
            $this->model->addShop($shop);
            return;
        }
        public function pinShop() {
            $id = $_POST["id"];
            $pin = $_POST["pin"];
            $this->model->pinShop($id,$pin);
            return;
        }
    }
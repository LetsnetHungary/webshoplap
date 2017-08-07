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
        public function getShop() {
            $id = $_POST["id"];
            echo $this->model->getShop($id);
            return;
        }
        public function removeShop() {
          $id = $_POST["id"];
          $this->model->removeShop($id);
          return;
        }
        public function getBlog() {
          $id = $_POST["id"];
          print_r(json_encode($this->model->getBlog($id)));
          return;
        }
        public function pinProduct() {
          $id = $_POST["id"];
          $pin = $_POST['pin'];
          $this->model->pinProduct($id, $pin);
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
        public function pinShop() {
            $id = $_POST["id"];
            $pin = $_POST["pin"];
            $cat = $_POST["cat"];
            $this->model->pinShop($id,$pin,$cat);
            return;
        }
        public function updateShop() {
            $shop = $_POST["shop"];
            $this->model->updateShop($shop);
            return;
        }
        public function addPartnerShop() {
          $id = $_POST['id'];
          $this->model->addPartnerShop($id);
        }
        public function remPartnerShop() {
          $id = $_POST['id'];
          $this->model->remPartnerShop($id);
        }
        public function showPartners() {
            print_r($this->model->showPartners());
        }

        public function refreshPartnerURL() {
            $id = $_POST['id'];
            $url = $_POST['url'];
            return $this->model->refreshPartnerURL($id, $url);
        }

        public function handleusers() {
            print_r($this->model->handleUsers());
        }

        public function refreshUserEmail() {
            print_r($_POST);
            $id = $_POST['id'];
            $email = $_POST['email'];
            return($this->model->refreshUserEmail($id, $email));
        }

        public function refreshUserPassword() {
            $id = $_POST['id'];
            $password = $_POST['password'];
            return($this->model->refreshUserPassword($id, $password));
        }

        public function refreshUserShop() {
            $id = $_POST['id'];
            $shop = $_POST['shop'];
            return($this->model->refreshUserShop($id, $shop));
        }

        



        public function getAllShops() {
            print_r(json_encode($this->model->getAllShops()));
            return;
        }
        
        public function addShop() {
            $shop = $_POST["shop"];
            $shop = json_decode($shop);
            $this->model->addShop($shop);
            return;
        }

        public function getProducts() {
            $id = $_POST['id'];
            print_r(json_encode($this->model->getProducts($id)));
            return;
        }

        public function getLabels() {
            $id = $_POST['id'];
            print_r(json_encode($this->model->getLabels($id)));
            return;
        }

        public function getAllPartners() {
            print_r(json_encode($this->model->getAllPartners()));
            return;
        }

        public function addPartner(){
          $name = $_POST['name'];
          $link = $_POST['link'];
          $image = $_POST['image'];
          $this->model->addPartner($name, $link, $image);
          return;
        }

        public function deletePartner() {
            $id = $_POST['id'];
            $this->model->deletePartner($id);
            return;
        }

        public function getAllCategories() {
            print_r(json_encode($this->model->getAllCategories()));
            return;
        }

        public function getAllUsers() {
            print_r(json_encode($this->model->getAllUsers()));
            return;
        }

        public function addUser(){
          $email = $_POST['email'];
          $pw = $_POST['password'];
          $new_shop_name = $_POST['shop'];
          $this->model->addUser($email, $pw, $new_shop_name);
          return;
        }

        public function deleteUser() {
            $email = $_POST['email'];
            $this->model->deleteUser($email);
            return;
        }

        public function getAllBlogs() {
            print_r(json_encode($this->model->getAllBlogs()));
            return;
        }

        public function addBlog(){
          $blog_title = $_POST['title'];
          $blog_author = $_POST['author'];
          $blog_content = $_POST['content'];
          $blog_dataurl = $_POST['dataurl'];
          $blog_id = $_POST['id'];
          $blog_date = date("Y-m-d");
          $blog_subtitle = $_POST['subtitle'];
          $this->model->addBlog($blog_id, $blog_title, $blog_author, $blog_content, $blog_date, $blog_subtitle, $blog_dataurl);
        }

    }

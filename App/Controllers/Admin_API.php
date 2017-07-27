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
        public function addShop() {
            $shop = $_POST["shop"];
            $shop = json_decode($shop);
            $this->model->addShop($shop,false);
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
        public function addUser(){
          $email = $_POST['new_mail'];
          $pw = $_POST['new_pw'];
          $new_shop_name = $_POST['new_shop_name'];
          if ($this->model->addUser($email, $pw, $new_shop_name)) {
            header("Location: ../Admin?user_added");
          }

        }
        public function addBlog(){
          $blog_title = $_POST['blog-title'];
          $blog_author = $_POST['blog-author'];
          $blog_content = $_POST['blog-content'];
          $blog_dataurl = $_POST['dataurl'];
          $blog_date = date("Y-m-d");
          $blog_subtitle = $_POST['blog-subtitle'];
          $this->model->addBlog($blog_title, $blog_author, $blog_content, $blog_date, $blog_subtitle, $blog_dataurl);
          header("Location: ../Admin?blog_added");
        }
        public function addPartner() {
            $name = $_POST['pname'];
            $link = $_POST['plink'];
            $partnerlink = $_POST['partnerlink'];
            $this->model->addPartner($name, $link, $partnerlink);
            header("Location: ../Admin?partner_added");
            return;
        }

        public function showPartners() {
            print_r($this->model->showPartners());
        }

        public function deletePartner() {
            $id = isset($_POST['id']) ? $_POST['id'] : 'asdf';
            return $this->model->deletePartner($id);
        }

        public function refreshPartnerURL() {
            $id = $_POST['id'];
            $url = $_POST['url'];
            return $this->model->refreshPartnerURL($id, $url);
        }

    }

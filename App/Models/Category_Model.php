<?php
    class Category_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();
                $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
      }
      public function getShops() {
            if(isset($_GET['id'])) {
                $id = $_GET["id"];
                $stmt = $this->db->prepare("SELECT id,name,adress,phone FROM `shops` WHERE ((category = '".$id."') OR (category LIKE '".$id."; %') OR (category LIKE '%; ".$id."') OR (category LIKE '%; ".$id."; %'))");
                $stmt->execute(array());
                $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($shop) > 0){
                    return $shop;
                } else {
                    header('Location: Error');
                    exit();
                    return;
                }
            } else {
                header('Location: Error');
                exit();
                return;
            }
      }
      public function getCatName() {
            if(isset($_GET['id'])) {
                $id = $_GET["id"];
                $stmt = $this->db->prepare('SELECT name FROM `categories` WHERE id='.$id);
                $stmt->execute(array());
                $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($cat) > 0){
                    return $cat[0];
                } else {
                    header('Location: Error');
                    exit();
                    return;
                }
            } else {
                header('Location: Error');
                exit();
                return;
            }
      }
      
    }

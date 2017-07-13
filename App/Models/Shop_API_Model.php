<?php
    class Shop_API_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();          
          $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
      }
      public function getShop($id) {
          $stmt = $this->db->prepare('SELECT name, adress, phone FROM `shops` WHERE id='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $result = $result[0];
          $products = $this->getProducts($id);
          $result["products"] = $products;
          echo(json_encode($result));
          return;
      }

      public function getProducts($id) {
          $stmt = $this->db->prepare('SELECT imageid, price FROM `products` WHERE shop='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
    }
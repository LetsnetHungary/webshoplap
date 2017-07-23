<?php
    class Index_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();          
          $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));

      }
      public function getShops() {
          $shops = array();
          $stmt = $this->db->prepare('SELECT * FROM `categories`');
          $stmt->execute(array());
          $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($categories as $cat) {
              $shops[$cat["name"]]["pinned"] = [];
              $shops[$cat["name"]]["unpinned"] = [];
              $shops[$cat["name"]]["id"] = $cat["id"];
            $rem = 5;
            $stmt = $this->db->prepare("SELECT name, id FROM `shops` WHERE ((category = '".$cat['id']."') OR (category LIKE '".$cat['id']."; %') OR (category LIKE '%; ".$cat['id']."') OR (category LIKE '%; ".$cat['id']."; %')) AND ((pinned = '".$cat['id']."') OR (pinned LIKE '".$cat['id']."; %') OR (pinned LIKE '%; ".$cat['id']."') OR (pinned LIKE '%; ".$cat['id']."; %')) ORDER BY RAND() LIMIT 5");
            $stmt->execute();
            $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rem = $rem - count($shop);
            $shops[$cat["name"]]["pinned"] = $shop;
            if($rem > 0) {
                $stmt = $this->db->prepare("SELECT name, id FROM `shops` WHERE ((category = '".$cat['id']."') OR (category LIKE '".$cat['id']."; %') OR (category LIKE '%; ".$cat['id']."') OR (category LIKE '%; ".$cat['id']."; %')) AND ((pinned <> '".$cat['id']."') AND (pinned NOT LIKE '".$cat['id']."; %') AND (pinned NOT LIKE '%; ".$cat['id']."') AND (pinned NOT LIKE '%; ".$cat['id']."; %')) ORDER BY RAND() LIMIT ".$rem);
                $stmt->execute([
                    ":id" => $cat["id"]
                ]);
                $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $shops[$cat["name"]]["unpinned"] = $shop;
            }
          }
          return $shops;
      }
      public function getProducts() {
          $rem = 25;
          $stmt = $this->db->prepare('SELECT * FROM `products` WHERE pinned=1 ORDER BY RAND() LIMIT 25');
          $stmt->execute(array());
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $rem = $rem - count($products);
          $stmt = $this->db->prepare('SELECT * FROM `products` WHERE pinned=0 ORDER BY RAND() LIMIT '.$rem );
          $stmt->execute(array());
          $products = array_merge($products,$stmt->fetchAll(PDO::FETCH_ASSOC));
          shuffle($products);
          return $products;
      }
      public function getPartners() {
          $stmt = $this->db->prepare('SELECT * FROM `partners`');
          $stmt->execute(array());
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $products;
      }
    }
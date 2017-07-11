<?php
    class Admin_API_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();
          $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
      }
      public function getShops($id) {
          $stmt = $this->db->prepare('SELECT id,name FROM `shops` WHERE category='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return(json_encode($result));
      }
      public function removeShop($id) {
          $stmt = $this->db->prepare('DELETE FROM `shops` WHERE id= :id');
          $stmt->execute([
              ":id" => $id
          ]);
          $stmt = $this->db->prepare('DELETE FROM `labels` WHERE shop= :id');
          $stmt->execute([
              ":id" => $id
          ]);
          return;
      }
      public function removeCategory($id) {
          $stmt = $this->db->prepare('SELECT id FROM `shops` WHERE category = :id');
          $stmt->execute([
              ":id" => $id
          ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($result as $res) {
              $this->removeShop($res["id"]);
          }
          $stmt = $this->db->prepare('DELETE FROM `categories` WHERE id = :id');
          $stmt->execute([
              ":id" => $id
          ]);
          return;
      }
      public function addCategory($name) {
          $stmt = $this->db->prepare('INSERT INTO categories (name) VALUES (\''.$name.'\')');
          $stmt->execute([]);
          $stmt = $this->db->prepare('SELECT id FROM `categories` WHERE name = :name');
          $stmt->execute([
              ":name" => $name
          ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          echo('{ "name" : "'.$name.'", "id" : "'.$result[0]["id"].'"}');
          return;
      }
    }
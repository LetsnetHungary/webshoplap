<?php
    class Admin_API_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();
      }
      public function getShops($id) {
          $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
          $stmt = $db->prepare('SELECT id,name FROM `shops` WHERE category='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return(json_encode($result));
      }
      public function removeShop($id) {
          $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
          $stmt = $db->prepare('DELETE FROM ``');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return(json_encode($result));
      }
    }
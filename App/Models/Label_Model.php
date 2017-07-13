<?php
    class Label_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();
                $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
      }
      public function getShops() {
            if(isset($_GET['name'])) {
                $name = $_GET["name"];
                $stmt = $this->db->prepare('SELECT shop FROM `labels` WHERE name=\''.$name.'\'');
                $stmt->execute(array());
                $shopids = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $shops = [];
                foreach($shopids as $shop) {
                    $id = $shop["shop"];
                    $stmt = $this->db->prepare('SELECT id,name,adress,phone FROM `shops` WHERE id='.$id);
                    $stmt->execute(array());
                    $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    array_push($shops, $shop[0]);
                }
                if(count($shops) > 0){
                    return $shops;
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

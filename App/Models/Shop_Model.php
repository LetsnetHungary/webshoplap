<?php
	class Shop_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
            $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));

		}
        public function getLabels($id) {
                $stmt = $this->db->prepare('SELECT name FROM `labels` WHERE shop='.$id);
                $stmt->execute(array());
                $labels = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $labels;
        }
        public function getShop() {
            if(isset($_GET['id'])) {
                $id = $_GET["id"];
                $stmt = $this->db->prepare('SELECT id,name,adress,phone,bio,category FROM `shops` WHERE id='.$id);
                $stmt->execute(array());
                $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($shop) > 0){
                    $shop = $shop[0];
                    $shop["labels"] = $this->getLabels($id);
                    $shop["others"] = $this->getOtherShops($id,$shop["category"]);
                    $shop["products"] = $this->getProducts($id);
                } else {
                    header('Location: Error');
                    exit();
                }
            } else {
                header('Location: Error');
                exit();
            }
            return $shop;
        }

        public function getOtherShops($id,$cat) {
                $stmt = $this->db->prepare("SELECT id,name,adress,phone,pinned FROM `shops` WHERE ((category = '".$cat."') OR (category LIKE '".$cat."; %') OR (category LIKE '%; ".$cat."') OR (category LIKE '%; ".$cat."; %')) AND ((pinned = '".$cat."') OR (pinned LIKE '".$cat."; %') OR (pinned LIKE '%; ".$cat."') OR (pinned LIKE '%; ".$cat."; %')) AND id<>".$id." ORDER BY RAND()");
                $stmt->execute(array());
                $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt = $this->db->prepare("SELECT id,name,adress,phone,pinned FROM `shops` WHERE ((category = '".$cat."') OR (category LIKE '".$cat."; %') OR (category LIKE '%; ".$cat."') OR (category LIKE '%; ".$cat."; %')) AND ((pinned <> '".$cat."') AND (pinned NOT LIKE '".$cat."; %') AND (pinned NOT LIKE '%; ".$cat."') AND (pinned NOT LIKE '%; ".$cat."; %')) AND id<>".$id." ORDER BY RAND()");
                $stmt->execute(array());
                $shops2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return array_merge($shops,$shops2);
        }
        public function getProducts($id) {
          $stmt = $this->db->prepare('SELECT imageid, price FROM `products` WHERE shop='.$id.' ORDER BY position');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
	}

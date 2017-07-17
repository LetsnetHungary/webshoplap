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
                $stmt = $this->db->prepare('SELECT id,name,adress,phone,bio,category,image,facebook FROM `shops` WHERE id='.$id);
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

        public function getOtherShops($id,$cat2) {
                $shops = []; $shopids = [0];
                foreach(explode('; ', $cat2) as $cat) {
                    $stmt = $this->db->prepare("SELECT id,name,adress,phone,pinned,category,image FROM `shops` WHERE ((category = '".$cat."') OR (category LIKE '".$cat."; %') OR (category LIKE '%; ".$cat."') OR (category LIKE '%; ".$cat."; %')) AND ((pinned = '".$cat."') OR (pinned LIKE '".$cat."; %') OR (pinned LIKE '%; ".$cat."') OR (pinned LIKE '%; ".$cat."; %')) AND (id<>".$id.") AND (id NOT IN ('" . implode($shopids, "', '") . "')) ORDER BY RAND()");
                    $stmt->execute(array());
                    $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($shop as $a) {
                        array_push($shopids,$a['id']);
                    }
                    $shops = array_merge($shops, $shop);
                }
                $stmt = $this->db->prepare("SELECT id,name,adress,phone,pinned,category,image FROM `shops` WHERE ((category = '".$cat."') OR (category LIKE '".$cat."; %') OR (category LIKE '%; ".$cat."') OR (category LIKE '%; ".$cat."; %')) AND ((pinned <> '".$cat."') AND (pinned NOT LIKE '".$cat."; %') AND (pinned NOT LIKE '%; ".$cat."') AND (pinned NOT LIKE '%; ".$cat."; %')) AND (id<>".$id.") AND (id NOT IN ('" . implode($shopids, "', '") . "')) ORDER BY RAND()");
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
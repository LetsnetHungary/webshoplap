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
                $stmt = $this->db->prepare('SELECT * FROM `shops` WHERE id='.$id);
                $stmt->execute(array());
                $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($shop) > 0){
                    $shop = $shop[0];
                    $shop["labels"] = $this->getLabels($id);
                    $shop["others"] = $this->getOtherShops($id, $shop["category"]);
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

        public function getOtherShops($id, $cat2) {
                $shops = []; $shopids = [0];
                foreach(explode(';', $cat2) as $cat) {
                    $stmt = $this->db->prepare("SELECT id, name, adress, phone, pinned, category, image FROM `shops` WHERE category LIKE :category OR pinned LIKE :category ORDER BY RAND()");
                    $stmt->execute(array(
                        ":category" => "%$cat%"
                    ));
                    $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $sh = [];
                    foreach($shop as $s) {
                        if($s["category"] == $cat) {
                            array_push($sh, $s);
                        }
                        else {
                            $categories = explode(";", $s["category"]);
                            foreach($categories as $c) {
                                if($c == $cat) {
                                    array_push($sh, $s);
                                }
                            }
                        }
                    }
                    $shops = array_merge($shops, $sh);
                }
                return $shops;
        }
        public function getProducts($id) {
          $stmt = $this->db->prepare('SELECT * FROM `products` WHERE shop='.$id.' ORDER BY position');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
	}

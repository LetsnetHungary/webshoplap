<?php
	class Profile_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$this->shopid = $this->getShopId();
		}

		public function getShop(){
		  $id = $this->shopid;
          $stmt = $this->db->prepare('SELECT * FROM `shops` WHERE id='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $result = $result[0];
          $result["labels"] = $this->getLabels($id);
          $result["products"] = $this->getProducts($id);
          return($result);
		}
        public function getProducts($id) {
          $stmt = $this->db->prepare('SELECT id,imageid, price FROM `products` WHERE shop='.$id.' ORDER BY position');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      }
      public function getLabels($id) {
                $stmt = $this->db->prepare('SELECT name FROM `labels` WHERE shop='.$id);
                $stmt->execute(array());
                $labels = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $labels;
        }

		public function getShopId() {
		  session_start();
		  $stmt = $this->db->prepare('SELECT shop_id FROM `users` WHERE email= :email');
          $stmt->execute([
			  ":email" => $_SESSION["email"]
		  ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		  return $result[0]["shop_id"];
		}
		
		public function getCategories(){
            $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $this->db->prepare("SELECT * FROM categories");
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$cats = array();
			foreach($result as $res) {
				$cats[$res['id']] = $res['name'];
			}
			return $cats;
		}

	}

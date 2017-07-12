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
                $stmt = $this->db->prepare('SELECT id,name,adress,phone FROM `shops` WHERE category='.$cat.' AND id<>'.$id);
                $stmt->execute(array());
                $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $shops;
        }
	}

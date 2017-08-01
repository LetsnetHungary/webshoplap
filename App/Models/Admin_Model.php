<?php
	class Admin_Model extends CoreApp\Model
	{
		public function __construct()
		{
			
            $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			parent::__construct();
		}
		public function getCategories(){
			$stmt = $this->db->prepare("SELECT * FROM categories");
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$cats = array();
			foreach($result as $res) {
				$cats[$res['id']] = $res['name'];
			}
			return $cats;
		}

		public function getBlogs(){
			$stmt = $this->db->prepare("SELECT * FROM blog");
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}


	}

<?php
	class Admin_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function getCategories(){
            $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $db->prepare("SELECT * FROM categories");
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}


	}

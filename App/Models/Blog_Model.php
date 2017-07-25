<?php
	class Blog_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function blogLekeres(){
      $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $db->prepare("SELECT * FROM blog ORDER BY blog_id DESC");
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		public function postLekeres(){
			$db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
			$stmt = $db->prepare("SELECT * FROM blog WHERE blog_id = :id");
			$stmt->execute([
				":id"=>$_GET['post_id']
			]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}


	}

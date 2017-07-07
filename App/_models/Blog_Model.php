<?php
	class Blog_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function blogLekeres(){
			$db = $this->db->PDOConnection(CoreApp\AppConfig::getData("database=>blog"));
			$stmt = $db->prepare("SELECT blog.blog_title, blog.blog_author, blog.blog_content, blog.blog_date FROM blog");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			print_r($result);
			// return $result;
		}


	}

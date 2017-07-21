<?php
	class Search_Model extends CoreApp\Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));

		}
    public function search($key_word){
      $key_word = "%" . $key_word . "%";
      $stmt = $this->db->prepare("SELECT `id` FROM `shops` WHERE name LIKE :key_word");
      $stmt->execute([
        ":key_word"=>$key_word
      ]);
      $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $this->db->prepare("SELECT `shop` AS `id` FROM `labels` WHERE name LIKE :key_word");
      $stmt->execute([
        ":key_word"=>$key_word
      ]);
      $search_result = array_merge($search_result, $stmt->fetchAll(PDO::FETCH_ASSOC));
			$stmt = $this->db->prepare("SELECT `shop` AS `id` FROM `products` WHERE name LIKE :key_word");
			$stmt->execute([
        ":key_word"=>$key_word
      ]);
			$search_result = array_merge($search_result, $stmt->fetchAll(PDO::FETCH_ASSOC));


			$shops = [];
			foreach ($search_result as $id) {
				$id = $id['id'];
				$stmt = $this->db->prepare("SELECT id, name, adress, phone, image, facebook FROM `shops` WHERE id = :id");
	      $stmt->execute([
	        ":id"=>$id
	      ]);
				$shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if(!in_array($shop[0], $shops)){
				array_push($shops, $shop[0]);
				}
			}
			shuffle($shops);
      return $shops;
    }
		public function product($kw) {
			$kw = "%".$kw."%";
			$stmt = $this->db->prepare("SELECT * FROM `products` WHERE name LIKE :key_word");
			$stmt->execute([
        ":key_word"=>$kw
      ]);
			$prods = $stmt->fetchAll(PDO::FETCH_ASSOC);
			shuffle($prods);
			return $prods;
		}
  }

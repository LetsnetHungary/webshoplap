<?php
    class Admin_API_Model extends CoreApp\Model {
      public function __construct() {
          parent::__construct();
          $this->db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
      }
      public function getLabels($id) {
                $stmt = $this->db->prepare('SELECT name FROM `labels` WHERE shop='.$id);
                $stmt->execute(array());
                $labels = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $labels;
        }
      public function getShops($id) {
          $stmt = $this->db->prepare('SELECT id,name,pinned FROM `shops` WHERE category='.$id.' AND pinned=1 ORDER BY name');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $stmt = $this->db->prepare('SELECT id,name,pinned FROM `shops` WHERE category='.$id.' AND pinned=0 ORDER BY name');
          $stmt->execute(array());
          $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return(json_encode(array_merge($result,$result2)));
      }
      public function getShop($id) {
          $stmt = $this->db->prepare('SELECT * FROM `shops` WHERE id='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $result = $result[0];
          $result["labels"] = $this->getLabels($id);
          return(json_encode($result));
      }
      public function removeShop($id) {
          $stmt = $this->db->prepare('DELETE FROM `shops` WHERE id= :id');
          $stmt->execute([
              ":id" => $id
          ]);
          $stmt = $this->db->prepare('DELETE FROM `labels` WHERE shop= :id');
          $stmt->execute([
              ":id" => $id
          ]);
          return;
      }
      public function removeCategory($id) {
          $stmt = $this->db->prepare('SELECT id FROM `shops` WHERE category = :id');
          $stmt->execute([
              ":id" => $id
          ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($result as $res) {
              $this->removeShop($res["id"]);
          }
          $stmt = $this->db->prepare('DELETE FROM `categories` WHERE id = :id');
          $stmt->execute([
              ":id" => $id
          ]);
          return;
      }
      public function addCategory($name) {
          $stmt = $this->db->prepare('INSERT INTO categories (name) VALUES (\''.$name.'\')');
          $stmt->execute([]);
          $stmt = $this->db->prepare('SELECT id FROM `categories` WHERE name = :name');
          $stmt->execute([
              ":name" => $name
          ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          echo('{ "name" : "'.$name.'", "id" : "'.$result[0]["id"].'"}');
          return $result[0]["id"];
      }
      public function addShop($shop) {
          if(property_exists($shop, 'pinned')) {
                $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category,pinned) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->pinned.'\')');
          } else {
                $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\')');
          }
          $stmt->execute([]);
          $stmt = $this->db->prepare('SELECT id FROM `shops` WHERE name = :name');
          $stmt->execute([
              ":name" => $shop->name
          ]);
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $id = $result[0]["id"];
          foreach($shop->labels as $label) {
              $stmt = $this->db->prepare('INSERT INTO labels (name,shop) VALUES (\''.$label.'\',\''.$id.'\')');
              $stmt->execute([]);
          }
          echo('{ "name" : "'.$shop->name.'", "id" : "'.$id.'"}');
          return;
      }
      /*public function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
      public function generate() {
          for($i=0; $i < 14; $i++) {
            $name = $this->generateRandomString(8);
            $id = $this->addCategory($name);
            echo 'asd';
            for($j=0; $j < 60; $j++) {
                $shop = new stdClass();
                $shop->name = $this->generateRandomString();
                $shop->adress = $this->generateRandomString(7);
                $shop->phone = $this->generateRandomString();
                $shop->bio = file_get_contents('http://loripsum.net/api/2/short/plaintext');
                $shop->category = $id;
                $this->addShop($shop);
            }
          }
      }*/
      public function pinShop($id,$pin) {
          $stmt = $this->db->prepare('UPDATE `shops` SET pinned='.$pin.' WHERE id='.$id);
          $stmt->execute([]);
        return;
      }
      public function updateShop($shop) {
          $shop = json_decode($shop);
          $this->removeShop($shop->id);
          $this->addShop($shop);
          return;
      }
      public function addUser($email, $pw, $new_shop_id){
        $pw = password_hash($pw, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO `users`(`email`, `password`, `is_admin`, `shop_id`) VALUES (:email, :password, '0', :shop_id)");
        $stmt->execute([
          ":email"=>$email,
          ":password"=>$pw,
          ":shop_id"=>$new_shop_id
        ]);
        return;
      }
    }

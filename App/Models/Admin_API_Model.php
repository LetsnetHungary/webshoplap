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
          $stmt = $this->db->prepare("SELECT id,name,pinned FROM `shops` WHERE ((category = '".$id."') OR (category LIKE '".$id."; %') OR (category LIKE '%; ".$id."') OR (category LIKE '%; ".$id."; %')) AND ((pinned = '".$id."') OR (pinned LIKE '".$id."; %') OR (pinned LIKE '%; ".$id."') OR (pinned LIKE '%; ".$id."; %')) ORDER BY name");
          $stmt->execute(array(
              ":cat" => $id,
              ":pin" => $id
          ));
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $stmt = $this->db->prepare("SELECT id,name,pinned FROM `shops` WHERE ((category = '".$id."') OR (category LIKE '".$id."; %') OR (category LIKE '%; ".$id."') OR (category LIKE '%; ".$id."; %')) AND ((pinned <> '".$id."') AND (pinned NOT LIKE '".$id."; %') AND (pinned NOT LIKE '%; ".$id."') AND (pinned NOT LIKE '%; ".$id."; %')) ORDER BY name");
          $stmt->execute(array(
              ":cat" => $id,
              ":pin" => $id
          ));
          $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return(json_encode(array_merge($result,$result2)));
      }
      public function getShop($id) {
          $stmt = $this->db->prepare('SELECT * FROM `shops` WHERE id='.$id);
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $result = $result[0];
          $result["labels"] = $this->getLabels($id);
          $result["products"] = $this->getProducts($id);
          return(json_encode($result));
      }
        public function getProducts($id) {
          $stmt = $this->db->prepare('SELECT id,imageid, price FROM `products` WHERE shop='.$id.' ORDER BY position');
          $stmt->execute(array());
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
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
      public function addShop($shop,$bool) {
          if($bool){
            if(property_exists($shop, 'pinned')) {
                    $stmt = $this->db->prepare('INSERT INTO shops (id,name,adress,phone,bio,category,pinned) VALUES (\''.$shop->id.'\',\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->pinned.'\')');
            } else {
                    $stmt = $this->db->prepare('INSERT INTO shops (id,name,adress,phone,bio,category) VALUES (\''.$shop->id.'\',\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\')');
            }
          } else {
            if(property_exists($shop, 'pinned')) {
                    $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category,pinned) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->pinned.'\')');
            } else {
                    $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\')');
            }
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
          if($bool) {
              foreach($shop->deleted as $delid) {
                $stmt = $this->db->prepare('SELECT imageid FROM `products` WHERE id='.$delid);
                $stmt->execute([]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt = $this->db->prepare('DELETE FROM `products` WHERE id='.$delid);
                $stmt->execute([]);
                unlink('assets/images/products/'.$result[0]['imageid'].'.jpg');
              }
          }
              $i = 1;
          foreach($shop->products as $product) {
              if($product->type == 'old') {
                $stmt = $this->db->prepare('UPDATE `products` SET position='.$i.' WHERE id='.$product->id);
                $stmt->execute([]);
              } else {
                $stmt = $this->db->prepare('SELECT imageid FROM `products` ORDER BY imageid DESC LIMIT 1');
                $stmt->execute([]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $prodmaxid = $result[0]['imageid'];
                $uriPhp = 'data://' . substr($product->image, 5);
                $binary = file_get_contents($uriPhp);
                file_put_contents('assets/images/products/'.($prodmaxid+1).'.jpg',$binary);
                $stmt = $this->db->prepare('INSERT INTO products (imageid,position,shop,price) VALUES (:imageid, :position, :shop, :price)');
                $stmt->execute([
                    ":imageid" => $prodmaxid+1,
                    ":position" => $i,
                    ":shop" => $id,
                    ":price" => $product->price
                ]);
              }
              $i++;
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
      }
      public function getLabels(){ <-- label feltöltés db-bes
        $labels = [];
        $stmt = $this->db->prepare("SELECT * FROM `teszt` WHERE 1");
        $stmt->execute([]);
        $labels = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($labels as $label) {
          $multiple = explode(", ", $label["label"]);
          for ($i=0; $i < count($multiple); $i++) {
            $stmt = $this->db->prepare("INSERT INTO `labels`(`name`, `shop`) VALUES (:name, :shop)");
            $stmt->execute([
              ":name"=>$multiple[$i],
              ":shop"=>$label["id"]
            ]);
          }
        }
        return;
      }*/

      public function pinShop($id,$pin,$cat) {
          $stmt = $this->db->prepare('SELECT pinned FROM `shops` WHERE id='.$id);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0]['pinned'];
        
            if($pin == 1) {
                if($result == 0) {
                    $newpin = $cat;
                } else {
                    $newpin = $result.'; '.$cat;
                }
            } else {
                $newpin = str_replace('-1', $cat, $result);
            }
          $stmt = $this->db->prepare('UPDATE `shops` SET pinned='.$newpin.' WHERE id='.$id);
          $stmt->execute([]);
        return;
      }
      public function updateShop($shop) {
          $shop = json_decode($shop);
          $this->removeShop($shop->id);
          $this->addShop($shop,true);
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

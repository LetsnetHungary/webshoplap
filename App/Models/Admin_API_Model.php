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
          $stmt = $this->db->prepare('SELECT id,imageid, price,pinned FROM `products` WHERE shop='.$id.' ORDER BY position');
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
      public function pinProduct($id, $pin) {
        $stmt = $this->db->prepare('UPDATE `products` SET pinned='.$pin.' WHERE id='.$id);
        $stmt->execute([]);
      }
      public function addShop($shop,$bool) {
          if($bool){
            if(property_exists($shop, 'pinned')) {
                    $stmt = $this->db->prepare('INSERT INTO shops (id,name,adress,phone,bio,category,pinned, image,facebook) VALUES (\''.$shop->id.'\',\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->pinned.'\',\''.$shop->image.'\',\''.$shop->facebook.'\')');
            } else {
                    $stmt = $this->db->prepare('INSERT INTO shops (id,name,adress,phone,bio,category, image, facebook) VALUES (\''.$shop->id.'\',\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->image.'\',\''.$shop->facebook.'\')');
            }
          } else {
            if(property_exists($shop, 'pinned')) {
                    $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category,pinned, image, facebook) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->pinned.'\',\''.$shop->image.'\',\''.$shop->facebook.'\')');
            } else {
                    $stmt = $this->db->prepare('INSERT INTO shops (name,adress,phone,bio,category, image, facebook) VALUES (\''.$shop->name.'\',\''.$shop->adress.'\',\''.$shop->phone.'\',\''.$shop->bio.'\',\''.$shop->category.'\',\''.$shop->image.'\',\''.$shop->facebook.'\')');
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
                if(file_exists('assets/images/products/'.$result[0]['imageid'].'.png')) {
                unlink('assets/images/products/'.$result[0]['imageid'].'.png');
                }
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
                if(count($result) > 0) {
                $prodmaxid = $result[0]['imageid'];
                } else {
                    $prodmaxid = 0;
                }
                $uriPhp = 'data://' . substr($product->image, 5);
                $binary = file_get_contents($uriPhp);
                file_put_contents('assets/images/products/'.($prodmaxid+1).'.png',$binary);
                $stmt = $this->db->prepare('INSERT INTO products (imageid,position,shop,price, name, link) VALUES (:imageid, :position, :shop, :price, :name, :link)');
                $stmt->execute([
                    ":imageid" => $prodmaxid+1,
                    ":position" => $i,
                    ":shop" => $id,
                    ":price" => $product->price,
                    ":name" => $product->name,
                    ":link" => $product->link
                ]);
              }
              $i++;
          }
          echo('{ "name" : "'.$shop->name.'", "id" : "'.$id.'"}');
          return;
      }

      public function getBlog($id){
			$stmt = $this->db->prepare("SELECT * FROM blog WHERE blog_id=".$id);
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
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

      public function addPartnerShop($id) {
        $stmt = $this->db->prepare('SELECT pinned FROM `shops` WHERE id='.$id);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0]['pinned'];
        if($result == 0) {
            $stmt = $this->db->prepare('UPDATE `shops` SET pinned=-1 WHERE id='.$id);
            $stmt->execute([]);
        }
      }

      public function remPartnerShop($id) {
        $stmt = $this->db->prepare('SELECT pinned FROM `shops` WHERE id='.$id);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0]['pinned'];
        if($result == -1) {
            $stmt = $this->db->prepare('UPDATE `shops` SET pinned=0 WHERE id='.$id);
            $stmt->execute([]);
        }
      }

      public function pinShop($id,$pin,$cat) {
          $stmt = $this->db->prepare('SELECT pinned FROM `shops` WHERE id='.$id);
        $stmt->execute([]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0]['pinned'];
            //print_r($result.', '.$pin.', '.$cat.'\n');
            if($pin == 1) {
                if($result == 0) {
                    $newpin = $cat;
                } else {
                    $a = explode('; ', $result);
                    array_push($a,$cat);
                    $newpin = implode('; ',$a);
                }
            } else {
                $a = explode('; ', $result);
                $a = array_diff( $a, [$cat] );
                $newpin = implode('; ',$a);
            }
            //print_r($newpin.', '.$id);
          $stmt = $this->db->prepare("UPDATE `shops` SET pinned='".$newpin."' WHERE id=".$id);
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
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([
          ":email"=>$email
        ]);
        if (count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0) {
          echo "Az email cím már használatban van";
          return false;
        }
        $pw = password_hash($pw, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO `users`(`email`, `password`, `is_admin`, `shop_id`) VALUES (:email, :password, '0', :shop_id)");
        $stmt->execute([
          ":email"=>$email,
          ":password"=>$pw,
          ":shop_id"=>$new_shop_id
        ]);
        return true;
      }
      public function addBlog($blog_id, $blog_title, $blog_author, $blog_content, $blog_date, $blog_subtitle, $blog_dataurl){
          if($blog_id == 0) {
          $stmt = $this->db->prepare('SELECT id FROM `blog` ORDER BY id DESC LIMIT 1');
                $stmt->execute([]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $prodmaxid = $result[0]['id'];
                $uriPhp = 'data://' . substr($blog_dataurl, 5);
                $binary = file_get_contents($uriPhp);
                file_put_contents('assets/images/blogs/'.($prodmaxid+1).'.png',$binary);
        $stmt = $this->db->prepare("INSERT INTO blog (blog_title, blog_author, blog_content, blog_date, blog_subtitle) VALUES (:blog_title, :blog_author, :blog_content, :blog_date, :blog_subtitle)");
        $stmt->execute([
          ":blog_title"=>$blog_title,
          ":blog_author"=>$blog_author,
          ":blog_content"=>$blog_content,
          ":blog_date"=>$blog_date,
          ":blog_subtitle"=>$blog_subtitle
        ]);
          } else {
                $prodmaxid = $blog_id;
                if(strlen($blog_dataurl) > 100) {
                    $uriPhp = 'data://' . substr($blog_dataurl, 5);
                    $binary = file_get_contents($uriPhp);
                    unlink('assets/images/blogs/'.($prodmaxid+1).'.png');
                    file_put_contents('assets/images/blogs/'.($prodmaxid+1).'.png',$binary);
                }
                $stmt = $this->db->prepare("UPDATE blog SET `blog_title`=:blog_title,`blog_author`=:blog_author,`blog_content`=:blog_content,`blog_date`=:blog_date,`blog_subtitle`=:blog_subtitle WHERE blog_id=".$blog_id);
                $stmt->execute([
                ":blog_title"=>$blog_title,
                ":blog_author"=>$blog_author,
                ":blog_content"=>$blog_content,
                ":blog_date"=>$blog_date,
                ":blog_subtitle"=>$blog_subtitle
                ]);
          }
        return;
      }
      public function addPartner($pname, $plink, $partnerlink) {
        $stmt = $this->db->prepare("INSERT INTO partners (name, image, url) VALUES (:name, :link, :url)");
        $stmt->execute([
          ":name"=>$pname,
          ":link"=>$plink,
          ":url"=>$partnerlink
        ]);
        return;
      }

      public function showPartners() {
        $stmt = $this->db->prepare('SELECT * FROM partners');
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
      }

      public function deletePartner($id) {
        $stmt = $this->db->prepare('DELETE FROM partners WHERE id = :id');
        $stmt->execute([
            ":id" => $id
        ]);
      }

      public function refreshPartnerURL($id, $url) {
        $stmt = $this->db->prepare('UPDATE partners SET url = :url WHERE id = :id');
        $stmt->execute([
            ":id" => $id,
            ':url' => $url
        ]);
        return;
      }

      public function handleUsers() {
          $stmt = $this->db->prepare("SELECT users.id, users.email, users.password, users.shop_id, shops.name FROM users INNER JOIN shops ON (users.shop_id = shops.id)");
          $stmt->execute();
          return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
      }

      public function refreshUserEmail($id, $email) {
          echo $id; echo $email;
            $stmt = $this->db->prepare("UPDATE users SET email = :email WHERE id = :id");
            $stmt->execute([
                ":email" => $email,
                ":id" => $id
            ]);
        }

        public function refreshUserPassword($id, $password) {
            $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->execute([
                ":password" => password_hash($password, PASSWORD_BCRYPT),
                ":id" => $id
            ]);
        }

        public function refreshUserShop($id, $shop) {
            $stmt = $this->db->prepare("SELECT id FROM shops WHERE name = :name");
            $stmt->execute([
                ":name" => $shop
            ]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->db->prepare("UPDATE users SET shop_id = :shop_id WHERE id = :id");
            $stmt->execute([
                ":shop_id" => $result[0]['id'],
                ":id" => $id
            ]);
        }

        public function deleteUser($id) {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([
                ":id" => $id
            ]);
        }
    }

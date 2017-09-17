<?

    class Error_Model extends CoreApp\Model {

        public function checkCategoryRoute($category) {
            $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
            $stmt = $db->prepare("SELECT * FROM categories WHERE fuckid = :fuckid");
            $stmt->execute([
                ":fuckid" => $category
            ]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($category == "Error") {
                return true;
            }
            else if ($result) {
                return $this->getShops($result[0]["id"]);
            }
            else {
                header("location: ../Error");
            }
            

        }

        public function getShops($id) {
            //echo $id;
            $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
            $stmt = $db->prepare("SELECT id, name, adress, phone, image, facebook, pinned FROM `shops` WHERE ((category = '".$id."') OR (category LIKE '".$id."; %') OR (category LIKE '%; ".$id."') OR (category LIKE '%; ".$id."; %')) AND ((pinned = '".$id."') OR (pinned LIKE '".$id."; %') OR (pinned LIKE '%; ".$id."') OR (pinned LIKE '%; ".$id."; %'))");
            $stmt->execute(array());
            $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
            shuffle($shop);
            $stmt = $db->prepare("SELECT id, name, adress, phone, image, facebook, pinned FROM `shops` WHERE ((category = '".$id."') OR (category LIKE '".$id."; %') OR (category LIKE '%; ".$id."') OR (category LIKE '%; ".$id."; %')) AND ((pinned <> '".$id."') AND (pinned NOT LIKE '".$id."; %') AND (pinned NOT LIKE '%; ".$id."') AND (pinned NOT LIKE '%; ".$id."; %'))");
            $stmt->execute(array());
            $s2 =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            shuffle($s2);
            $shop = array_merge($shop, $s2);
            if(count($shop) > 0){
                for($i = 0; $i < count($shop); $i++) {
                    $products = $this->getProducts($shop[$i]['id']);
                    $shop[$i]['products'] = $products;
                }
                return $shop;
            } else {
                echo "hiba 1";
            }
      }

      public function getProducts($id) {
        $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
        $stmt = $db->prepare('SELECT imageid, price FROM `products` WHERE shop='.$id.' ORDER BY position');
        $stmt->execute(array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function getCatName($category) {
        $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
        $stmt = $db->prepare("SELECT * FROM categories WHERE fuckid = :fuckid");
        $stmt->execute([
            ":fuckid" => $category
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
        $stmt->execute(array(":id" => $result[0]["id"]) );
        $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($cat) > 0){
            return $cat[0];
        } else {
           echo "asdbfasd";
        }
        }



    }
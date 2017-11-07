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
            $stmt = $db->prepare("SELECT * FROM shops WHERE category = :cat OR category LIKE concat('%', :catlike, '%') AND pinned != :cat AND pinned NOT LIKE concat('%', :catlike, '%')");
            $stmt->execute([
                ":cat" => $id,
                ":catlike" => $id
            ]);
            $shop = $stmt->fetchAll(PDO::FETCH_ASSOC);
            shuffle($shop);
            $stmt = $db->prepare("SELECT * FROM shops WHERE pinned = :cat OR pinned LIKE concat('%', :catlike, '%')");
            $stmt->execute([
                ":cat" => $id,
                ":catlike" => $id
            ]);
            $s2 =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $shop = array_merge($s2, $shop);
            $sc = count($shop) > count($s2) ? count($shop) : count($s2);
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
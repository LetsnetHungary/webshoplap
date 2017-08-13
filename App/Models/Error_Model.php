<?

    class Error_Model extends CoreApp\Model {

        public function checkCategoryRoute($category) {
            $db = CoreApp\DB::init(CoreApp\AppConfig::getData("database=>webshoplap"));
            $stmt = $db->prepare("SELECT * FROM categories WHERE fuckid = :fuckid");
            $stmt->execute([
                ":fuckid" => $category
            ]);


            print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

        }

    }
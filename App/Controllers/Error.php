<?

    class Error extends CoreApp\Controller {

        public function __construct() {
            $this->loadModel(__CLASS__);
        }

        public function checkCategoryRoute() {
            $category = explode("/", $_GET["url"])[0];
            print_r($this->model->checkCategoryRoute($category));
        }
    }
<?

    class Error extends CoreApp\Controller {

        public function __construct() {
            $this->loadModel(__CLASS__);
        }

        public function checkCategoryRoute() {

            $category = explode("/", $_GET["url"])[0];
            
            if($category == "Error") {
                $this->viewInit("Error", function () use ($category) { });
            }
            else {
                $this->viewInit("Category", function () use ($category) {
                    $category = explode("/", $_GET["url"])[0];
                    $this->view->shops = $this->model->checkCategoryRoute($category);
                    $this->view->catname = $this->model->getCatName($category);
                    $this->view->SEO->seo->title = $this->view->catname['name'];	
                });
            } 
        }
    }
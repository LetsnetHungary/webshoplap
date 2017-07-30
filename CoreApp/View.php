<?

    namespace CoreApp;

        class View {

            private $vName;
            private $files;
            public $SEO;

            public function __construct($vName) {
                $this->vName = $vName;
                $this->files = [];
                $this->SEO = [];
            }

            private function files() {
                $this->files["head"] = "Views/includes/main/head.php";
                $this->files["header"] = "Views/includes/main/header.php";
                $this->files["view"] = "Views/$this->vName/main.php";
                $this->files["footer"] = "Views/includes/main/footer.php";
            }

            public function viewJSON() {
                $json = "Views/$this->vName/$this->vName.json";
                $json = file_exists($json) ? json_decode(file_get_contents($json)) : 0;
                $this->SEO = $json ? $json : 0;
            }

            public function render() {
                $this->files();
                foreach($this->files as $file) {
                    include($file);
                }
            }

        }
<?php
	class Admin extends CoreApp\Controller {

		public function __construct() {
			ob_start();
			session_start();
			parent::__construct(__CLASS__);
			$this->loadModel(__CLASS__);
			$this->viewInit("Admin", function() {
				$this->view->categories = $this->model->getCategories();
			});
			$this->isLoggedIn();
		}
		public function isLoggedIn(){
			if ((time() - $_SESSION['time_logged_in']) > 3600) {
				header('Location: Login?message=server_timeout');
			}
			else {
				echo "Sikeresen bejelentkeztél, mint admin. Email cím: </br>" . $_SESSION['email'];
				$time_elapsed = round((time() - $_SESSION['time_logged_in']) / 60);
				print_r("</br>Bejelentkezésed óta ". $time_elapsed . " perc telt el.");
			}
		}

	}

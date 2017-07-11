<?php
	class Admin extends CoreApp\Controller {

		public function __construct() {
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
				echo "You are timed out";
				session_destroy();
				header("Location: Index");
			}
			else {
				echo "Sikeresen bejelentkeztél, mint admin. Email cím: </br>" . $_SESSION['email'];
				$time_elapsed = round((time() - $_SESSION['time_logged_in']) / 60);
				print_r("</br>Bejelentkezésed óta ". $time_elapsed . " perc telt el.");
			}
		}

	}

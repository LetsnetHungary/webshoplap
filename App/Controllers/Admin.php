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
			if ($_SESSION['is_admin']!=1) {
				header('Location: ../Profile');
				return;
			}
			else {
				if (!isset($_SESSION['time_logged_in'])) {
					header("Location: Login");
					$_SESSION = [];
				}
				elseif ((time() - $_SESSION['time_logged_in']) > 3600) {
					header('Location: Login?message=server_timeout');
					$_SESSION = [];
				}
				elseif(isset($_SESSION['email'])) {
					echo "Sikeresen bejelentkeztél, mint admin. Email cím: </br>" . $_SESSION['email'];
					$time_elapsed = round((time() - $_SESSION['time_logged_in']) / 60);
					print_r("</br>Bejelentkezésed óta ". $time_elapsed . " perc telt el.");
				}
			}
		}

	}

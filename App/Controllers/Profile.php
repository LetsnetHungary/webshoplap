<?php
	class Profile extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			ob_start();
			session_start();
			$this->loadModel(__CLASS__);
			$this->viewInit("Profile", function () {
				$this->view->shop = $this->model->getShop();
				$this->view->categories = $this->model->getCategories();
			});
			$this->isLoggedIn();
			ob_flush();
		}

		public function isLoggedIn(){
			if ($_SESSION['is_admin']!=0) {
				header('Location: ../Admin');
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
				}
			}
		}
	}

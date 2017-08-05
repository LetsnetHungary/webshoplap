<?php
	class Profile extends CoreApp\Controller {
		
		public function __construct() {
			parent::__construct(__CLASS__);
			ob_start();
			session_start();
			$this->isLoggedIn();
			$this->loadModel(__CLASS__);
			
			$this->viewInit("Profile", function () {
				$this->view->shop = $this->model->getShop();
				$this->view->categories = $this->model->getCategories();
			});
			
			ob_flush();
		}

		public function isLoggedIn(){
			if ($_SESSION['is_admin'] == 1) {
				header('Location: ../Admin');
				return;
			}
			else {
				if (!isset($_SESSION['time_logged_in'])) {
					$_SESSION = [];
					header("Location: Login");
					
				}
				elseif ((time() - $_SESSION['time_logged_in']) > 3600) {
					$_SESSION = [];
					header('Location: Login?message=server_timeout');
					
				}
				elseif(!isset($_SESSION['email'])) {
					header('Location: Login?message=server_timeout');
				}
			}
		}
	}

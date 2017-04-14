<?php  
	class Dashboard extends Controller {
		function __construct($dir){
			parent::__construct($dir);
			$this->handleLogin();
		}

		function index(){
			$this->view->title = "Dashboard";
			$data = $this->model->get_user_by_id($_SESSION["user_login"]);
			if ($data == false) {
				$this->logout();
			}
			$this->view->username = $data['username'];
			$this->view->render("dashboard/index");

		}

		function logout(){
			@session_start();
			unset($_SESSION['user_login']);
			if (isset($_COOKIE['user_login'])) {
				setcookie('user_login', $_COOKIE['user_login'], time() + (86400), "/");
			}
			Url::redirect("../../index");
			exit();
		}

		function handleLogin(){
			@session_start();
			$logged = $_SESSION['user_login'];
			if($logged == false){
				header('location: ../login');
				exit;
			}
		}
		
	}
?>
<?php  
	class Dashboard extends Controller {
		function __construct($dir){
			parent::__construct($dir);
			$this->handleLogin();
		}

		function index(){
			$this->view->title = "Dashboard";
			$data = $this->model->get_admin_by_email($_SESSION["admin_login"]);
			$this->view->username = $data["username"];

			$data = $this->model->get_all_user();
			$table = "";

			if (isset($data) && !empty($data) && $data != null ) {
				foreach ($data as $row) {
					$table .= "<a href='#' class='list-group-item'>
                                        <span class='badge'>time</span>
                                        <i class='fa fa-fw fa-user'></i> {$row['username']} - {$row['email']}
                                    </a>";
				}
				
			}
			
			
			$this->view->data = $table;


			$this->view->render("dashboard/index");

		}

		function logout(){
			@session_start();
			unset($_SESSION['admin_login']);
			if (isset($_COOKIE['admin_login'])) {
				setcookie('admin_login', $_COOKIE['admin_login'], time() + (86400), "/");
			}
			Url::redirect("../../index");
			exit();
		}

		function handleLogin(){
			@session_start();
			$logged = $_SESSION['admin_login'];
			if($logged == false){
				header('location: login');
				exit;
			}
		}
		
	}
?>
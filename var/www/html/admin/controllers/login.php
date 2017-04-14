<?php  
class Login extends Controller {
	function __construct($dir){
		parent::__construct($dir);
	}

	function index(){
		$this->view->title = 'Login';
		$this->login();
		$this->view->render('login/index', true);
		//echo "admin";
	}

	function login(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = Val::input($_POST['email']);
			$password = Val::input($_POST['password']);
			$remember = null;
			if (isset($_POST['remember'])) {
				$remember = $_POST['remember'];
			}



			$data = $this->model->get_admin_by_email($email);

			$flag = NULL;

			if($data != NULL){
				if($data['password'] == $password ) {
					$flag = true;
				}
				else {
					$pass_error = "password is failed";
				}
			}
			else {
				$user_error = "user is wrong";
			}

			

			if($flag){
				Session::init();
				if(isset($remember)){
					
					Session::set("admin_login", $data['email']);
					setcookie('admin_login', $data['email'], time() + (86400), "/");
					Url::redirect("dashboard");	

				}
				else {
					
					Session::set("admin_login", $data['email']);
					Url::redirect("dashboard");	
				}

			}


			if(isset($user_error)) $this->view->msg_user = "<div class='alert_error'>$user_error</div>";
			if(isset($pass_error)) $this->view->msg_pass = "<div class='alert_error'>$pass_error</div>";

		}

	}
}
?>
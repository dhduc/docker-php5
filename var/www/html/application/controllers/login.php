<?php  
class Login extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->view->title = 'Login';
		$this->login();
		$this->view->render('login/index', true);
	}

	function login(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
			$email = Val::input($_POST['email']);
			$password = Val::input($_POST['password']);
			$remember = null;
			if (isset($_POST['remember'])) {
				$remember = $_POST['remember'];
			}

			$data = $this->model->get_user_by_email($email);

			$flag = NULL;

			if($data != NULL){
				if($data['password'] == Hash::create('sha256', $password, HASH_PASSWORD_KEY) ) {
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
					Session::set("user_login", $data['user_id']);
					setcookie('user_login', $data['user_id'], time() + (86400), "/");
					Url::redirect("user/dashboard");	

				}
				else {
					
					Session::set("user_login", $data['user_id']);
					Url::redirect("user/dashboard");	
				}
			}
			if(isset($user_error)) $this->view->msg_user = "<div class='alert_error'>$user_error</div>";
			if(isset($pass_error)) $this->view->msg_pass = "<div class='alert_error'>$pass_error</div>";
		}

	}
}
?>
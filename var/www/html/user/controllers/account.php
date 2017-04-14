<?php  
class Account extends Controller {
	public $url = SITE."/user/account";
	private $user_id = null;
	public $msg = "";
	function __construct($dir){
		parent::__construct($dir);
		$this->init();
	}

	function init(){
		if ( isset($_SESSION['user_login']) && !empty($_SESSION['user_login']) ) {
			$this->user_id = $_SESSION['user_login'];
		}
		else {
			Url::redirect("../../index");
			exit();
		}

	}
	function index(){
		$this->view->title = "Tài khoản";
		$this->display();

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_account'])) {
				$email = Val::input($_POST['email']);
				$username = Val::input($_POST['username']);
				$fullname = Val::input($_POST['fullname']);
				$data = array(
					"email" => $email,
					"username" => $username,
					"fullname" => $fullname		
					);
				if($this->model->update($data, $this->user_id)){
					$info = "Sửa tài khoản thành công";
				}
				else {
					$info = "Sửa tài khoản thất bại";
				}
				
				
			
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}

		}
		
		$this->view->msg = $this->msg;
		$this->view->render("account/index");
		
	}

	function display(){	
		$data = $this->model->get_user_by_id($_SESSION["user_login"]);
			if ($data == false) {
				$this->logout();
			}
		$this->view->data = $data;
	}


	function password(){
		$data = $this->model->get_user_by_id($_SESSION["user_login"]);
		if ($data == false) {
				//Auth::logout();
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
			

		}
		
		$uri = SITE."/user/account";
		$dialog = "<div class='modalNotification'>
		<div>
			<div id='header'>
				Edit Password
				<a href='".$uri."' title='Close' class='close'>X</a>
			</div>
			<div id='modal'>
				<form action=''>
					<p>Mật khẩu hiện tại:</p><input type='password' name='password'>
					<p>Mật khẩu mới:</p><input type='password' name='new_password'>
					<p>Xác nhận mật khẩu :</p><input type='password' name='confirm_password'>
					<p>
						<input type='submit' class='button button-info' name='change_password' value='Lưu' />&nbsp;<a class='button' href='<?php echo $uri; ?>'>Hủy</a>
					</p>
					<p>".$this->msg."</p>
				</form>

			</div>
		</div>
		</div>";

		$this->view->dialog = $dialog;
		$this->view->render("account/index");
	}

}	
?>
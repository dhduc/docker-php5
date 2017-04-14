<?php  
class Signup extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->view->title = 'Signup';
		$this->signup();
		$this->view->render('signup/index', true);
	}

	function signup(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
			$email = Val::input($_POST['email']);
			$username = Val::input($_POST['username']);
			$password = Val::input($_POST['password']);

			if(empty($email)){
				$status = 'error';
    			$message = 'You did not enter an email address!';
			}
			else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)){ 
        		$status = "error";
        		$message = "You have entered an invalid email address!";
    		}
    		else if(empty($username) || strlen($username) < 5){
    			$status = 'error';
    			$message = 'Username should not be empty or from 5 letters';
    		}
    		else if(!preg_match("/^[a-zA-Z]+$/", $username)){
    			$status = 'error';
    			$message = 'Username must have alphabet characters only';
    		}
    		else if(empty($password) || strlen($password) < 7){
    			$status = 'error';
    			$message = 'Password should not be empty or from 7 letters';
    		}
    		else if(!isset($_POST["term"])){
    			$status = 'error';
    			$message = 'You must agree the term';
    		}
    		else {
    			$check = $this->model->check_email($email);
    			if($check == false){
    				$datetime = date("Y-m-d h:i:s");
    				$data = array(
						"email" => $email,
						"username" => $username,
						"password" => Hash::create('sha256', $password, HASH_PASSWORD_KEY),
						"datetime" => $datetime
					);
					if($this->model->add_new($data)){ // Signup success
						$status = "success";
               			$message = "You have been signed up!";  
					}
					else {
						$status = "error";
               			$message = "Ooops, Theres been a technical error!"; 
					}
    			}
    			else {
    				$status = "error";
            		$message = "This email address has already been registered!";
    			}
    		}


    		if(isset($message)) $this->view->msg_signup = "<div class='alert_error'>$message</div>";





    		
			
			//Url::redirect("login");

			
		}

	}
}
?>
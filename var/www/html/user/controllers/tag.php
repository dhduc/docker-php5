<?php  
class Tag extends Controller {
	public $url = SITE."/user/tag";
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
		$this->view->title = "Danh sách nhãn";
		$this->display();
		$this->insert();
		
	}

	function display(){
		
		$data = $this->model->get_all_tag($this->user_id);

		if (isset($data) && !empty($data) && $data != null ) {
			$list = "";
			foreach ($data as $row) {				
				$list .= "<span id='tag'>	
						<a href='".SITE."/user/post/tag/{$row['tag_id']}' ><span class='fa fa-tag'></span> {$row['tag_name']}</a>
							</span>";
			}			
		}
		else {
			$list = "Chưa có nhãn nào!";
		}
		$this->view->data = $list;		
	}

	function insert(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_tag']) && $_POST['submit_tag'] == "Insert") {
			if (isset($_POST['new_tag']) && !empty($_POST['new_tag'])) {
				$name = Val::input($_POST['new_tag']);				
				$tag = $this->model->get_tag_by_name($name);
				if($tag == false) {
					
					$data = array(
						"user_id" => $this->user_id,
						"tag_name" => $name
						);
					if($this->model->insert_tag($data)){
						$info = "Thêm nhãn thành công";
					}
					else {
						$info = "Thêm nhãn thất bại";
					}
				}
				else {
					$info = "Nhãn tồn tại";
					
				}
			}
			else {
				$info = "Chưa có nhãn nào";
				
			}
			
			if (isset($info)) {
				$this->view->msg = "<div class='alert'>$info</div>";

			}
			//header("location: ".$_SERVER['REQUEST_URI']."");

		}

		$this->view->render("tag/index");		
	}

	function edit($id){
		$data = $this->model->get_tag_by_id($id, $this->user_id);
		if($data == null){
			header("location: ".SITE."/user/alert");
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_tag'])) {
			if (isset($_POST['tag_name']) && !empty($_POST['tag_name'])) {
				$name = Val::input($_POST['tag_name']);
				
				$datetime = date("Y-m-d h:i:s");
				$data = array(
					"tag_name" => $name
					);
				if($this->model->update_tag($data, $id, $this->user_id)){
					$info = "Sửa nhãn thành công";
				}
				else {
					$info = "Sửa nhãn thất bại";
				}
				
				
			}
			else {
				$info = "Tên nhãn trống";
			}
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}

		}
		
		$uri = $_SESSION['page_url'];	
		$dialog = "<div class='modalNotification'>
		<div>
		<div id='header'>
		Sửa nhãn
		<a href='".$uri."' title='Close' class='close'>X</a>
		</div>
		<div id='modal'>
		<form action='' method='post' name='frmTag' id=''>
		<table width='' height='499' border='0' align='center'>
		<tr>
		<td width='700' valign='top'>
		<p>Tên nhãn:</p>
		<label for='tag_name'></label>
		<input type='text' name='tag_name' id='tag_name' value='".$data['tag_name']."' />
		<p>
		<input type='submit' value='Lưu' class='button button-success' name='update_tag' />&nbsp;
		<input type='reset' value='Nhập lại' class='button button-inverse' />
		<a href='".$uri."' title='Close' class='button'>Đóng</a>
		</p>
		".$this->msg."
		</td>
		</tr>
		</table>
		</form>
		</div>
		</div>
		</div>";

		$this->view->dialog = $dialog;
		$this->view->render("category/index");

	}

	function delete($id){
		$data = $this->model->get_tag_by_id($id, $this->user_id);
		if($data == null){
			header("location: ".SITE."/user/alert");
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_tag'])) {



			if( $this->model->update_post($id, $this->user_id) && $this->model->delete_tag($id, $this->user_id) ){
				$info = "Xóa thành công";
			}
			else {
				$info = "Xóa thất bại";
			}
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}
			

		}

		
		$uri = $_SESSION['page_url'];
		$dialog = "<div class='modalNotification'>
		<div>
			<div id='header'>
				Xóa nhãn
				<a href='".$uri."' title='Close' class='close'>X</a>
				</div>
			<div id='modal'>
				<form action='' method='post' name='frmTag' id=''>
				<table width='' height='499' border='0' align='center'>
					<tr>
						<td width='700' valign='top'>
							<p>Bạn có muốn xóa nhãn này:</p>
								<label for='tag_name'></label>
								<input type='text' name='tag_name' id='tag_name' readonly='readonly' disabled='disabled' value='".$data['tag_name']."' />
							<p>
								<input type='submit' value='Xóa' class='button button-success' name='delete_tag' />&nbsp;
								<a href='".$uri."' title='Close' class='button'>Đóng</a>
							</p>
							".$this->msg."
						</td>
					</tr>
				</table>
				</form>
			</div>
			</div>
		</div>";

		$this->view->dialog = $dialog;
		$this->view->render("category/index");

	}	
}
?>
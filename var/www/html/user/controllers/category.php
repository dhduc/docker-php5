<?php  
class Category extends Controller {
	public $url = SITE."/user/category";
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
		$this->view->title = "Tất cả danh mục";
		$this->page(1);
	}

	function page($page){

		$data = $this->model->get_all_category($page, " user_id = {$this->user_id} ");
		$this->view->pagelist = $this->model->pagelist;
		
		if (isset($data) && !empty($data) && $data != null ) {
			$_SESSION['page_url'] = $_SERVER['REQUEST_URI'];
			$table = "<table width='700'>		
			<th>Tên danh mục</th>
			<th>Ngày cập nhật</th>
			<th>Sửa</th>
			<th>Xóa</th>";			
			foreach ($data as $row) {				
				$table .= "<tr>				
				<td> <a href='".SITE."/user/post/category/{$row['category_id']}'>{$row['category_name']}</a> </td>
				<td>{$row['date_add']}</td>
				<td> <a href='".SITE."/user/category/edit/{$row['category_id']}'><span class='fa fa-edit'></span></a> </td>
				<td> <a href='".SITE."/user/category/delete/{$row['category_id']}'><span class='fa fa-trash'></span></a> </td>
				</tr>";
			}
			$table .= "</table>";
		}
		else {
			$table = "";
		}

		$this->view->data = $table;	
		$this->view->render("category/index");
	}



	function insert(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_category'])) {
			if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
				$name = Val::input($_POST['category_name']);
				if(isset($_POST['description'])){
					$description = Val::input($_POST['description']);
				}
				else {
					$description = "";
				}
				$category = $this->model->get_category_by_name($name);
				if($category == false) {
					$datetime = date("Y-m-d h:i:s");
					$data = array(
						"user_id" => $this->user_id,
						"category_name" => $name,
						"description" => $description,
						"date_add" => $datetime,
						"date_modified" => $datetime
						);
					if($this->model->insert_category($data)){
						$info = "Thêm danh mục thành công";
					}
					else {
						$info = "Thêm danh mục thất bại";
					}
				}
				else {
					$info = "Danh mục tồn tại";
				}
			}
			else {
				$info = "Tên danh mục trống";
			}
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}

		}

		$dialog = "<div class='modalNotification'>
		<div>
			<div id='header'>
				Thêm danh mục
				<a href='".$this->url."' title='Close' class='close'>X</a>
			</div>
		<div id='modal'>
			<form action='' method='post' enctype='multipart/form-data' name='frmCategory' id='frm' onsubmit=''> 
				<table width='' height='499' border='0' align='center'>
					<tr>
						<td width='700' valign='top'>
							<p>Tên danh mục:</p>
								<label for='category_name'></label>
								<input type='text' name='category_name' id='name' />

							<p>Mô tả:</p>
								<label for='description'></label>
								<textarea name='description' id='description' cols='45' rows='5'></textarea>
							<p>
								<input type='submit' value='Thêm' class='button button-success' name='insert_category' />&nbsp;
								<input type='reset' value='Nhập lại' class='button button-inverse' />
								<a href='".$this->url."' title='Close' class='button'>Đóng</a>
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

	function edit($id){
		$data = $this->model->get_category_by_id($id, "and user_id = {$this->user_id}");
		if($data == null){
			header("location: ".SITE."/user/alert");
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
			if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
				$name = Val::input($_POST['category_name']);
				if(isset($_POST['description'])){
					$description = Val::input($_POST['description']);
				}
				else {
					$description = "";
				}
				
				$datetime = date("Y-m-d h:i:s");
				$data = array(
					"category_name" => $name,
					"description" => $description,
					"date_modified" => $datetime
					);
				if($this->model->update_category($data, $id, $this->user_id)){
					$info = "Sửa danh mục thành công";
				}
				else {
					$info = "Sửa danh mục thất bại";
				}
				
				
			}
			else {
				$info = "Tên danh mục trống";
			}
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}

		}
		
		$uri = $_SESSION['page_url'];
		$dialog = "<div class='modalNotification'>
		<div>
			<div id='header'>
				Sửa danh mục
				<a href='".$uri."' title='Close' class='close'>X</a>
			</div>
			<div id='modal'>
				<form action='' method='post' enctype='multipart/form-data' name='frmCategory' id=''>
					<table width='' height='499' border='0' align='center'>
						<tr>
							<td width='700' valign='top'>
								<p>Tên danh mục:</p>
									<label for='category_name'></label>
									<input type='text' name='category_name' id='category_name' value='".$data['category_name']."' />
								<p>Mô tả:</p>
									<label for='description'></label>
									<textarea name='description' id='description' cols='45' rows='5'>".$data['description']."
									</textarea>
								<p>
									<input type='submit' value='Lưu' class='button button-success' name='update_category' />&nbsp;
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
		$data = $this->model->get_category_by_id($id);
		if($data == null){
			header("location: ".SITE."/user/alert");
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_category'])) {
			if( $this->model->update_post($id, $this->user_id) && $this->model->delete_category($id, $this->user_id) ){
				$info = "Xóa danh mục thành công";
			}
			else {
				$info = "Xóa danh mục thất bại";
			}
			
			if (isset($info)) {
				$this->msg = "<div class='alert'>$info</div>";
			}
		}

		
		$uri = $_SESSION['page_url'];
		$dialog = "<div class='modalNotification'>
		<div>
			<div id='header'>
				Xóa danh mục
				<a href='".$uri."' title='Close' class='close'>X</a>
			</div>
			<div id='modal'>
				<form action='' method='post' name='frmCategory' id=''>
					<table width='' height='499' border='0' align='center'>
						<tr>
							<td width='700' valign='top'>
								<p>Bạn có muốn xóa danh mục này:</p>
									<label for='category_name'></label>
									<input type='text' name='category_name' id='category_name' readonly='readonly' disabled='disabled' value='".$data['category_name']."' />
								<p>
									<input type='submit' value='Xóa' class='button button-success' name='delete_category' />&nbsp;
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
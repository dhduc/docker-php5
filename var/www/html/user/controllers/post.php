<?php  
class Post extends Controller {
	private $user_id = null;
	private $msg = "";
	private $dialog = "";
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
		$this->view->title = "Tất cả bài viết";
		$this->page(1);
	}
	function page($page){

		$data = $this->model->get_all_post($page, " user_id = {$this->user_id} ");
		$this->view->pagelist = $this->model->pagelist;
		
		if (isset($data) && !empty($data) && $data != null ) {
			$table = "<table width='90%'>
			<th>Chọn</th>
			<th>Tiêu đề bài viết</th>";
			$i = 0;
			foreach ($data as $row) {
				$i++;
				$table .= "<tr>
				<td width='100' valign='top'><input type='checkbox' name='checkbox[]' id='{$row['post_id']}' class='checkbox' value='{$row['post_id']}' />
				<label for='{$row['post_id']}'><span></span></label>
				</td>
				<td> <a href='".SITE."/user/post/detail/{$row['post_id']}'>{$row['post_title']}</a><br> 
				".strip_tags(html_entity_decode(html_entity_decode($row['post_content'])))."</td>
				</tr>";
			}
			$table .= "</table>";
		}
		else {
			$table = "";
		}

		$this->dialog = array($this->get_all_category(), $this->get_all_tag());
		$this->view->dialog = $this->dialog;

		$this->view->data = $table;
		$this->view->render("post/index");
	}

	function get_all_category(){
		$data = $this->model->get_cat_in_post($this->user_id);
		$all_cat = "";
		foreach ($data as $row) {
			$all_cat .= "<span id='box'><a href='".SITE."/user/post/category/{$row['category_id']}'>{$row['category_name']}</a></span>";
		}
		return $all_cat;
	}
	function get_all_tag(){
		$data = $this->model->get_tag_in_post($this->user_id);
		$all_tag = "";
		foreach ($data as $row) {
			$all_tag .= "<span id='box'><a href='".SITE."/user/post/tag/{$row['tag_id']}'>{$row['tag_name']}</a></span>";
		}
		return $all_tag;
	}

	function category($category_id, $page = 1){
		
		$where = " category_id = $category_id and user_id = {$this->user_id} ";
		$data = $this->model->get_all_post($page, $where);
		$this->view->pagelist = $this->model->pagelist;

		/*** Display Post*/
		if (isset($data) && !empty($data) && $data != null ) {
			$table = "<table width='90%'>
			<th>Chọn</th>
			<th>Tiêu đề bài viết</th>";
			$i = 0;
			foreach ($data as $row) {
				$i++;
				$table .= "<tr>
				<td width='100' valign='top'><input type='checkbox' name='checkbox[]' id='{$row['post_id']}' class='checkbox' value='{$row['post_id']}' />
				<label for='{$row['post_id']}'><span></span></label>
				</td>
				<td> <a href='".SITE."/user/post/detail/{$row['post_id']}'>{$row['post_title']}</a><br> 
				".strip_tags(html_entity_decode(html_entity_decode($row['post_content'])))."</td>
				</tr>";
			}
			$table .= "</table>";
		}
		else {
			$table = "";
		}

		/*** Display Category*/
		
		$row = $this->model->get_category_by_id($category_id, $this->user_id);
		$info = "";
		if (isset($row) && !empty($row) && $row != null ){
			$info .="<h1><span class='fa fa-list-alt'> {$row['category_name']}</h1>";
		}
		else {
			$info .="";
		}


		$this->view->info = $info;
		$sort = "<p><span class='fa fa-list'></span> Sắp xếp theo: <a href='#openCategory' class='button button-info'><span class='fa fa-list-alt'> {$row['category_name']}</a>
		&nbsp;<a href='#openTag' class='button button-info'>Nhãn</a>
		</p>";

		
		$this->dialog = array($this->get_all_category(), $this->get_all_tag());

		
		$this->view->sort = $sort;
		$this->view->data = $table;
		
		$this->view->dialog = $this->dialog;
		$this->view->render("post/index");
	}

	function tag($tag_id, $page = 1){

		$getcon = " tag_id = $tag_id and user_id = {$this->user_id} ";
		$data = $this->model->get_all_post($page, $getcon);
		

		/*** Display Post */
		if (isset($data) && !empty($data) && $data != null ) {
			$_SESSION['page_url'] = $_SERVER['REQUEST_URI'];
			$table = "<table width='90%'>
			<th>Chọn</th>
			<th>Tiêu đề bài viết</th>";
			$i = 0;
			foreach ($data as $row) {
				$i++;
				$table .= "<tr>
				<td width='100' valign='top'><input type='checkbox' name='checkbox[]' id='{$row['post_id']}' class='checkbox' value='{$row['post_id']}' />
				<label for='{$row['post_id']}'><span></span></label>
				</td>
				<td> <a href='".SITE."/user/post/detail/{$row['post_id']}'>{$row['post_title']}</a><br> 
				".strip_tags(html_entity_decode(html_entity_decode($row['post_content'])))."

				</td>
				
				
				</tr>";
			}
			$table .= "</table>";
		}
		else {
			$table = "";
		}

		/*** Display Tag */
		
		$row = $this->model->get_tag_by_id($tag_id, $this->user_id);
		$info = "";
		if (isset($row) && !empty($row) && $row != null ){
			$info .="<h1><span class='fa fa-tag'> {$row['tag_name']} Post</h1>
			<a href='".SITE."/user/tag/edit/$tag_id' class='button button-info'><span class='fa fa-edit'></span> Sửa nhãn</a>&nbsp;
			<a href='".SITE."/user/tag/delete/$tag_id' class='button button-info'><span class='fa fa-remove'></span> Xóa nhãn</a>
			";
		}
		else {
			$info .="";
		}
		

		$sort = "<p><span class='fa fa-list'></span> Sắp xếp theo: <a href='#openCategory' class='button button-info'>Danh mục</a>
		&nbsp;<a href='#openTag' class='button button-info'><span class='fa fa-tag'> {$row['tag_name']}</a>
		</p>";

		

		$this->dialog = array($this->get_all_category(), $this->get_all_tag());

		$this->view->sort = $sort;
		$this->view->info = $info;
		$this->view->data = $table;
		$this->view->pagelist = $this->model->pagelist;
		$this->view->dialog = $this->dialog;
		$this->view->render("post/index");
	}

	function insert(){
		$this->view->title = "Bài viết mới";

		/*  ** Display Category */
		
		$data_category = $this->model->get_all_category($this->user_id);
		$list_category = "";
		if (isset($data_category) && !empty($data_category) && $data_category != null ){
			$list_category .=  "<option value='0'>None</option>";
			foreach ($data_category as $row) {

				$list_category .=  "<option value='{$row['category_id']}'>".$row["category_name"]."</option>";
			}
		}
		else {
			$list_category .="";
		}
		$this->view->category = $list_category;

		/*** Display Tag */
		
		$data_tag = $this->model->get_all_tag($this->user_id);
		if (isset($data_tag) && !empty($data_tag) && $data_tag != null ) {
			$list_tag = "";
			foreach ($data_tag as $row) {				
				$list_tag .= "<span id='tag'>
				<input type='radio' name='tag' id='{$row['tag_id']}' value='{$row['tag_id']}'>
				<label for='{$row['tag_id']}'>{$row['tag_name']}</label>
				</span>";
			}			
		}
		else {
			$list_tag = "Chưa có nhãn";
		}
		$this->view->tag = $list_tag;


		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_post'])) {

			$title = Val::input($_POST['title']);
			$content = htmlentities(Val::input($_POST['editor_content']));
			$category = Val::input($_POST['category']);

			/*** Process Get Tag */
			$tag = 0;
			if(isset($_POST["new_tag"]) && $_POST["new_tag"] == "new_tag" ){
				if(isset($_POST["tag_text"]) && !empty($_POST["tag_text"]) ){
					$tag_name = Val::input($_POST['tag_text']);
					$tag = $tag_model->get_tag_by_name($tag_name);
					if($tag == false) {
						$tag_model->insert_tag(array("tag_name" => $tag_name));
					}
					else {
						$info = "Nhãn đã tồn tại!";

					}
					
					$tag_data = $tag_model->get_tag_by_name($tag_name);
					$tag = $tag_data["tag_id"];
				}
				else {
					$tag = 0;
				}
			}
			else {
				if(isset($_POST["tag"])){
					$tag = $_POST["tag"];
				}
				else {
					$tag = 0;
				}
			}
			if(empty($title)) {
				$info = "Tiêu đề bài viết trống!";
			}
			else {
				if(!empty($content)) {

					$datetime = date("Y-m-d h:i:s");
					$data = array(
						"user_id" => $this->user_id,
						"post_title" => $title,
						"post_content" => $content,
						"category_id" => $category,
						"tag_id" => $tag,
						"date_add" => $datetime,
						"date_modified" => $datetime,
						"status" => 1
						);
					if($this->model->insert_post($data)){
						$info = "Thêm bài viết thành công!";
					}
					else {
						$info = "Thêm bài viết thất bại!";
					}
					
				}
				else {
					$info = "Nội dung bài viết trống";
				}
				
			}
			
			
		}

		if (isset($info)) {
			$this->view->msg = "<div class='alert'>$info</div>";
		}


		
		$this->view->render("post/insert");

	}

	function edit($id){
		$this->view->title = "Sửa bài viết";

		/*** Display Info */
		$post = $this->model->get_post_by_id($id, $this->user_id);
		if($post == null){
			header("location: ".SITE."/user/alert");
		}
		$this->view->post_title = "<input type='text' name='title' id='title' value='{$post['post_title']}' />";
		$this->view->post_content = "<textarea name='editor_content' id='myEditor'>".html_entity_decode($post['post_content'])."</textarea>";

		/*** Display Category */
		
		$data_category = $this->model->get_all_category($this->user_id);
		$list_category = "";
		if (isset($data_category) && !empty($data_category) && $data_category != null ){
			$list_category .=  "<option value='0'>None</option>";
			foreach ($data_category as $row) {
				if($post["category_id"] == $row['category_id']){
					$list_category .=  "<option value='{$row['category_id']}' selected>".$row["category_name"]."</option>";
				}
				else {
					$list_category .=  "<option value='{$row['category_id']}'>".$row["category_name"]."</option>";
				}
			}
		}
		else {
			$list_category .="";
		}
		$this->view->category = $list_category;

		/*** Display Tag */
		
		$data_tag = $this->model->get_all_tag($this->user_id);
		if (isset($data_tag) && !empty($data_tag) && $data_tag != null ) {
			$list_tag = "";
			foreach ($data_tag as $row) {				
				if($post['tag_id'] == $row['tag_id']){
					$list_tag .= "<span id='tag'>
					<input type='radio' name='tag' id='{$row['tag_id']}' value='{$row['tag_id']}' checked>
					<label for='{$row['tag_id']}'>{$row['tag_name']}</label>
					</span>";
				}
				else {
					$list_tag .= "<span id='tag'>
					<input type='radio' name='tag' id='{$row['tag_id']}' value='{$row['tag_id']}'>
					<label for='{$row['tag_id']}'>{$row['tag_name']}</label>
					</span>";
				}
			}			
		}
		else {
			$list_tag = "Chưa có nhãn";
		}
		$this->view->tag = $list_tag;


		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_post'])) {

			$title = Val::input($_POST['title']);
			$content = htmlentities(Val::input($_POST['editor_content']));
			$category = Val::input($_POST['category']);

			/*** Process Get Tag */
			$tag = 0;
			if(isset($_POST["new_tag"]) && $_POST["new_tag"] == "new_tag" ){
				if(isset($_POST["tag_text"]) && !empty($_POST["tag_text"]) ){
					$tag_name = Val::input($_POST['tag_text']);
					$tag = $tag_model->get_tag_by_name($tag_name);
					if($tag == false) {
						$tag_model->insert_tag(array("tag_name" => $tag_name));
					}
					else {
						$info = "Nhãn đã tồn tại!";

					}
					
					$tag_data = $tag_model->get_tag_by_name($tag_name);
					$tag = $tag_data["tag_id"];
				}
				else {
					$tag = 0;
				}
			}
			else {
				if(isset($_POST["tag"])){
					$tag = $_POST["tag"];
				}
				else {
					$tag = 0;
				}
			}
			if(empty($title)) {
				$info = "Tiêu đề bài viết trống!";
			}
			else {
				if(!empty($content)) {

					$datetime = date("Y-m-d h:i:s");
					$data = array(
						"post_title" => $title,
						"post_content" => $content,
						"category_id" => $category,
						"tag_id" => $tag,
						"date_add" => $datetime,
						"date_modified" => $datetime,
						"status" => 1
						);
					if($this->model->update_post($data, $id, $this->user_id)){
						$info = "Sửa bài viết thành công";

					}
					else {
						$info = "Sửa bài viết thất bại";
					}
					
				}
				else {
					$info = "Nội dung bài viết trống";
				}
				
			}
			
			
		}

		if (isset($info)) {
			$this->view->msg = "<div class='alert'>$info</div>";
		}


		
		$this->view->render("post/update");

	}

	function detail($id){
		$this->view->title = "Chi tiết bài viết";

		/*** Display Info */
		$post = $this->model->get_post_by_id($id, $this->user_id);
		if($post == null){
			header("location: ".SITE."/user/alert");
		}
		$this->view->post_title = "<h1>".$post['post_title']."</h1>";
		$this->view->post_content = html_entity_decode($post['post_content']);
		$this->view->date = "<span class='fa fa-calendar'></span> ".$post["date_modified"]."</option>";

		/*** Display Category */
		
		$row = $this->model->get_category_by_id($post["category_id"], $this->user_id);
		$list_category = "";
		if (isset($row) && !empty($row) && $row != null ){
			$_SESSION['page_url'] = $_SERVER['REQUEST_URI'];
			
			$list_category .=  "<span class='fa fa-list'></span> ".$row["category_name"];
		}
		else {
			$list_category .="";
		}
		$this->view->category = $list_category;

		/*** Display Tag */
		
		$data_tag = $this->model->get_tag_by_id($post['tag_id'], $this->user_id);
		if (isset($data_tag) && !empty($data_tag) && $data_tag != null ) {
			$list_tag = "";
			
			
			$list_tag .= "<span class='fa fa-tag'> ".
			$data_tag['tag_name'].
			"</span>";				
		}
		else {
			$list_tag = "Chưa có nhãn";
		}
		$this->view->tag = $list_tag;

		if (isset($info)) {
			$this->view->msg = "<div class='alert'>$info</div>";
		}


		$this->view->button = "<a href='".SITE."/user/post/edit/$id' class='button button-info'><span class='fa fa-edit'></span> Sửa</a>
		<a href='".SITE."/user/post/delete/$id' class='button'><span class='fa fa-remove'></span> Xóa</a>";
		$this->view->render("post/detail");

	}

	function delete($id){
		$data = $this->model->get_post_by_id($id, $this->user_id);
		if($data == null){
			header("location: ".SITE."/user/alert");
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_post'])) {

			if($this->model->delete_post($id, $this->user_id)){
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
				Xóa bài viết
				<a href='".$uri."' title='Close' class='close'>X</a>
			</div>
		<div id='modal'>


		<form action='' method='post' name='frmPost' id=''>
			<table width='' height='499' border='0' align='center'>

				<tr>
					<td width='700' valign='top'>
						<p>Bạn có muốn xóa bài viết này:</p>
							<label for='post_title'></label>
							<input type='text' name='post_title' id='post_title' readonly='readonly' disabled='disabled' value='".$data['post_title']."' />
						<p>
							<input type='submit' value='Xóa' class='button button-success' name='delete_post' />&nbsp;
							<a href='".$uri."' title='Đóng' class='button'>Đóng</a>

						</p>
						".$this->msg."
					</td>
				</tr>
			</table>
		</form>
		</div>
		</div>
		</div>";

		$this->view->dialogDelete = $dialog;
		$this->view->render("post/index");

	}
}


?>
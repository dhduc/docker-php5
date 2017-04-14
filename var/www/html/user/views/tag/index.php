	<h1><p class="title">Danh sách các nhãn bài viết:</p></h1>
	<form action="" method="post">
		Nhãn mới:
		<input type="text" name="new_tag" id="new" />
		&nbsp;
		<input type="submit" name="submit_tag" class="button button-info" value="Thêm" />
	</form>
	
	<?php
	if (isset($this->data) && !empty($this->data)) {
		echo "<p>Tất cả nhãn:</p>";
		echo $this->data;		
	}
	else {		
		echo "<p>Chưa có nhãn nào!</p>";		
	}
	if (isset($this->msg) && !empty($this->msg)) {			
			echo $this->msg;			
		}
	?>
</div>
<?php  
if (isset($this->dialog) && !empty($this->dialog)) {
	echo $this->dialog;
}
?>
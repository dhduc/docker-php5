	<p class="title">Danh mục</p>
	<a href="<?=SITE?>/user/category/insert" class="button button-info">Thêm danh mục</a>&nbsp;	
	<?php
	if (isset($this->data) && !empty($this->data)) {
		echo "<p>Danh sách các danh mục:</p>";				
		echo $this->data;
		if (isset($this->msg) && !empty($this->msg)) {
			echo $this->msg;
		}
		if (isset($this->pagelist) && !empty($this->pagelist)) {
			echo $this->pagelist;
		}		
	}
	else {		
		echo "<p>Chưa có danh mục nào!</p>";		
	}
	?>

</div>
<?php  
if (isset($this->dialog) && !empty($this->dialog)) {
	echo $this->dialog;
}
?>
<div id="">
	<?php
	if (isset($this->info) && !empty($this->info)) {
		echo $this->info;
	}

	if (isset($this->data) && !empty($this->data)) {
		?>
		<?php  
		if (isset($this->sort) && !empty($this->sort)) {
			echo $this->sort;
		}
		else {
			echo "<h2>Tất cả bài viết</h2><p><span class='fa fa-list'></span> Sắp xếp theo: <a href='#openCategory' class='button button-info'>Danh mục</a>
		&nbsp;<a href='#openTag' class='button button-info'>Nhãn</a>
		</p>";
		}
		?>
		<form action="" method="post">
			<p>
				<input type="checkbox" id="selectall" name="selectall" />
				<label for="selectall"> <span></span>Chọn tất cả </label>&nbsp;
				<input type="submit" value="Xóa lựa chọn" name="delete_select" id="delete_select" class="button" />&nbsp;
			</p>
			<?php
			echo $this->data;

			?>
		</form>
		<?php

		if (isset($this->msg) && !empty($this->msg)) {
			echo $this->msg;
		}

		if (isset($this->pagelist) && !empty($this->pagelist)) {
			echo $this->pagelist;
		}
		
	}
	else {
		?>
		<h1>Chưa có bài viết nào!</h1>
		<?php
	}

	?>
	
</div>

<?php  
if(isset($this->dialog) && !empty($this->dialog)){
	$category = $this->dialog[0];
	$tag = $this->dialog[1];
	$url = $_SERVER['REQUEST_URI'];
	$uri = SITE."/user/post";
	?>
	<div id="openCategory" class="modalDialog">
		
		<div>
			<div id="header">
				Tất cả danh mục
				<a href="<?php echo $uri; ?>" title="Close" class="close">X</a>
			</div>
			<div id="modal">
				<?php echo $category; ?>

			</div>
		</div>
	</div>
	<div id="openTag" class="modalDialog">
		
		<div>
			<div id="header">
				Tất cả nhãn
				<a href="<?php echo $uri; ?>" title="Close" class="close">X</a>
			</div>
			<div id="modal">
				<?php echo $tag; ?>

			</div>
		</div>
	</div>
	<?php
}
?>
<?php  
if (isset($this->dialogDelete) && !empty($this->dialogDelete)) {
	echo $this->dialogDelete;
}
?>
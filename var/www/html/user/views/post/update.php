<div class="main">
	
	<form action="" method="post" name="" id="">
		<table width="" height="499" border="0" align="center">

			<tr>
				<td width="900" valign="top">
					<p>Tiêu đề bài viết:</p>			
					<?php  
							if (isset($this->post_title) && !empty($this->post_title)) {
								echo $this->post_title;
							}
							?>
					<p>Nội dung:</p>
					<?php  
							if (isset($this->post_content) && !empty($this->post_content)) {
								echo $this->post_content;
							}
							?>
					<p><span>Danh mục:</span>
						<label for="category"></label>
						<select name="category" id="category">
							<?php  
							if (isset($this->category) && !empty($this->category)) {
								echo $this->category;
							}
							?>
						</select></p>
						<p> <span>Nhãn:</span>
							<span id="tag">
								<input type="radio" name="tag" id="none" value="">
								<label for="none">Không chọn</label>
							</span>
							<?php  
							if (isset($this->tag) && !empty($this->tag)) {
								echo $this->tag;
							}
							?>
							&nbsp;						
							<span id="tag">
								<input type="checkbox" name="new_tag" id="new_tag" value="new_tag">
								<label for="new_tag"> <span></span> Nhãn mới</label>
							</span>
							&nbsp;<input type="text" name="tag_text" class="tag_text" />
						</p>
							<p><input type="submit" value="Lưu" class="button button-success" name="update_post" />
								<input type="reset" value="Nhập lại" class="button" />
							</p>
						</td>
					</tr>
		</table>
	</form>
			<?php  
			if (isset($this->msg) && !empty($this->msg)) {
				echo $this->msg;
			}
			?>
</div>
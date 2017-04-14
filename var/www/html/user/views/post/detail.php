<div class="main">
	<table width="" height="499" border="0" align="center">
		<tr>
			<td width="900" valign="top">
				<?php  
				if (isset($this->post_title) && !empty($this->post_title)) {
					echo $this->post_title;
				}
				?>
				<?php  
				if (isset($this->post_content) && !empty($this->post_content)) {
					echo html_entity_decode($this->post_content);
				}
				?>
				<?php  
				echo "<span>";
				if (isset($this->category) && !empty($this->category)) {
					echo $this->category;
				}
				echo "</span><span>";
				if (isset($this->tag) && !empty($this->tag)) {
					echo $this->tag;
				}
				echo "</span><span>";
				if (isset($this->date) && !empty($this->date)) {
					echo $this->date;
				}
				echo "</span>";
				?>
				<p>
					<?php  
					if (isset($this->button) && !empty($this->button)) {
						echo $this->button;
					}
					?>
				</p>
			</td>
		</tr>
	</table>
	<?php  
	if (isset($this->msg) && !empty($this->msg)) {
		echo $this->msg;
	}
	?>
</div>
<style type="text/css">
table td span {
	margin-right: 10px;
}
</style>
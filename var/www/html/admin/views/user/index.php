<div id="page-wrapper">

	<div class="container-fluid">
		<?php
		if (isset($this->info) && !empty($this->info)) {
			echo $this->info;
		}

		if (isset($this->data) && !empty($this->data)) {
			?>
			<h1>All User</h1>
			<?php
			echo $this->data;

			?>

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
			<p>Chưa có bài viết nào!</p>
			<?php
		}

		?>

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<style type="text/css">
	#page-wrapper {
		height: 100%;
		padding: 20px;
		min-height: 700px;
	}
</style>

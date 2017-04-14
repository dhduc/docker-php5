<div id="page-wrapper">

	<div class="container-fluid">
		
<?php  
	if (isset($this->data) && !empty($this->data)) {
		$data = $this->data;
		$uri = $_SERVER['REQUEST_URI'];
		
?>
<form action="" method="post" name="" id="">
		<table width="" height="" border="0" align="center">

			<tbody>
				<tr>
					
					<td><h1>Thông tin tài khoản</h1>	
</td>
				</tr>
				<tr>
				
					<td>Tên hiển thị:</td>
					<td><input type="text" name="fullname" id="fullname" value="<?php echo $data['fullname'] ?>" readonly="readonly"></td>
					
				
			</tr>
			<tr>
				
					<td>Tên người dùng:</td>
					<td><input type="text" name="username" id="username" value="<?php echo $data['username'] ?>" readonly="readonly"></td>
					
				
				</tr>
			<tr>
			
					<td>Email:</td>
					<td><input type="text" name="email" id="email" value="<?php echo $data['email'] ?>" readonly="readonly"></td>
					
				
				</tr>
			<tr>
				
					<td>Mật khấu:</td>
					<td><a href="#openDialog" class="button button-info" id="password"> <span class="fa fa-edit"></span> Hiển thị </a></td>
				
				</tr>
			<tr>
				
					<td>Datetime:</td>
					<td><input type="text" name="datetime" id="datetime" value="<?php echo $data['datetime'] ?>" readonly="readonly"></td>
					
				
			</tr>
			<tr>
				<td>
					<h1>Thống kê</h1>
<?php if (isset($this->total) && !empty($this->total)): $total = $this->total; ?>
    <p>
        <span class="fa fa-list-alt"></span> Bài viết: <?php echo $total['total_post']; ?>
    </p>
    <p>
        <span class="fa fa-folder"></span> Danh mục: <?php echo $total['total_category']; ?>
    </p>
    <p>
        <span class="fa fa-tags"></span> Nhãn:<?php echo $total['total_tag']; ?>
    </p>
    
    
<?php  endif; ?>
				</td>
			</tr>
				</tbody></table>
			</form>


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
	table tr td{
		min-width: 100px;
	}
</style>

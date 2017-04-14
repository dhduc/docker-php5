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
				
					<td>Tên người dùng:</td>
					<td><input type="text" name="username" id="username" value="<?php echo $data['username'] ?>"></td>
					
				
				</tr>
			<tr>
			
					<td>Email:</td>
					<td><input type="text" name="email" id="email" value="<?php echo $data['email'] ?>"></td>
					
				
				</tr>
			<tr>
				
					<td>Mật khấu:</td>
					<td><a href="#openDialog" class="button button-info" id="password"> <span class="fa fa-edit"></span> Sửa </a></td>
					
					<div id="openDialog" class="modalDialog">
	
	<div>
		<div id="header">
			Sửa mật khẩu
			<a href="<?php echo $uri; ?>" title="Close" class="close">X</a>
		</div>
		<div id="modal">
			
		<form>
			<p>Mật khẩu hiện tại:</p><input type="password" name="password">
			<p>Mật khẩu mới:</p><input type="password" name="new_password">
			<p>Xác nhận mật khẩu :</p><input type="password" name="confirm_password">
			<p>
				<input type="submit" class="button button-info" name="change_password" value="Lưu" />&nbsp;<a class="button" href="<?php echo $uri; ?>">Hủy</a>
			</p>
		</form>
		</div>
	</div>
</div>
				
				</tr>
				<tr>
				
					<td>Role:</td>
					<td><input type="text" name="role" id="role" value="<?php echo $data['role'] ?>"></td>
					
				
			</tr>
				<tr>
				
					<td>Datetime:</td>
					<td><input type="text" name="datetime" id="datetime" value="<?php echo $data['datetime'] ?>"></td>
					
				
			</tr>
			<tr>
				
				<td>	
							<input type="submit" value="Lưu" class="button button-success" name="update" id="update">
								<input type="reset" value="Nhập lại" class="button" id="reset">
								<input type="checkbox" name="checkbox" value="" id="checkbox">
								<label for="checkbox"> <span></span> Sửa thông tin</label>

							
						</td>
					</tr>
				</tbody></table>
			</form>


<?php		
	}
?>

<style type="text/css">
	table tr td{
		min-width: 100px;
	}
	
</style>
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
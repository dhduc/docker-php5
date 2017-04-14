
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
					<td><input type="text" name="fullname" id="fullname" value="<?php echo $data['fullname'] ?>"></td>
					
				
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
					<td>
						<a href="<?=SITE?>/user/account/password" class="button button-info" id="password"> <span class="fa fa-edit"></span> Sửa </a></td>
					
					
				
				</tr>
			<tr>
				
				<td>	
							<input type="submit" value="Lưu" class="button button-success" name="update_account" id="update">
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
<?php  
if (isset($this->msg) && !empty($this->msg)) {
			echo $this->msg;
		}
?>
<?php  
if (isset($this->dialog) && !empty($this->dialog)) {
	echo $this->dialog;
}
?>
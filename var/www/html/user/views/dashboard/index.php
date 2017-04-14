
<h2 id="brd"><span class="fa fa-user"></span> Xin chào <?=(isset($this->username)) ? $this->username : ''; ?></h2>
</style>

<table id="tableDashboard" cellpadding="20" cellspacing="20">
	<tr>
		<td>
			<h3>  <a href="<?=SITE?>/user/post">
				<i class="fa fa-list-alt fa-lg"></i>
				<span class="nav-text">Bài viết</span>
			</a></h3>
		</td>
		<td>
			<h3><a href="<?=SITE?>/user/post/insert">
				<i class="fa fa-plus-square fa-lg"></i>
				<span class="nav-text">Tạo mới</span>
			</a></h3>
		</td>
		<td>
			<h3><a href="<?=SITE?>/user/category">
				<i class="fa fa-folder fa-lg"></i>
				<span class="nav-text">Danh mục</span>
			</a></h3>
		</td>
	</tr>
	<tr>
		<td>
			<h3> <a href="<?=SITE?>/user/tag">
				<i class="fa fa-tags fa-lg"></i>
				<span class="nav-text">Nhãn</span>
			</a></h3>
		</td>
		<td>
			<h3><a href="<?=SITE?>/user/account">
				<i class="fa fa-user fa-lg"></i>
				<span class="nav-text">Tài khoản</span>
			</a></h3>
		</td>
		<td>
			<h3><a href="dashboard/logout">
				<i class="fa fa-sign-out fa-lg"></i>
				<span class="nav-text">
					Đăng xuất
				</span>

			</a></h3>
		</td>
	</tr>
</table>
</div>
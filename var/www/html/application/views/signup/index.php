<html>
<head>
  <meta charset="utf8">
  <title>Trang đăng ký</title>
  <link rel="stylesheet" type="text/css" href="<?=HOME_URL?>/public/css/login.css">

  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="<?=HOME_URL?>/public/js/validate.js"></script>

</head>
<body>
  <div id="wrap">
    <div class="box">
      <form name="frm" id="frmSignup" class="form" method="post" action="signup">
        <h2>Đăng ký người dùng</h2>
        <p class="email">
          <input type="text" name="email" id="email" placeholder="example@mail.com" />
          <label for="email">Email</label>
        </p>
        <p class="username">
          <input type="text" name="username" id="username" placeholder="Username" />
          <label for="username">Tên người dùng</label>
        </p>
        <p class="password">
          <input type="password" name="password" id="password" placeholder="Password" />
          <label for="password">Mật khẩu</label>
        </p>
        <p>
          <input type="checkbox" name="term" id="term" value="agree">
          <label for="term">Đồng ý điều khoản</label>
        </p>
        <p><a href="login">Đăng nhập</a></p>
        <p class="submit">
          <input type="submit" value="Đăng ký" class="button button-info" name="signup" />
          <input type="reset" value="Nhập lại" class="button" name="reset" />

        </p>
      </form>
      <p id="signupMsg"></p>
    </div>
    <?=(isset($this->msg_signup)) ? $this->msg_signup : ''; ?>
  </div>  
</body>
</html>
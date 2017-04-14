<html>
<head>
  <meta charset="utf8">
  <title>Trang đăng nhập</title>
  <link rel="stylesheet" type="text/css" href="<?=HOME_URL?>/public/css/login.css">
  <script type="text/javascript" src="<?=HOME_URL?>/public/js/validate.js"></script>
</head>
<body>
  <div id="wrap">
    <div class="box">
      <form name="frm" class="form" method="post" action=""  onsubmit="return validate()">
        <h2>Trang đăng nhập</h2>
        <p class="email">
          <input type="text" name="email" id="email" placeholder="example@mail.com" />
          <label for="email">Email</label>
        </p>
        <p class="password">
          <input type="password" name="password" id="password" placeholder="password" />
          <label for="password">Mật khẩu</label>
        </p>
        <p>
          <input type="checkbox" name="remember" id="remember" value="on">
          <label for="remember">Ghi nhớ</label>
        </p>
        <p><a href="signup">Đăng ký</a></p>
        <p class="submit">
          <input type="submit" value="Đăng nhập" class="button button-info" name="login" />
          <input type="reset" value="Nhập lại" class="button" name="reset" />

        </p>
      </form>
    </div>
    <?=(isset($this->msg_user)) ? $this->msg_user : ''; ?>
    <?=(isset($this->msg_pass)) ? $this->msg_pass : ''; ?>
  </div>  
</body>
</html>
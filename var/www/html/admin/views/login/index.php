<html>
<head>
  <meta charset="utf8">
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="<?=ADMIN_URL?>/public/css/login.css">
  <script type="text/javascript" src="<?=ADMIN_URL?>/public/js/validate.js"></script>
</head>
<body>
  <div id="wrap">
    <div class="box">
      <form name="frm" class="form" method="post" action=""  onsubmit="return validate()">
        <h2>Admin Login Page</h2>
        <p class="email">
          <input type="text" name="email" id="email" />
          <label for="email">Email</label>
        </p>
        <p class="password">
          <input type="password" name="password" id="password" />
          <label for="password">Password</label>
        </p>
        <p>
          <input type="checkbox" name="remember" id="remember" value="on">
          <label for="remember">Remember</label>
        </p>
        <p class="submit">
          <input type="submit" value="Login" class="button button-info" name="login" />
          <input type="reset" value="Reset" class="button" name="reset" />

        </p>
      </form>
    </div>
    <?=(isset($this->msg_user)) ? $this->msg_user : ''; ?>
    <?=(isset($this->msg_pass)) ? $this->msg_pass : ''; ?>
  </div>  
</body>
</html>
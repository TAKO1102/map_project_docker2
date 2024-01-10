<?php

  session_start();

  $err=$_SESSION;

  $_SESSION=array();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css" type="text/css">

    <link rel="stylesheet" href="css/HamburgerMenu.css">

    <title>Document</title>
</head>
<body>

  <link href= "https://fonts.googleapis.com/icon?family=Material+Icons" rel= "stylesheet">
  <header>
  
      <div class="sp-menu">
        <span class="material-icons" id="open">menu</span>
      </div>
    </header>
  
    <div class="overlay">
      <span class="material-icons" id="close">close</span>
      <nav>
        <ul>
          <li><a href="index.html"><img src="image/freefont_logo_kouzansousho2.png"></a></li>
          <!-- <img src="freefont_logo_kouzansousho2.png"> -->
          <li><a href="./login.php"><img src="image/freefont_logo_kouzansousho3.png"></a></li>
          <li><a href="access.html"><img src="image/freefont_logo_kouzansousho4.png"></a></li>
          <li><a href="question_form.html"><img src="image/freefont_logo_kouzangyousho5.png"></a></li>
        </ul>
      </nav>
    </div>
    <script src="js/HamburgerMenu.js"></script>


    <form action="./admin_screen.php" method="POST">
        <div class="login_form_top">
          <h1>管理者ログイン画面</h1>
          <p>ユーザー名、パスワードをご入力の上、「ログイン」ボタンをクリックしてください。</p>
          <?php if(isset($err['msg'])): ?>
            <p><?php echo $err['msg']; ?></p>
          <?php endif; ?>
        </div>
        <div class="login_form_btm">
          <input type="user" name="user" placeholder="ユーザ名を入力してください"><br>
          <?php if(isset($err['user'])): ?>
            <p><?php echo $err['user']; ?></p>
          <?php endif; ?>


          <input type="password" name="password"placeholder="パスワードを入力してください"><br>
          <?php if(isset($err['password'])): ?>
            <p><?php echo $err['password']; ?></p>
          <?php endif; ?>
        </div>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
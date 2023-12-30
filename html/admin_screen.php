
<?php


    //require_once 'http://192.168.10.120/map_project/dbconnect.php';
    function connect(){
        try{
                $DB_DATABASE = 'josetu_user';
                $DB_USERNAME = 'root';
                $DB_PASSWORD = '';
                $DB_OPTION = 'charset=utf8mb4';
                $PDO_DSN = "mysql:host=localhost;dbname=" . $DB_DATABASE . ";" . $DB_OPTION; #DSN データソースネームmysqlの場合

                $db = new PDO($PDO_DSN, $DB_USERNAME, $DB_PASSWORD, #接続するにはまずインスタンスを作成
                [   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                // echo 'DB接続成功';
                //var_dump($db);
                return $db;
            } catch(PDOException $e){
                echo 'DB接続失敗'. $e->getMessage();
                exit();
            };
    }
    class UserLogic
    {
        // ログイン処理
        // @param string $user
        // @param string $password
        // @return bool $result

        public static function login($user, $password)
        {
            // 結果
            $result =false;
            //$result =true;
            // ユーザをemailから検索して取得
            $users = self::getUserByUser($user);

            // echo("<pre>");

            // var_dump($users["password"]);

            // var_dump($password);

            // echo("</pre>");
            //var_dump($password);
            // return $result;
            if (!$users) {
                $_SESSION['msg'] = 'ユーザー名が一致しません。';
                return $result;
            }

            //パスワードの照会
            if ($password===$users['password']) {
            //ログイン成功
            echo ('ログイン成功');
            session_regenerate_id(true);
            $_SESSION['login_user'] = $users;
            $result = true;
            return $result;
            }
            

            $_SESSION['msg'] = 'パスワードが一致しません。';
            return $result;
        }

        // userからユーザー取得
        // @param string $user
        // @return arry|bool $user|false

        public static function getUserByUser($user)
        {
            // SQLの準備
            // SQLの実行
            // SQLの結果を返す
            $sql = 'SELECT * FROM users WHERE name = ?';

            // emailを配列に入れる
            $arr = [];
            $arr[] = $user;

            try {
                $stmt = connect()->prepare($sql);
                $stmt->execute($arr);
                // SQLの結果を返す
                $user = $stmt->fetch();
                return $user;
            } catch(\Exception $e) {
                return false;
            }
        }

        
        
        // ログインチェック
        // @param void
        // @return bool $result
        
        public static function checkLogin(){$result = false;
        // セッションにログインユーザが入っていなかったらfalse
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;}

            return $result;

        }

        /*ログアウト処理*/
        public static function logout(){$_SESSION = array();
        session_destroy();}
    }
?>

<?php


    session_start();

    $err=[];

    if(!$user=filter_input(INPUT_POST,'user')){
        $err['user']='ユーザー名を入力してください';
    }

    if(!$password=filter_input(INPUT_POST,'password')){
        $err['password']='パスワードを入力してください';
    }

    if(count($err) > 0){
        // エラーの場合
        $_SESSION = $err;
        header('Location: ./login.php');
        //http://192.168.10.120/map_project/login.php
        return;
    }
    $result = UserLogic::login($user, $password);

    if(!$result){
        header('Location:./login.php');
        // http://192.168.10.120/map_project/login.php
        return;
    }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
    <style>
        .label-title {
 font-size: 40px;
 text-align: center;
 border: solid 3px  #340beb;
  border-radius: 6px;
  background:  #340beb;
  color: #fff;
}
 
 
 
form {
 margin-left: auto;
 margin-right: auto;
 max-width: 720px;
 }
 
 
.radioinput {
 text-align: center;
 }
 
 
.form-sample {
 width: 100%;
 display: flex;
 align-items: center;
 padding-left: 14px;
 padding-right: 14px;
 padding-bottom: 15px;
}
 
.form-radio {
 display: flex;
 width: 100%;
 display: flex;
 align-items: center;
 padding-left: 14px;
 padding-right: 14px;
 padding-bottom: 15px;
 }
 
 
 
.radio-label {
 width: 100%;
 max-width: 500px;
 margin-left: 20px;
font-size: 18px;
}
 
 
.form-label {
 width: 100%;
 max-width: 248px;
 font-weight: bold;
 font-size: 19px;
}
 
.form-label.last {
 margin-top: 10px;
 margin-bottom: auto;
}
 
.form-require {
 border-radius: 5px;
 margin-right: 10px;
 padding-top: 10px;
 padding-bottom: 10px;
 width: 55px;
 display: inline-block;
 text-align: center;
 background: #340beb;
 /* background: #999; */
 color: #fff;
 font-size: 15px;
}
 
.form-input {
 border: 1px solid gray;
 border-radius: 5px;
 margin-left: 40px;
 padding-left: 10px;
 height: 50px;
 width: 100%;
 max-width: 410px;
 font-size: 18px;
}
 
.form-textarea {
 border: 1px solid gray;
 border-radius: 6px;
 margin-left: 40px;
 padding-left: 1em;
 padding-right: 1em;
 height: 216px;
 flex: 1;
 width: 100%;
 max-width: 410px;
 font-size: 18px;
}
 
.form-Btn {
 border-radius: 6px;
 margin-top: 32px;
 margin-left: auto;
 margin-right: auto;
 padding-top: 20px;
 padding-bottom: 20px;
 width: 280px;
 display: block;
 letter-spacing: 0.05em;
 background: #340beb;
 color: #fff;
 font-weight: bold;
 font-size: 20px;
}
    </style>
</head>
<body>
    <?php if(count($err)>0): ?>
    <?php foreach($err as $e):?>
        <p><?php echo $e ?></p>
    <?php endforeach ?>
    <?php else : ?>
        <!-- ログイン成功画面 -->
        <form>
    <p class="label-title">除雪質問フォーム</p>
   <div class="form-sample">
     <p class="form-label"><span class="form-require">必須</span>氏名</p>
     <input type="text" class="form-input" placeholder="例）鈴木一郎">
   </div>
   <!-- <div class="form-sample">
     <p class="form-label"><span class="form-require">必須</span>電話番号</p>
     <input type="text" class="form-input" placeholder="例）123-4567-8910">
   </div> -->
   <div class="form-sample">
     <p class="form-label"><span class="form-require">必須</span>メールアドレス</p>
     <input type="email" class="form-input" placeholder="例）sample@gmail.com">
   </div>
   <div class="form-sample">
     <p class="form-label last"><span class="form-require">必須</span>お問い合わせ内容</p>
     <textarea class="form-textarea"></textarea>
   </div>
   <input type="submit" class="form-Btn" value="送信する">
 </form>

        <!-- <p>タカ</p> -->
    <?php endif ?>

    <a href="./login.php">戻る</a>
    <a href="./add_information.html">情報追加</a>
    <!-- http://192.168.10.120/map_project/login.php -->
</body>
</html>

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
                echo 'DB接続成功';
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
            $result = false;
            // ユーザをemailから検索して取得
            $user = self::getUserByUser($user);

            if (!$user) {
            $_SESSION['msg'] = 'emailが一致しません。';
            return $result;
            }

            //パスワードの照会
            if (password_verify($password, $user['password'])) {
            //ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
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
            $sql = 'SELECT * FROM josetu_user WHERE user = ?';

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
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['user'] > 0) {
            return $result = true;}

            return $result;

        }

        /*ログアウト処理*/
        public static function logout(){$_SESSION = array();
        session_destroy();}
    }

    
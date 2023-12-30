<?php 

ini_set('display_errors',true);

    function connect(){
        try{
                $DB_DATABASE = 'josetu_user';
                $DB_USERNAME = 'root';
                $DB_PASSWORD = '';
                $DB_OPTION = 'charset=utf8mb4';
                $PDO_DSN = "mysql:host=localhost;dbname=" . $DB_DATABASE . ";" . $DB_OPTION; #DSN  データソースネームmysqlの場合

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
    // function get_name($db){
    //     $stmt = $db->prepare("select score from users where name=?");
    //     $stmt->bindValue(1,'user_1',PDO::PARAM_STR);
    //     $stmt->execute();
    //     $username = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $username;
    // }


?>
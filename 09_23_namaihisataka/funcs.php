<?php
//共通に使う関数を記述
function h($a){
    return htmlspecialchars($a, ENT_QUOTES);
}

function db_con(){
    try {
        $pdo = new PDO('mysql:dbname=bookm;charset=utf8;host=localhost','root','');
        return $pdo;
    } catch (PDOException $e) {
        exit('DB-Connection-Error:'.$e->getMessage());
      }      
}

function redirect($page){
    header("Location: ".$page);
    exit;
}

function sqlError($stmt){ 
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
  }


//WEBに保持されるユニークIDがサーバーにない場合に、見れなくする処理
function sessChk(){
    if (!isset($_SESSION["chk_ssid"]) ||
        $_SESSION["chk_ssid"]!=session_id()){
        exit("Error");
    } else {
        session_regenerate_id(true);
        $_SESSION["chk_ssid"]=session_id();
    }
}

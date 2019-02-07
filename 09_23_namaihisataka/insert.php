<?php
//1. POSTデータ取得
// $name = filter_input( INPUT_GET, "name" ); //こういうのもあるよ
// $email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$url = $_POST["url"];
$comment = $_POST["comment"];


//2. DB接続します
// try {
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //rootはID、XAPPは最後のパスワード空欄
// } catch (PDOException $e) {
//   exit('DB-Connection-Error:'.$e->getMessage());
// }

//上記をファンクション化 include
include("funcs.php");
$pdo = db_con();



//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(name,url,comment,datetime)VALUES(:name,:url,:comment,sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  // function sqlError($stmt){
  //   $error = $stmt->errorInfo();
  //   exit("ErrorSQL:".$error[2]);
  // }
  sqlError($stmt);
}else{
  //５．index.phpへリダイレクト
// function redirect($page){
//   header("LOCATION: ".$page);
//   exit;
// }
redirect("index.php");
}
?>

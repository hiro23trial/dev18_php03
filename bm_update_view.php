<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
require_once('funcs.php');

//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
$id    = $_POST["id"];

//2. DB接続します
$pdo=db_conn();


//３．データ登録SQL作成、更新
$stmt = $pdo->prepare("UPDATE 
                            gs_bm_table_2 
                        SET 
                            bookname=:bookname,
                            url=:url,
                            comment=:comment,
                            indate=sysdate()
                        WHERE
                            id=:id;
                        ");
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}else{
    //*** function化する！*****************
    header("Location: index.php");
    exit();
}
?>

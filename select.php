<?php

require_once('funcs.php');
$pdo=db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_bm_table_2");
$status = $stmt->execute();

//３．データ表示
// $view="";
// if ($status==false) {
//     //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);

// }else{
//   //Selectデータの数だけ自動でループしてくれる
//   //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
//   while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= '<a href="bm_update_view.php?id=' .'<p>'.'登録日時：'.h($result['indate']).'</p>'.'<p>'.'書籍名：'.h($result['bookname']).'</p>'.'<p>'.'URL：'.h($result['url']).'</p>'.'<p>'.'感想：'.h($result['comment']).'</p>'.'<p>'.'------------------------------------------------'.'</p>';
//   }
// }

$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        // 詳細ページリンク
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result["bookname"] . "：" . $result["url"];
        $view .= '</a>';
        
        // 削除ページリンク
        $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '【削除】';
        $view .= '</a>';
        $view .= '</p>';
    }
}
// $view.は変数viewに追加していくと言う意味
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お気に入りの本</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">お気に入りの本</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>

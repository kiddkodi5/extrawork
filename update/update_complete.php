<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント更新完了画面</title>
	<link rel="stylesheet" type="text/css" href="style3.css">
	<style type="text/css">
	<!--
a:link  { color : white; text-decoration: none; }
a:visited  { color : white; text-decoration: none; }
-->
	</style>
</head>

<body>
	
	<img src="../diblog_logo.jpg">
    <header>  
    <ul>
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
		<li><a href ="../list/list.php">アカウント一覧</a></li>
		<li><a href="regist.html">アカウント登録</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
       </ul>
    </header>
	
	<h3>アカウント更新完了画面</h3>
	<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}


date_default_timezone_set('Asia/Tokyo');
$date = new DateTime();

mb_internal_encoding("utf-8");
try{
$pdo=new PDO("mysql:dbname=assighment;host=localhost;", "root", "root");


$pdo->exec("update account set family_name = '".$_POST['family_name']."' where id= $id");
$pdo->exec("update account set first_name = '".$_POST['first_name']."' where id= $id");
$pdo->exec("update account set family_name_kana = '".$_POST['family_name_kana']."' where id= $id");
$pdo->exec("update account set first_name_kana = '".$_POST['first_name_kana']."' where id= $id");
$pdo->exec("update account set mail = '".$_POST['mail']."' where id= $id");
$pdo->exec("update account set password = '".$_POST['password']."' where id= $id");
$pdo->exec("update account set gender = '".$_POST['gender']."' where id= $id");
$pdo->exec("update account set postal_code = '".$_POST['postal_code']."' where id= $id");
$pdo->exec("update account set prefecture = '".$_POST['prefecture']."' where id= $id");
$pdo->exec("update account set address_1 = '".$_POST['address_1']."' where id= $id");
$pdo->exec("update account set authority = '".$_POST['authority']."' where id= $id");
$pdo->exec("update account set update_time = '".$date->format("Y-m-d H:i:s")."' where id= $id");
echo '<h1>更新完了しました</h1>' ;
}catch(PDOException $e){
	echo 'エラーが発生したため、アカウントを更新できませんでした。';
}


?>
	
	
	<form action="../index.html">
		<input type="submit" class="top" value="TOPページへ戻る">
	</form>
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	</body>
	
	
</html>
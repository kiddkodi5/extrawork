
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント登録完了画面</title>
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
	<h3>アカウント登録完了画面</h3>
<?php
	date_default_timezone_set('Asia/Tokyo');
	$date = new DateTime();

	mb_internal_encoding("utf-8");
try{
	$pdo=new PDO("mysql:dbname=assighment;host=localhost;", "root", "root");

	if(isset($_POST['family_name'],$_POST['first_name'], $_POST['family_name_kana'],$_POST['first_name_kana'], $_POST['mail'],$_POST['password'],$_POST['gender'], $_POST['postal_code'],$_POST['prefecture'], $_POST['address_1'], $_POST['address_2'],$_POST['authority'])){
	$pdo->exec("insert into account(family_name, first_name, family_name_kana, first_name_kana, mail, password, gender, postal_code, prefecture, address_1, address_2, authority,registered_time)"."values('".$_POST['family_name']."', '".$_POST['first_name']."', '".$_POST['family_name_kana']."', '".$_POST['first_name_kana']."', '".$_POST['mail']."', '".$_POST['password']."', '".$_POST['gender']."', '".$_POST['postal_code']."', '".$_POST['prefecture']."', '".$_POST['address_1']."', '".$_POST['address_2']."', '".$_POST['authority']."', '".$date->format("Y-m-d H:i:s")."');");}
	echo '<h1>登録完了しました</h1>';
	}catch(PDOException $e){
	echo 'エラーが発生したためアカウント登録できません。';
}
?>
	
	<form action="../index.html">
		<input type="submit" class="top" value="TOPページへ戻る">
	</form>
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	</body>
	
	
</html>
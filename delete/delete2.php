<?php
mb_internal_encoding("utf-8");

try{
	$pdo = new PDO("mysql:dbname = assighment; host =localhost;","root","root");
	
	$id = $_POST['id'];
	
	$stmt = $pdo->query("select * from account where id = $id");
	
	while($row = $stmt->fetch()){
		$rows[] =$row;
	}
	
	$pso = null;
}catch(PDOEXception $e){
	echo 'エラーが発生したため、アカウントを取得できませんでした。';
}

?>

<!DOCTYPE html>
<html lang="ja">

	
<head>
	<meta charset="utf-8">
	<title>アカウント削除画面</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>


<body>
	  
	  <img src="../diblog_logo.jpg">
    <header>  
    <ul>
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
		<li><a href="../list/list.php">アカウント一覧</a></li>
		<li><a href="../regist/regist.php">アカウント登録</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
       </ul>
    </header>
	
	<h3>アカウント削除画面</h3>
	
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
	</body>








</html>
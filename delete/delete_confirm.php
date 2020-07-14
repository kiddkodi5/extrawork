<!DOCTYPE html>
<html lang="ja">

	
<head>
	<meta charset="utf-8">
	<title>アカウント削除確認画面</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
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
	
	<h3>アカウント削除確認画面</h3>
	
	<?php
			mb_internal_encoding("utf-8");
			$database_error = false;
			try{
				$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			/*echo '接続成功';*/
				if(isset($_POST['id'])){
				$id = $_POST['id'];
				$stmt = $pdo->query("select * from account where id = $id");
			}
				
			$pdo= null;
			/*データベース切断*/
				
			}catch(PDOException $e){
				echo 'エラーが発生しました。';
				$database_error = true;
				echo '<p><button type="button" onclick="history.back()">前に戻る</button></p>';
			}
			if($database_error == false){
			?>
	<?php if(isset($_POST['id'])){
	
	echo '本当に削除してよろしいですか？';
	echo '<p><button type="button" onclick="history.back()">前に戻る</button></p>';
	echo'<form method="post" action="../delete/delete_complete.php">
	<input type="submit" name="delete" value="削除する">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>';
		 } ?>
	
			
 <?php }?>
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
	</body>
</html>
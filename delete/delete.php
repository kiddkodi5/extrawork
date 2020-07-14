

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
	
	
	<?php
			mb_internal_encoding("utf-8");
			$database_error = false;
			try{
				$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			/*echo '接続成功';*/
				if(isset($_POST['id'])){
				$id = $_POST['id'];
				
					
			$stmt = $pdo->query("select * from account where id = $id");
			
			while($row = $stmt->fetch()){
				$rows[] =$row;
			}
			
				}
			/*　↑　=foreach($stmt as $row){
				$rows[] = $row;
			}*/
			
			$pdo= null;
			/*データベース切断*/
				
			}catch(PDOException $e){
				echo 'エラーが発生したため、アカウントを取得できませんでした。';
				$database_error = true;
			}
	if($database_error == false){
			?>
	
	<?php if(isset($_POST['id'])){
				foreach($rows as $row){?>
	
	<p>名前（姓）
		<?php echo $row['family_name']; ?>
	</p>
	<p>名前（名）
		<?php echo $row['first_name']; ?>
	</p>
	<p>カナ（姓）
		<?php echo $row['family_name_kana']; ?>
	</p>
	<p>カナ（名）
		<?php echo $row['first_name_kana']; ?>
	</p>
	<p>メールアドレス
		<?php echo $row['mail']; ?>
	</p>
	<p>性別
		<?php 
	$gender = $row['gender'];
		switch($gender){
			case 0:
				echo '男';
				break;
			case 1:
				echo '女';
				break;
		}
		?>
	</p>
	<p>郵便番号
		<?php echo $row['postal_code']; ?>
	</p>
	
	<p>住所（都道府県）
		<?php echo $row['prefecture']; ?>
	</p>
	
	<p>住所（市区町村）
	<?php echo $row['address_1']; ?>
	</p>
	
	<p>住所（番地）
	<?php echo $row['address_2']; ?>
	</p>
	<p>アカウント権限
		<?php 
		$authority = $row['authority'];
		switch($authority){
			case 0:
				echo '一般';
				break;
			case 1:
				echo '管理者';
				break;
		}
}
		?>
	</p>
		
			
		<form method="post" action="../delete/delete_confirm.php">
		<input type="submit" name="delete" value="確認する">
		<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
				
				
				<!--idのデータを送ってdeleteのページでidを元にそのアカウントの情報を呼び出す-->
			</form>
<?php }}else{
	echo 'アカウントが選択されていません。';
	echo '<form method="post" action="../list/list.php">
				<input type="submit" name="list_back" value="アカウント一覧に戻る"></form>';
}?>
	
	
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
	</body>








</html>
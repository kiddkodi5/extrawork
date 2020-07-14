

<!DOCTYPE html>
<html lang="ja">

	
<head>
	<meta charset="utf-8">
	<title>アカウント一覧画面</title>
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
		<li><a href="list.php">アカウント一覧</a></li>
		<li><a href="../regist/regist.php">アカウント登録</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
       </ul>
    </header>
	
	<h3>アカウント一覧画面</h3>
	
	
	<?php
			mb_internal_encoding("utf-8");
			
			try{
				$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			/*echo '接続成功';*/
			
				
			$stmt = $pdo->query("select * from account order by id DESC");
			
			while($row = $stmt->fetch()){
				$rows[] =$row;
			}
			
			/*　↑　=foreach($stmt as $row){
				$rows[] = $row;
			}*/
			
			$pdo= null;
			/*データベース切断*/
				
	?>
			<table border="1px">
	<tr>
		<td>ID</td>
		<td>名前（姓）</td>
		<td>名前（名）</td>
		<td>カナ（姓）</td>
		<td>カナ（名）</td>
		<td>メールアドレス</td>
		<td>性別</td>
		<td>アカウント権限</td>
		<td>削除フラグ</td>
		<td>登録日時</td>
		<td>更新日時</td>
		<td>操作</td>
	</tr>
			<?php foreach($rows as $row){
	?>
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['family_name']; ?></td>
		<td><?php echo $row['first_name']; ?></td>
		<td><?php echo $row['family_name_kana']; ?></td>
		<td><?php echo $row['first_name_kana']; ?></td>
		<td><?php echo $row['mail']; ?></td>
		<td><?php 
	$gender = $row['gender'];
		switch($gender){
			case 0:
				echo '男';
				break;
			case 1:
				echo '女';
				break;
		}
		?></td>
		<td><?php 
		$authority = $row['authority'];
		switch($authority){
			case 0:
				echo '一般';
				break;
			case 1:
				echo '管理者';
				break;
		}
		?></td>
		<td><?php 
		$delete_flag = $row['delete_flag'];
			switch($delete_flag){
				case 0:
					echo '有効';
					break;
				case 1:
					echo '無効';
					break;
			}
			?>
		
		</td>
		<td><?php echo $row['registered_time']; ?></td>
		<td><?php echo $row['update_time']; ?></td>
		<!--余裕があったらで構いません。ぜひ表示する日付のフォーマットをいじってあげてくだしい-->
		<td>
			<form method="post" action="../update/update.php">
			<input type="submit" name="update" value="更新">
				<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
				
			</form>
			
			<form method="post" action="../delete/delete.php">
			<input type="submit" name="delete" value="削除">
				<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
				
				
				<!--idのデータを送ってdeleteのページでidを元にそのアカウントの情報を呼び出す-->
			</form>
				</td>
	</tr>
<?php } 
		
				
			}catch(PDOException $e){
				echo '<div class="error">エラーが発生したため、アカウントを取得できませんでした。</div>';
			}
			
			?>
	
	
	
	
	
	
	
	
	
	</table>
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
	</body>








</html>
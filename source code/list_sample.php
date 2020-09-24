<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント一覧画面</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<img src="diblog_logo.jpg">
	<header>
	<ul>
		<li><a href="index.php">トップ</a></li>
		<li>プロフィール</li>
		<li>DIBlogについて</li>
		<li>登録フォーム</li>
		<li><a href="list.php">アカウント一覧</a></li>
		<li><a href="regist.php">アカウント登録</a></li>
		<li>問い合わせ</li>
		<li>その他</li>
	</ul>
	</header>
	
	<h3>アカウント一覧画面</h3>
	
	<form action="" method="post">
	<table border="1px">
		<tr>
			<td>名前（姓）</td>	
				<td><input type="text" name="family_name" value="<?php if(isset($_POST['family_name'])){echo $_POST['family_name'];} ?>"></td>
			<td>名前（名）</td>
				<td><input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>"></td>
		</tr>
		<tr>
			<td>カナ（姓）</td>	
				<td><input type="text" name="family_name_kana" value="<?php if(isset($_POST['family_name_kana'])){echo $_POST['family_name_kana'];} ?>"></td>
			<td>カナ（名）</td>
				<td><input type="text" name="first_name_kana" value="<?php if(isset($_POST['first_name_kana'])){echo $_POST['first_name_kana'];} ?>"></td>
		</tr>
		<tr>
			<td>メールアドレス</td>	
				<td><input type="text" name="mail" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>"></td>
			<td>性別</td>
				<td><input type="radio" name="gender" value="0" <?php if(isset($_POST['gender'])){if($_POST['gender'] == 0){echo 'checked';}}?>>男
					<input type="radio" name="gender" value="1" <?php if(isset($_POST['gender'])){if($_POST['gender'] == 1){echo 'checked';}}?>>女
					<input type="radio" name="gender" value="2" <?php if(!isset($_POST['gender']) or $_POST['gender'] == 2){echo 'checked';}?>>なし
				</td>
		</tr>
		<tr>
			<td>権限</td>
				<td><select class="dropdown" name="authority">
						<option value="0" <?php if(isset($_POST['authority'])){if($_POST['authority'] == 0){echo 'selected';}}?>>一般</option>
						<option value="1" <?php if(isset($_POST['authority'])){if($_POST['authority'] == 1){echo 'selected';}}?>>管理者</option>
						<option value="2" <?php if(!isset($_POST['authority']) or $_POST['authority'] == 2){echo 'selected';}?>>なし</option>
					</select></td>
			<td><input type="submit" class="submit" value="検索"></td>
		</tr>
	</table>
	</form>
	
	<?php
		mb_internal_encoding("utf-8");
		try{
			//php本文
			$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			
			//sql文を作成
			//↓これで”初期表示”と”空検索”を分ける
			if(isset($_POST['family_name'])){
				$family_name = $_POST['family_name'];
				$first_name = $_POST['first_name'];
				$family_name_kana = $_POST['family_name_kana'];
				$first_name_kana = $_POST['first_name_kana'];
				$mail = $_POST['mail'];
				$gender = $_POST['gender'];
				$authority = $_POST['authority'];
			
				//sql文のベース
				$sql = "select * from account";
			//パターン１　何にも入れずに検索（＝各項目に”空”と”なし”が入っている）	
				if(empty($_POST['family_name']) and empty($_POST['first_name']) and empty($_POST['family_name_kana']) and empty($_POST['first_name_kana']) and empty($_POST['mail']) and $_POST['gender'] == "2" and $_POST['authority'] =="2"){
				echo "パターン1 何にも入ってない　＆　２";
				echo $sql;
					//パターン２　何か入ってる
				}else{
					echo "なんか入ってる";
					$cnt=0;
					if(isset($_POST['family_name'])){
						//↓もしnull以外の値が入ってるなら実行
						if(!is_null($_POST['family_name'])){
						echo $_POST['family_name'];
						if($cnt == 0){
							$sql = $sql."where ";
						}else{
							$sql = $sql."and ";
						}
						$sql = $sql."family_name LIKE '%$family_name%' ";
						$cnt++;
						}
					}
					if(isset($_POST['first_name'])){
						//↓もしnull以外の値が入ってるなら実行
						if(!is_null($_POST['first_name'])){
						echo $_POST['first_name'];
						if($cnt == 0){
							$sql = $sql."where ";
						}else{
							$sql = $sql."and ";
						}
						$sql = $sql."first_name LIKE '%$first_name%' ";
						$cnt++;
						}
					}
					if(isset($_POST['family_name_kana'])){
						//↓もしnull以外の値が入ってるなら実行
						if(!is_null($_POST['family_name_kana'])){
						echo $_POST['family_name_kana'];
						if($cnt == 0){
							$sql = $sql."where ";
						}else{
							$sql = $sql."and ";
						}
						$sql = $sql."family_name_kana LIKE '%$family_name_kana%' ";
						$cnt++;
						}else{
							echo "a";
						}
					}
					if(isset($_POST['first_name_kana'])){
						//↓もしnull以外の値が入ってるなら実行
						if(!is_null($_POST['first_name_kana'])){
						echo $_POST['first_name_kana'];
						if($cnt == 0){
							$sql = $sql."where ";
						}else{
							$sql = $sql."and ";
						}
						$sql = $sql."first_name_kana LIKE '%$first_name_kana%' ";
						$cnt++;
						}
					}
					if(isset($_POST['mail'])){
						//↓もしnull以外の値が入ってるなら実行
						if(!is_null($_POST['mail'])){
						echo $_POST['mail'];
						if($cnt == 0){
							$sql = $sql."where ";
						}else{
							$sql = $sql."and ";
						}
						$sql = $sql."mail LIKE '%$mail%' ";
						$cnt++;
						}
					}
					
					
					
					
				}
				
				
				
			$stmt = $pdo->query($sql."order by id DESC");
			while($row = $stmt->fetch()){
				$rows[] = $row;
			}
				if(isset($_POST['family_name'])){foreach($rows as $row){
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
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['family_name']; ?></td>
		<td><?php echo $row['first_name']; ?></td>
		<td><?php echo $row['family_name_kana']; ?></td>
		<td><?php echo $row['first_name_kana']; ?></td>
		<td><?php echo $row['mail']; ?></td>
		<td><?php echo $row['gender'];
					switch($gender){
						case 0:
							echo '女';
							break;
						case 1:
							echo '男';
							break;
					}?>
		</td>
		<td><?php echo $row['authority'];
					switch($authority){
						case 0:
							echo '一般';
							break;
						case 1:
							echo '管理者';
							break;
					}?>
		</td>
		<td><?php $delete_flag = $row['delete_flag'];
					switch($delete_flag){
						case 0:
							echo '有効';
							break;
						case 1:
							echo '無効';
							break;
					}?>
		</td>
		<td><?php echo $row['registered_time']; ?></td>
		<td><?php echo $row['update_time']; ?></td>
		<td><form method="post" action="update.php">
				<input type="submit" name="update" value="更新">
				<input type="hidden" value="<?php echo $row['id']; ?>">
			</form>
			<form method="post" action="delete.php">
				<input type="submit" name="delete" value="削除">
				<input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
			</form>
		</td>
	</tr>
	</table>
	<?php
				}}
			
			
			
			
		}}catch(PDOException $e){
			echo '<div class="error">エラーが発生したため、アカウントを取得できませんでした。</div>';
		}	
	
	?>
	
	
	
	
	
	
	
	
</body>
<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.
</footer>
</html>
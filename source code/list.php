<?php
session_start();

			/*mb_internal_encoding("utf-8");
			
			try{$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			echo $_SESSION['mail']."1";	*/
				/*//$row['authority']を取得する
				//その$row['authority']をセッションに入れる
				//そのセッションが０か１かによって再度ログインページに飛ばすかどうか判断
			if(isset($_POST['mail'])){
				$_SESSION['mail'] = $_POST['mail'];
				$mail = $_POST['mail'];
				$stmt = $pdo->prepare("select * from account where mail = $mail");
				$stmt->execute([$_POST['mail']]);
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$rows[] = $row;
				echo $row['authority'];
			}*/
//アカウントを持っていない人が直接このページにアクセスした場合はログインが必要であることを表示の上、ログインページへ誘導
		if(empty($_SESSION['mail'])){
			if(empty($_POST['mail'])){
				require_once("body_top.php");
				echo '</br>ログインしてください。</br>';
				echo '<form method="post" action="login.php"><input type="hidden" value="a" name="page_code"><input type="submit" value="ログインページへ進む"></form>';
				require_once("footer.php");
				exit();
			}
		}
	
		try{
	$pdo = new PDO("mysql:dbname=assighment;host=localhost;", "root", "root");
	$stmt = $pdo->prepare('select * from account where mail = ?');
	$stmt->execute([$_SESSION['mail']]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
	echo "エラー発生したため、ログイン情報が取得できません。";
	echo $e->getMessage();
	die();
}
if(!isset($row['mail'])){
			require_once("body_top.php");
			echo '</br>メールアドレスまたはパスワードが間違っています。1';
			echo '<form method="post" action="login.php"><input type="submit" value="ログインページへ戻る"></form>';
			require_once("footer.php");
			exit();
		}
			
		if(!isset($_SESSION['password'])){
			echo 'post:'.$_POST['password'];
			echo 'row:'.$row['password'];
		if(password_verify($_POST['password'], $row['password'])){
		$_SESSION['mail'] = $row['mail'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['id'] = $row['id'];
		echo 'ログインしました。';
		}else{
?>

<!DOCTYPE html>
		<html lang="ja">

			<head>
		<meta charset="utf-8">
		<title>トップページ</title>
		<link rel="stylesheet" type="text/css" href="style.css">
			</head>
		<?php
			require_once("body.php");
			echo '</br>メールアドレスまたはパスワードが間違っています。';
		?>
			<form method="post" action="login.php">
				<input type="hidden" name="mail" value="<?php echo $_POST['mail'] ?>">
				<input type="submit" value="ログイン画面に戻る。">
			</form>
			  
		<?php
				require_once("footer.php");
		/*header('Location: http://localhost/account/extrawork/extrawork/login.php');*/
			/*session_destroy();*/
			exit();
		}
		}
?>
			<!DOCTYPE html>
		<html lang="ja">

			<head>
		<meta charset="utf-8">
		<title>トップページ</title>
		<link rel="stylesheet" type="text/css" href="style.css">
			</head>
			<?php
			
		if($row['authority'] == 0){
			require_once("body.php");
			echo '<br>';
			echo 'アカウントの権限がありません。';
			?>
			<form method="post" action="index.php">
				<input type="hidden" name="mail" value="<?php echo $_POST['mail'] ?>">
				<input type="submit" value="トップページに戻る。">
			</form>
			<?php
				require_once("footer.php");
			exit();
		}
	/*	}*/
		?>
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
        <li>D.I.Blogについて</li>
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
				<td><input type="text" name="mail" value="<?php if(isset($_POST['mail']) and isset($_POST['family_name'])){echo $_POST['mail'];} ?>"></td>
			<td>性別</td>
				<td><input type="radio" name="gender" value="0" <?php if(!isset($_POST['gender']) or $_POST['gender'] == 0){echo 'checked';}?>>男
					<input type="radio" name="gender" value="1" <?php if(isset($_POST['gender'])){if($_POST['gender'] == 1){echo 'checked';}}?>>女
					<input type="radio" name="gender" value="2" <?php if(isset($_POST['gender'])){if($_POST['gender'] == 2){echo 'checked';}}?>>なし
				</td>
		</tr>
		<tr>
			<td>権限</td>
				<td><select class="dropdown" name="authority">
						<option value="0" <?php if(!isset($_POST['authority']) or $_POST['authority'] == 0){echo 'selected';}?>>一般</option>
						<option value="1" <?php if(isset($_POST['authority'])){if($_POST['authority'] == 1){echo 'selected';}}?>>管理者</option>
						<option value="2" <?php if(isset($_POST['authority'])){if($_POST['authority'] == 2){echo 'selected';}}?>>なし</option>
					</select>
				</td>
			<td><input type="submit" class="submit" value="検索"></td>
		</tr>
		</table>
		
	</form>
	
	
	<?php
			if(isset($_POST['family_name'])){
				$family_name = $_POST['family_name'];
				$first_name = $_POST['first_name'];
				$family_name_kana = $_POST['family_name_kana'];
				$first_name_kana = $_POST['first_name_kana'];
				$mail = $_POST['mail'];
				$gender = $_POST['gender'];
				$authority = $_POST['authority'];
				
				$stmt = $pdo->query("select id from account where mail = $mail");
				
				
		/*	↓全部の値が空でなおかつ性別＆権限が２（なし）の時＝そのまま検索ボタン押下*/
			if(empty($_POST['family_name']) and empty($_POST['first_name']) and empty($_POST['family_name_kana']) and empty($_POST['first_name_kana']) and empty($_POST['mail']) and $_POST['gender'] =="2" and $_POST['authority'] == "2"){
				$stmt = $pdo->query("select * from account order by id DESC");
				//↑この部分も↓の９ゾーンにまとめられる。
				/*↓どっかに何かしらの値が入っていたら検索ヒットした項目のみ表示*/
			}elseif(isset($_POST['family_name']) or isset($_POST['first_name']) or isset($_POST['family_name_kana']) or isset($_POST['first_name_kana']) or isset($_POST['mail'])){
				$sql = "select * from account ";
				$cnt = 0;
				if(isset($_POST['family_name']) and !empty($_POST['family_name'])){
					if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."family_name LIKE '%$family_name%' ";
					$cnt++;
				}
				
				if(isset($_POST['first_name']) and !empty($_POST['first_name'])){
					if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."first_name LIKE '%$first_name%' ";
					$cnt++;
				}
				
				if(isset($_POST['family_name_kana']) and !empty($_POST['family_name_kana'])){
						if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."family_name_kana LIKE '%$family_name_kana%' ";
					$cnt++;
					}
				
				if(isset($_POST['first_name_kana']) and !empty($_POST['first_name_kana'])){
					if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."first_name_kana LIKE '%$first_name_kana%' ";
					$cnt++;
				}
				if(isset($_POST['mail']) and !empty($_POST['mail'])){
					if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."mail LIKE '%$mail%' ";
					$cnt++;
				}
				
				if($_POST['gender'] == 0 or $_POST['gender'] == 1){
					if($cnt == 0){
						$sql = $sql."where ";
					}else{
						$sql = $sql."and ";
					}
					$sql = $sql."gender = '$gender' ";
					$cnt++;
				}
				
				if($_POST['authority'] == 0 or $_POST['authority'] == 1){
					if($cnt == 0){
						$sql = $sql."where ";
				}else{
						$sql = $sql."and ";
				}
					$sql = $sql."authority = '$authority' ";
					$cnt++;
				}
			
				/*echo $family_name."<br>";
				echo $sql;*/
				$stmt = $pdo->query($sql."order by id DESC");
			}else{echo "何もなし";}
				
			while($row = $stmt->fetch()){
				$rows[] =$row;
				
			}
			?>		
		<!--<table border="1px">
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
	</tr>-->
			<?php
				}
			$pdo= null;
			/*データベース切断*/
			
	?>
	
	
			<?php if(isset($rows)){
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
	<?php
	foreach((array)$rows as $row){
		//(array)はforeachが扱うことのできるデータが”配列”もしくは”オブジェクト”のため、配列化にする。
		//https://qiita.com/takuma-jpn/items/678876ad12b9ae9998ac
		//isset($rows)をおくことによって該当する項目がなかった場合を定義し、何もDBから値が得られなかった場合にはfalseを返す
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
		
		<td>
			<form method="post" action="update.php">
				<input type="submit" name="update" value="更新">
				<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
			</form>
			
			<form method="post" action="delete.php">
				<input type="submit" name="delete" value="削除">
				<input type="hidden" value="<?php echo $row['id']; ?>" name="id">
			</form>
				</td>
	</tr>
<?php }
	 }elseif(!isset($rows) and isset($family_name)){
		//rowsは未定義（検索してヒットせず値が返ってきていない）、でも、family_nameには空であれなんであれ値が入っている（とりあえず検索ボタンが押される）
		echo "該当するデータがありませんでした。";
	}
	/*}catch(PDOException $e){
		echo '<div class="error">エラーが発生したため、アカウントを取得できませんでした。</div>';
			}*/
			
											?>

</table>
<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>
</body>
</html>
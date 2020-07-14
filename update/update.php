

<!DOCTYPE html>
<html lang="ja">

	
<head>
	<meta charset="utf-8">
	<title>アカウント更新画面</title>
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
	
	<h3>アカウント更新画面</h3>
	
	<?php
			mb_internal_encoding("utf-8");
			$database_error = false;
			try{
				$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			/*echo '接続成功';*/
				if(isset($_POST['id'])){
				$id = $_POST['id'];
				/*echo $id;*/
				
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
				echo 'エラーが発生したためアカウントが読み込めません。';
				$database_error = true;
			}
	if($database_error == false){
			?>
	
	<?php if(isset($_POST['id'])){foreach($rows as $row){ ?>
	
	<form method="post" action="update_confirm.php">
	
	<p>名前（姓）
		<input type="text" size="30" maxlength="10" name="family_name" value="<?php echo $row['family_name']; ?>" >
		
	</p>
	<p>名前（名）
		<input type="text" size="30" maxlength="10" name="first_name" value="<?php echo $row['first_name']; ?>">
	</p>
	<p>カナ（姓）
		<input type="text" size="30" maxlength="10" name="family_name_kana" value="<?php echo $row['family_name_kana']; ?>">
		
	</p>
	<p>カナ（名）
		<input type="text" size="30" maxlength="10" name="first_name_kana" value="<?php echo $row['first_name_kana']; ?>">
		
	</p>
	<p>メールアドレス
		<input type="text" size="30" maxlength="100" name="mail" value="<?php echo $row['mail']; ?>">
		
	</p>
		
		<p>パスワード
		<input type="password" size="30" maxlength="10" name="password" value="">
		</p>
	<p>性別
		
		<!--if文を使用し、呼び出した値が0であれば、男checked女普通をechoし、
		1が呼び出された場合は男普通の女checkedをechoする。-->
		<?php switch($row['gender']){
	case 0:
		echo '<input type="radio" name="gender" value="0" checked>男
		<input type="radio" name="gender" value="1" >女';
		break;
			
			case 1:
		echo '<input type="radio" name="gender" value="0">男
			<input type="radio" name="gender" value="1" checked>女';
		break;
}
		?>
		
		 
	
	</p>
	
	<p>
		郵便番号
		<input type="text" size="30" name="postal_code" value="<?php echo $row['postal_code']; ?>">
		</p>
		
		<p>
		住所（都道府県）
		<select name="prefecture" class="dropdown">
			<?php
	$prefs = array(
		"",
		"北海道", "青森県", "岩手県", "秋田県",
		"宮城県", "山形県", "福島県", "茨城県", "栃木県",
		"群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
		"新潟県", "富山県", "石川県", "福井県", "山梨県",
		"長野県", "岐阜県", "静岡県", "愛知県", "三重県",
		"滋賀県", "京都府", "大阪府", "兵庫県", "奈良県",
		"和歌山県", "鳥取県", "島根県", "岡山県", "広島県", 
		"山口県", "徳島県", "香川県", "愛媛県", "高知県",
		"福岡県", "佐賀県", "長崎県", "熊本県", "大分県",
		"宮崎県", "鹿児島県", "沖縄県"
	);
	echo $row['prefecture'];
	
								 
	foreach ($prefs as $pref) {
		if($row['prefecture'] == $pref){
			echo "<option value='".$pref."' selected>".$pref."</option>";
		}else{
			echo "<option value='".$pref."'>".$pref."</option>";
		}
		//else以降はどう言うこと？
		//ifの中身は「受け取った都道府県の値」と「$pref」の中身が被った時はselectedにしたものをechoする。
		//それでいて、$prefは全都道府県を繰り返し表示しているので、elseで重なっていない時の通常の選択肢を表している。。！！
		
		//そのため、else部がないとselectされている選択肢のみがechoされる。
		
	}
?>
</select>
		</p>
		
		<p>
		住所（市区町村）
		<input type="text" size="30" name="address_1" value="<?php echo $row['address_1']; ?>">
		</p>
		
		<p>
		住所（番地）
		<input type="text" size="30" name="address_2" value="<?php echo $row['address_2']; ?>">
		</p>
		
		<p>
		アカウント権限
			
		<?php switch($row['authority']){
			case 0:
				echo '<select class="dropdown" name="authority"><option value="0" selected>一般</option><option value="1">管理者</option></select>';
				break;
				
			case 1:
				echo '<select class="dropdown" name="authority">
				<option value="0">一般</option>
				<option value="1" selected>管理者</option></select>';
				break;
		}
								 ?>
		</p>
		
	
		
		<input type="submit" name="update" value="確認する">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>
			
<?php }}else{
	echo 'アカウントが選択されていません。';
	echo '<form method="post" action="../list/list.php">
				<input type="submit" name="list_back" value="アカウント一覧に戻る"></form>';
} ?>
	
	<?php } ?>
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
	</body>








</html>
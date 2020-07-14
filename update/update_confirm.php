<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント更新確認画面</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
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
	
	<h3>アカウント更新確認画面</h3>
	
	<?php
			mb_internal_encoding("utf-8");
			$database_error = false;
			try{
				$pdo = new PDO("mysql:dbname=assighment;host=localhost;","root","root");
			/*echo '接続成功';*/
				if(isset($_POST['id'])){
				$id = $_POST['id'];
				echo $id;
				
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
				echo 'エラーが発生しました。';
				$database_error = true;
			}
	if($database_error == false){
			
			?>
	<?php if(isset($_POST['family_name'],$_POST['first_name'], $_POST['family_name_kana'],$_POST['first_name_kana'], $_POST['mail'],$_POST['password'],$_POST['gender'], $_POST['postal_code'],$_POST['prefecture'], $_POST['address_1'], $_POST['address_2'],$_POST['authority'])){?>
	
	<p>名前（姓）
		<?php 
		if(isset($_POST['family_name'])){
			$family_name = $_POST['family_name'];
			if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$family_name)) {
				echo $family_name;
			}elseif(empty($family_name)){
				echo '<div class="error">名前（姓）が未入力です。</div>';
			}else{
				echo '<div class="error">名前（姓）はひらがな、漢字のみ使用可能です。</div>';
			}
			}
		?>
	</p>
	
	<p>名前（名）
		<?php 
		if(isset($_POST['first_name'])){
			$first_name = $_POST['first_name'];
			if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$first_name)) {
				echo $first_name;
			}elseif(empty($first_name)){
				echo '<div class="error">名前（名）が未入力です。</div>';
			}else{
				echo '<div class="error">名前（名）はひらがな、漢字のみ使用可能です。</div>';
			}
			} ?>
	</p>
	
	<p>カナ（姓）
		<?php if(isset($_POST['family_name_kana'])){
				$family_name_kana = $_POST['family_name_kana'];
				if(preg_match("/^[ァ-ヾ]+$/u",$family_name_kana)){echo $family_name_kana;
				}elseif(empty($family_name_kana)){echo '<div class="error">カナ（姓）が未入力です。</div>';
				}else{echo '<div class="error">カナ（姓）はカタカナのみ使用可能です。</div>';
					}
			} ?>
	</p>
	
	<p>カナ（名）
		<?php if(isset($_POST['first_name_kana'])){
				$first_name_kana = $_POST['first_name_kana']; 
		if(preg_match("/^[ァ-ヾ]+$/u",$first_name_kana)) {
			echo $first_name_kana;
		}elseif(empty($first_name_kana)){
			echo '<div class="error">カナ（名）が未入力です。</div>';
		}else{
			echo '<div class="error">カナ（名）はカタカナのみ使用可能です。</div>';
		}
				} ?>
	</p>
	
	<p>メールアドレス
		<?php if(isset($_POST['mail'])){
		$mail_check = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
		//↑メールアドレス用の正規表現
		
		$mail = $_POST['mail']; 
		if(preg_match($mail_check,$mail)) {
			echo $mail;
		}elseif(empty($mail)){
			echo '<div class="error">メールアドレスが未入力です。</div>';
		}else{
			echo '<div class="error">不正なメールアドレスです。</div>';
		}
					} ?>
	</p>
	
	<p>パスワード
		<?php if(empty($_POST['password'])){
	echo "今回はパスワードを更新しません";
}else{
	

		$password = $_POST['password'];
		echo str_repeat("●", mb_strlen($password, "utf-8")); 
}
		?>
	</p>
	
	<!--パスワードをこの時点ではまだハッシュ化はしていないものの、確認画面にてそのまま表示してしまうのは、多くのサイトではないかと思い伏せ字に-->
	
	<p>性別
		<?php 
	$gender = $_POST['gender'];
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
	<!--今回は性別のデータ型がint だけど、もしここのデータ型指定がvarcharなど文字列可能の場合はこのswitchもいらない？なぜint?ラジオボックス の場合はそもそも選ぶ値が決まっているから置き換える必要はない？（ーvalueに日本語を置くのはよろしくないから？）-->
	
	<p>郵便番号
		<?php if(isset($_POST['postal_code'])){
									$postal_code = $_POST['postal_code'];
		if(preg_match("/^[0-9]{7}+$/",$postal_code)) {
			echo "$postal_code";
		}elseif(empty($postal_code)){
			echo '<div class="error">郵便番号がが未入力です。</div>';
		}else{
			echo '<div class="error">郵便番号には半角数字のみが使用可能です。</div>';
		}
								} ?>
	</p>
	
	
	<p>住所（都道府県）
		<?php if(isset($_POST['prefecture'])){
			$prefecture = $_POST['prefecture'];
		if(empty($prefecture)){
			echo '<div class="error">住所（都道府県）がが未入力です。</div>';
		}else{
			echo $prefecture;
		}
									} ?>
	</p>
	
	<p>住所（市区町村）
		<?php if(isset($_POST['address_1'])){
			$address_1 = $_POST['address_1']; 
			if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$address_1)){
				echo "$address_1";
		}elseif(empty($address_1)){
			echo '<div class="error">住所（市区町村）が未入力です。</div>';
		}else{
			echo '<div class="error">住所（市区町村）は漢字、ひらがな、カタカナのみ使用可能です。</div>';
		}
										} ?>
	</p>
	
	<p>住所（番地）
		<?php if(isset($_POST['address_2'])){
			$address_2 = $_POST['address_2']; 
			if(preg_match("/^[0-9\ \-]+$/u",$address_2)) {
				echo "$address_2";
		}elseif(empty($address_2)){
			echo '<div class="error">住所（番地）が未入力です。</div>';
		}else{
			echo '<div class="error">住所（番地）は数字、記号（ハイフンとスペース）のみ使用可能です。</div>';
		}
											} ?>
	</p>
	
	<p>アカウント権限
		<?php 
		$authority = $_POST['authority'];
		switch($authority){
			case 0:
				echo '一般';
				break;
			case 1:
				echo '管理者';
				break;
		}
		?>
	</p>
	
	<!--<p>登録日時-->
		<?php
		/*$date = new DateTime();
		echo $date->format('n/j/y');*/
		?>
	
	<!--</p>-->
	<!--<form action="regist.php">
		<input type="submit" class="back" value="前に戻る">
		
	</form>-->
	<?php 
	if(isset($_POST['family_name'])){
	$family_name = $_POST['family_name'];
	}
	if(isset($_POST['first_name'])){
	$first_name = $_POST['first_name'];
	}
	if(isset($_POST['family_name_kana'])){
	$family_name_kana = $_POST['family_name_kana'];
	}
	if(isset($_POST['first_name_kana'])){
	$first_name_kana = $_POST['first_name_kana'];
	}
	if(isset($_POST['mail'])){
	$mail = $_POST['mail'];
	}
	if(isset($_POST['password'])){
	$password = $_POST['password'];
	}
	if(isset($_POST['gender'])){
	$gender = $_POST['gender'];
	}
	if(isset($_POST['postal_code'])){
	$postal_code = $_POST['postal_code'];
	}
	if(isset($_POST['prefecture'])){
	$prefecture = $_POST['prefecture'];
	}
	if(isset($_POST['address_1'])){
	$address_1 = $_POST['address_1'];
	}
	if(isset($_POST['address_2'])){
	$address_2 = $_POST['address_2'];
	}
	if(isset($_POST['authority'])){
	$authority = $_POST['authority'];
	}
	if(isset($family_name, $first_name, $family_name_kana, $first_name_kana, $mail, $gender, $postal_code, $prefecture, $address_1, $address_2, $authority)){
	if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$family_name) and 		preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$first_name) and preg_match("/^[ァ-ヾ]+$/u",$family_name_kana) and preg_match("/^[ァ-ヾ]+$/u",$first_name_kana) and preg_match($mail_check,$mail) and preg_match("/^[0-9]{7}+$/",$postal_code) and !empty($prefecture) and preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$address_1) and preg_match("/^[0-9\ \-]+$/u",$address_2) ) { ?>
	<!--一応、history.backでも値の保持はできたけど、sessionを使ったやり方とかもあった。それを使ったほうがいいのか。-->
	
	<form method ="post" action="update_complete.php">
		<input type="submit" name='signup' value="登録する">
		
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" value="<?php echo $_POST['family_name'];?>" name="family_name">
		<input type="hidden" value="<?php echo $_POST['first_name'];?>" name="first_name">
		<input type="hidden" value="<?php echo $_POST['family_name_kana'];?>" name="family_name_kana">
		<input type="hidden" value="<?php echo $_POST['first_name_kana'];?>" name="first_name_kana">
		<input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
		<input type="hidden" value="<?php echo password_hash($_POST['password'], PASSWORD_DEFAULT);?>" name="password">
		<input type="hidden" value="<?php echo $_POST['gender'];?>" name="gender">
		<input type="hidden" value="<?php echo $_POST['postal_code'];?>" name="postal_code">
		<input type="hidden" value="<?php echo $_POST['prefecture'];?>" name="prefecture">
		<input type="hidden" value="<?php echo $_POST['address_1'];?>" name="address_1">
		<input type="hidden" value="<?php echo $_POST['address_2'];?>" name="address_2">
		<input type="hidden" value="<?php echo $_POST['authority'];?>" name="authority">
	</form>
	<?php 
	}
	}
	echo '<button type="button" onclick="history.back()">前に戻る</button>';
}else{
	echo 'アカウントが選択されていません。';
	echo '<form method="post" action="../list/list.php">
				<input type="submit" name="list_back" value="アカウント一覧に戻る"></form>';
}
	?>
	
	<?php }?>
	
	<form method="post" action="../list/list.php">
				<input type="submit" name="list_back" value="アカウント一覧に戻る">
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
</body>
</html>
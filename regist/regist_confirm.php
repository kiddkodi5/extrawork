<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>アカウント登録確認画面</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<style type="text/css">
	<!--a:link  { color : white; text-decoration: none; }
		a:visited  { color : white; text-decoration: none; }-->
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
			<li><a href="regist.php">アカウント登録</a></li>
			<li>問い合わせ</li>
			<li>その他</li>
       </ul>
    </header>
	<h3>アカウント登録確認画面</h3>
	
	<div>名前（姓）
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
	</div>
	
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
			}
		?>
	</p>
	
	<p>カナ（姓）
		<?php 
			if(isset($_POST['family_name_kana'])){
				$family_name_kana = $_POST['family_name_kana'];
				if(preg_match("/^[ァ-ヾ]+$/u",$family_name_kana)){echo $family_name_kana;
				}elseif(empty($family_name_kana)){echo '<div class="error">カナ（姓）が未入力です。</div>';
				}else{echo '<div class="error">カナ（姓）はカタカナのみ使用可能です。<div>';
					}
			}
		?>
	</p>
	
	<p>カナ（名）
		<?php 
				if(isset($_POST['first_name_kana'])){
				$first_name_kana = $_POST['first_name_kana']; 
		if(preg_match("/^[ァ-ヾ]+$/u",$first_name_kana)) {
			echo $first_name_kana;
		}elseif(empty($first_name_kana)){
			echo '<div class="error">カナ（名）が未入力です。</div>';
		}else{
			echo '<div class="error">カナ（名）はカタカナのみ使用可能です。</div>';
		}
				}
		?>
	</p>
	
	<p>メールアドレス
		<?php 
					if(isset($_POST['mail'])){
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
					}
		?>
	</p>
	
	<p>パスワード
		<?php 
						if(isset($_POST['password'])){
		$password = $_POST['password'];
		if(empty($password)){
			echo '<div class="error">パスワードが未入力です。</div>';
		}else{
		echo str_repeat("●", mb_strlen($password, "utf-8")); }
						}
		?>
		
		<!--今回は指定がないが、パスワードの指定（ex.数字、大文字小文字、記号を使わなければならない等）の場合はハッシュ化との兼ね合いはどうなるのか。-->
	</p>
	
	<!--パスワードをこの時点ではまだハッシュ化はしていないものの、確認画面にてそのまま表示してしまうのは、多くのサイトではないかと思い伏せ字に-->
	
	<p>性別
		<?php
							if(isset($_POST['gender'])){
	$gender = $_POST['gender'];
		switch($gender){
			case 0:
				echo '男';
				break;
			case 1:
				echo '女';
				break;
		}
							}
		?>
	</p>
	
	<p>郵便番号
		<?php 
								if(isset($_POST['postal_code'])){
									$postal_code = $_POST['postal_code'];
		if(preg_match("/^[0-9]{7}+$/",$postal_code)) {
			echo "$postal_code";
		}elseif(empty($postal_code)){
			echo '<div class="error">郵便番号がが未入力です。</div>';
		}else{
			echo '<div class="error">郵便番号には半角数字のみが使用可能です。</div>';
		}
								}
		?>
	</p>
	
	
	<p>住所（都道府県）
		<?php
									if(isset($_POST['prefecture'])){
			$prefecture = $_POST['prefecture'];
		if(empty($prefecture)){
			echo '<div class="error">住所（都道府県）がが未入力です。</div>';
		}else{
			echo $prefecture;
		}
									}
		?>
	</p>
	
	<p>住所（市区町村）
		<?php 
										if(isset($_POST['address_1'])){
			$address_1 = $_POST['address_1']; 
			if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$address_1)){
				echo "$address_1";
		}elseif(empty($address_1)){
			echo '<div class="error">住所（市区町村）が未入力です。</div>';
		}else{
			echo '<div class="error">住所（市区町村）は漢字、ひらがな、カタカナのみ使用可能です。</div>';
		}
										}
		?>
	</p>
	
	<p>住所（番地）
		<?php 
			if(isset($_POST['address_2'])){
			$address_2 = $_POST['address_2']; 
			if(preg_match("/^[0-9\ \-]+$/u",$address_2)) {
				echo "$address_2";
		}elseif(empty($address_2)){
			echo '<div class="error">住所（番地）が未入力です。</div>';
		}else{
			echo '<div class="error">住所（番地）は数字、記号（ハイフンとスペース）のみ使用可能です。</div>';
		}
											}
		?>
	</p>
	
	<p>アカウント権限
		<?php 
												if(isset($_POST['authority'])){
		$authority = $_POST['authority'];
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
	if(isset($family_name, $first_name, $family_name_kana, $first_name_kana, $mail, $password, $gender, $postal_code, $prefecture, $address_1, $address_2, $authority)){
	if(preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$family_name) and 		preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$first_name) and preg_match("/^[ァ-ヾ]+$/u",$family_name_kana) and preg_match("/^[ァ-ヾ]+$/u",$first_name_kana) and preg_match($mail_check,$mail) and !empty($password) and preg_match("/^[0-9]{7}+$/",$postal_code) and !empty($prefecture) and preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$address_1) and preg_match("/^[0-9\ \-]+$/u",$address_2) ) { ?>
		
		<form method ="post" action="regist_complete.php">
		<input type="submit" name="signup" value="登録する">
		<!--<input type="submit" name="page_back" value="前に戻る">-->
			
		<input type="hidden" value="<?php echo $_POST['family_name']?>" name="family_name">
		<input type="hidden" value="<?php echo $first_name;?>" name="first_name">
		<input type="hidden" value="<?php echo $family_name_kana;?>" name="family_name_kana">
		<input type="hidden" value="<?php echo $first_name_kana ;?>" name="first_name_kana">
		<input type="hidden" value="<?php echo $mail ;?>" name="mail">
		<input type="hidden" value="<?php echo password_hash($password, PASSWORD_DEFAULT);?>" name="password">
		<input type="hidden" value="<?php echo $gender ;?>" name="gender">
		<input type="hidden" value="<?php echo $postal_code ;?>" name="postal_code">
		<input type="hidden" value="<?php echo $prefecture ;?>" name="prefecture">
		<input type="hidden" value="<?php echo $address_1 ;?>" name="address_1">
		<input type="hidden" value="<?php echo $address_2 ;?>" name="address_2">
		<input type="hidden" value="<?php echo $authority ;?>" name="authority">
		<input type="hidden" value="<?php echo $date ?>" name="registered_time">
		</form>
	
	<?php
	}
	}
	?>
		<form method ="post" action="regist.php">
		<input type="submit" name="page_back" value="前に戻る">
			
		<input type="hidden" value="<?php if(isset($_POST['family_name']))echo $_POST['family_name']?>" name="family_name">
		<input type="hidden" value="<?php echo $first_name;?>" name="first_name">
		<input type="hidden" value="<?php echo $family_name_kana;?>" name="family_name_kana">
		<input type="hidden" value="<?php echo $first_name_kana ;?>" name="first_name_kana">
		<input type="hidden" value="<?php echo $mail ;?>" name="mail">
		<input type="hidden" value="<?php echo password_hash($password, PASSWORD_DEFAULT);?>" name="password">
		<input type="hidden" value="<?php echo $gender ;?>" name="gender">
		<input type="hidden" value="<?php echo $postal_code ;?>" name="postal_code">
		<input type="hidden" value="<?php echo $prefecture ;?>" name="prefecture">
		<input type="hidden" value="<?php echo $address_1 ;?>" name="address_1">
		<input type="hidden" value="<?php echo $address_2 ;?>" name="address_2">
		<input type="hidden" value="<?php echo $authority ;?>" name="authority">
		<input type="hidden" value="<?php echo $date ?>" name="registered_time">
		</form>
	
	
	
	<!--文字の連結の意味echo があって''で囲まれているけれども、''の中に'を打つことでいったん文字列を終わらせる。そして、値を入れ、終わった後に.で連結し、また'を打つことで文字列を再開させる。これらを連結させるという意味の.です。-->
	<!--ifの中、elseの中で同じ処理が二回あるなら、どっちにしても実行するのだからifの外側に置いてしまえば、一行で済む。-->
	<!--
	<button type="button" onclick="history.back()">前に戻る</button>
	-->
	
	<footer>Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>

	
</body>
</html>
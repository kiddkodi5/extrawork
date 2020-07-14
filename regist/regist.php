<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>アカウント登録画面</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
			<li><a href="../index.html">トップ</a></li><li>プロフィール</li><li>D.I.Blogについて</li><li>登録フォーム</li><li><a href ="../list/list.php">アカウント一覧</a></li>
			<li><a href="regist.php">アカウント登録</a></li><li>問い合わせ</li><li>その他</li>
		</ul>
    </header>
	
		<h3>アカウント登録画面</h3>
		<form method="post" action="regist_confirm.php">
	
		
			<p>名前（姓）
			<input type="text" size="30" maxlength="10" name="family_name" value="<?php if(!empty($_POST['family_name'])){echo $_POST['family_name'];} ?>"></p>
			<p>名前（名）
			<input type="text" size="30" maxlength="10" name="first_name" value="<?php if(!empty($_POST['first_name'])){echo $_POST['first_name'];} ?>"></p>
			<p>カナ（姓）
			<input type="text" size="30" maxlength="10" name="family_name_kana" value="<?php if(!empty($_POST['family_name_kana'])){echo $_POST['family_name_kana'];} ?>"></p>
			<p>カナ（名）
			<input type="text" size="30" maxlength="10" name="first_name_kana" value="<?php if(!empty($_POST['first_name_kana'])){echo $_POST['first_name_kana'];} ?>"></p>
			<p>メールアドレス
			<input type="text" size="30" maxlength="100" name="mail" value="<?php if(!empty($_POST['mail'])){echo $_POST['mail'];} ?>"></p>
			<p>パスワード
			<input type="password" size="30" maxlength="10" name="password" ></p>
			<p>性別
			<input type="radio" name="gender" value="0" 
				   <?php if(!empty($_POST['gender']) && $_POST['gender'] === 0 ||empty($_POST['gender'])){echo 'checked';}?>>男
				
			<input type="radio" name="gender" value="1" <?php if(!empty($_POST['gender']) && $_POST['gender'] === 1){echo 'checked';}?>>女
			
			</p>
			<p>
			郵便番号
			<input type="text" size="30" name="postal_code" value="<?php if(!empty($_POST['postal_code'])){echo $_POST['postal_code'];} ?>"></p>
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

						foreach ($prefs as $pref) {
							echo "<option value='".$pref."'>".$pref."</option>";
						}
					?>
					</select></p>
			<p>
			住所（市区町村）
			<input type="text" size="30" name="address_1" value="<?php if(!empty($_POST['address_1'])){echo $_POST['address_1'];} ?>"></p>
			<p>
			住所（番地）
			<input type="text" size="30" name="address_2" value="<?php if(!empty($_POST['address_2'])){echo $_POST['address_2'];} ?>"></p>
			<p>
			アカウント権限
			<select class="dropdown" name="authority">
				<option value="0">一般</option>
				<option value="1">管理者</option>
			</select></p>
			<input type="submit" class="submit" value="確認する"> 
	</form>
	<footer>
    Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>
</body>

</html>
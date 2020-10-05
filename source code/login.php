<?php 
if(isset($_POST['destroy'])){
	session_start();
	$_SESSION = array();
	session_destroy();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>ログイン画面</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<img src="diblog_logo.jpg">
  	<header>  
    <ul>
        <li>トップ</li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
        <li>問い合わせ</li>
        <li>その他</li>
       </ul>
    </header>
	
	
	</body>

<h3>ログイン画面</h3>

<form method=post action="<?php if(isset($_POST['page_code'])){echo "list.php";}else{echo "index.php";}?>">
	
	
	<h4>メールアドレス</h4>
<input type="text" size="30" name="mail" maxlength="100"
	   value="<?php if(!empty($_POST['mail'])){
		echo $_POST['mail'];} ?>">
	<h4>パスワード</h4>
<input type="password" size="30" name="password" maxlength="10">
	
	<p><input type="submit" name="login" value="ログイン"></p>

</form>


	
<?php
require_once("footer.php");
?>



<!--
ログイン機能参考
https://qiita.com/qwertyuiopngsdfg/items/597da67387723a5aedad#%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3%E6%A9%9F%E8%83%BD-->

<!--セッション　解説
http://html2php.starrypages.net/php/session-->
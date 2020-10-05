<?php
session_start();
//アカウントを持っていない人が直接このページにアクセスした場合はログインが必要であることを表示の上、ログインページへ誘導
		if(empty($_SESSION['mail'])){
			if(empty($_POST['mail'])){
				require_once("body_top.php");
				echo '</br>ログインしてください。</br>';
				echo '<form method="post" action="login.php"><input type="submit" value="ログインページへ進む"></form>';
				require_once("footer.php");
				exit();}
		}
		?>
	
	<?php
	//セッションに値が入っていればポストと共有
	if(isset($_SESSION['mail'])){
		$_POST['mail'] = $_SESSION['mail'];
		
	}
//DB接続
try{
	$pdo = new PDO("mysql:dbname=assighment;host=localhost;", "root", "root");
	$stmt = $pdo->prepare('select * from account where mail = ?');
	$stmt->execute([$_POST['mail']]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
	echo "エラー発生したため、ログイン情報が取得できません。";
	echo $e->getMessage();
	die();
}

		/*確認用
		echo "アカウント権限：".$row['authority']."</br>";
	*/
	//入力メールアドレスが DB内にない場合　ログインページに戻る
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
	/*	}*/
		?>

<DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>D.I.Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
<!--
a:link  { color : white; text-decoration: none; }
a:visited  { color : white; text-decoration: none; }
-->
</style>
	<!--リンクの青文字を解除、アンダーラインをなくした-->
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.abc').bxSlider({
		  mode: `horizontal`,
		  auto: true,
		  boxModel: `fade`,
		  speed: 2000,
		  slideWidth: 1000,
	  });
    });
  </script>

    </head>
<body>
    
	<img src="diblog_logo.jpg">
    <header>  
    <ul>
		<li><a href="index.php">トップ</a></li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li>登録フォーム</li>
		<?php if($row['authority'] ==1){ echo '<li><a href="list.php">アカウント一覧</a></li>';} ?>
		<?php if($row['authority'] ==1){ echo '<li><a href="regist.php">アカウント登録</a></li>';} ?>
        <li>問い合わせ</li>
        <li>その他</li>
		<li><form method="post" action="login.php">
			<input type="submit" name="destroy" value="<?php
			echo 'ログアウト'; ?>"></form></li>
        </ul>
    </header>
    
    <main>
    <div class="main-container">
        <div class="left">
        <h1>プログラミングに役立つ書籍</h1>
			<div class="abc">
    <div><img src="jQuery_image1.jpg"></div>
    <div><img src="jQuery_image2.jpg"></div>
	 <div><img src="jQuery_image3.jpg"></div>
	 <div><img src="jQuery_image4.jpg"></div>
	 <div><img src="jQuery_image5.jpg"></div>
  </div>
			
            <p>2017年1月15日</p>
            <img src="bookstore.jpg">
            <p>D.I.BlogはD.I.Worksが提供する演習課題です。</p>
            <p>
            記事中身</p>
            
            <div class="gray-box">
            <div class="box">
                <img src="pic1.jpg">
                <p>ドメイン取得方法</p>
                </div>
           <div class="box">
                <img src="pic2.jpg">
                <p>快適な職場環境</p>
                </div>
             <div class="box">   
            <img src="pic3.jpg">
                <p>Linuxの基礎</p>
                </div>
                <div class="box">
            <img src="pic4.jpg">
                <p>マーケティング入門</p>
                </div>
                <div class="box">
            <img src="pic5.jpg">
                <p>アクティブラーニング</p>
                </div>
                <div class="box">
            <img src="pic6.jpg">
                <p>CSSの効率的な勉強方法</p>
                </div>
                <div class="box">
            <img src="pic7.jpg">
                <p>リーダブルコードとは</p>
                </div>
                <div class="box">
            <img src="pic8.jpg">
           <p>HTML5の可能性</p>
                 </div>
        </div>
        </div>
        
        <div class="right">
          
            
                <h2>人気の記事</h2>
            <div class="ichi">
            PHPオススメ本<br>
            PHP MyAdminの使い方
            <br>
            今人気のエディタTops
            <br>
            HTMLの基礎
            </div>
            
            
            <h2>オススメリンク</h2>
            <div class="ichi">
            DIワークス株式会社
                <br>
            XAMPPのダウンロード<br>
            Eclipseのダウンロード<br>
            Blacketsのダウンロード
            </div>
            
            
            <h2>カテゴリ</h2>
            <div class="ichi">
            HTML<br>
            PHP<br>
            My SQL<br>
        </div>
        </div>
    
            </body>
        <footer>
    Copyright D.I.works| D.I.Blog is the one which provides A to Z about programming.</footer>
</html>
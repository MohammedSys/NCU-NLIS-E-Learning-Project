<?php session_start(); ?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php 
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU IM Group 16">
		<meta name="Description" content="This is a learning system to help the members of New Life Co. learn how to write webpages.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>E-learning System</title>
		
		<!--icon-->
		<link href="assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		
		<!--Bootstrap-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="assets/css/font-awesome.css">
		
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="assets/css/hippo.css">
		<link rel="stylesheet" href="assets/css/sidebar.css" >
		<link rel="stylesheet" href="assets/css/main-menu.css" >
		<link rel="stylesheet" href="assets/css/manual.css">
		<link rel="stylesheet" href="assets/css/b-to-top.css">
		<style>
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
		<script src="assets/js/b-to-top.js"></script>
	</head>
	
	<body class="full">
		<a href="#" class="back-to-top"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a>
		
		<?php include 'objects/siderbar.php'; ?>
		<!-- Page Header -->
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div id="logo_printer">
							<table class="a-hover txt-white" border="0" cellspacing="0" cellpadding="0">
								<tr id="left-menu-toggle">
									<a href="#left-menu"></a>
									<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
									<td width="40px"><div class="systemname"><span class="glyphicon glyphicon-menu-hamburger"></span></div></td>
								</tr>
							</table>
						</div>
					</div>
						
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php include 'objects/insystem-nav.php'; ?>
						<?php include 'objects/insystem-nav-link.php'; ?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Page Content -->
		<div class="center-div">
			<h2>歡迎使用新生命資訊服務公司</h2>
			<h2>網頁技術學習平台</h2>
			<hr />
			<h3>以下將為您介紹本系統的功能與使用方式</h3>
			<br />
			<p>首先，進入本系統主頁之後，中間有一個播放窗（圖中紅框部分），這邊會顯示新課程的資訊、未來即將新增的課程等訊息。</p>
			<img src="assets/img/manual/intro02.png"></img>
			<p>在畫面的右上角，會看到自己的帳戶圖案，點按它會出現使用者功能選單。</p>
			<img src="assets/img/manual/intro03.png"></img>
			<p>在畫面的左上角，會有本系統的 Logo ，圖樣為：</p>
			<img class="img-menu-btn" src="assets/img/manual/intro04-1.png"></img>
			<p>點按它會開啟課程列表選單，如圖所示：</p>
			<img src="assets/img/manual/intro04-2.png"></img>
			<p>課程列表最上方有三個連結，分別是：「歷史紀錄」、「測驗習題」及「操作說明」。<br /><pink>歷史紀錄</pink>回連接到個人紀錄頁面，其中包含個人書籤的紀錄、考試紀錄等等。<br /><pink>測驗習題</pink>則是可以讓您依據主題、章節作一些基礎的考題，以檢視學習成效。<br /><pink>操作說明</pink>就是本文件的連結，系統使用上如有任何問題，煩請多加利用，謝謝您！</p>
			<img class="img-detail" src="assets/img/manual/intro04-3.png"></img>
			<p>選單的下方則是課程列表，只要有新的課程，都會依據主題、章節排放在這裡。<br />點選任一章節的名稱會連結至該章節的學習頁面。</p>
			<img class="img-detail" src="assets/img/manual/intro04-4.png"></img>
			<p>再來是課程學習頁面。當在課程列表點選任一課程之後，便會連結到這裡。<br />課程學習頁面如下圖所示，包含一個位於上方的教材播放窗，以及下方的線上即時編輯器。</p>
			<img src="assets/img/manual/intro05-1.png"></img>
			<p>教材播放窗可切換上下頁、調整大小以及搜尋：</p>
			<img src="assets/img/manual/intro05-2.png"></img>
			<p>而當使用者在學習的過程中想要紀錄一些筆記或心得，在頁面最上方的 Menu 中有一個「筆記」的按鈕，點按可以叫出筆記框。</p>
			<img src="assets/img/manual/intro05-3.png"></img>
			<p>教材學習頁的下方有一個線上編輯器，其中包含兩個輸入框。<br />左邊的輸入框請單純輸入 HTML 程式碼即可，而右邊的請輸入 CSS 程式碼。<br />編輯的結果會及時在下方的白色區域顯示。</p>
			<img src="assets/img/manual/intro05-4.png"></img>
			<h3>以上本系統的簡略使用說明<br />感謝您的使用！</h3>
		</div>
		
		<!-- Footer -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<ul class="list-inline text-center">
							<li><a class="transparent-btn" href="http://vivialife.com/TW/" target="_blank">好日子購物網</a>
							</li>
							<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓新樂園</a>
							</li>
							<li><a class="transparent-btn" href="http://www.sci.org.tw/" target="_blank">脊髓損傷潛能發展中心</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row row-margin">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<ul class="list-inline text-center">
							<li><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/nlishsinchu?hc_location=stream" target="_blank">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
						</ul>
						<p class="copyright">Copyright &copy; ISQ Lab. NCU 2015</p>
					</div>
				</div>
			</div>
    	</footer>
	</body>
</html>
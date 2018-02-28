<?php session_start(); ?>
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
		<link rel="stylesheet" href="assets/css/sidebar.css">
		<link rel="stylesheet" href="assets/css/main-menu.css">
		<link rel="stylesheet" href="assets/css/exam-history.css">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
	</head>
	
	<body id="B" class="full">
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
						<?php include 'objects/insystem-nav.html'; ?>
						<?php include 'objects/insystem-nav-link.php'; ?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<!-- Main Content -->
			<div id="content" class="margin-t-60">
				<div class="container-fluid">
					<div class="row">		
						<?php
							//由考題書籤連結至此頁
							if ( isset($_POST['examNumber']) && $_POST['examNumber'] != null) {
								$postID = $_POST['examNumber'];
								//撈出作答考題資料
								$sql = "SELECT subject,type,chapter,number,studentAns FROM testMark WHERE testMarkID = '$postID'";
								$result = mysql_query($sql);
								$row = mysql_fetch_row($result);
								if($row[1] == "chapter")
									$type_view = "章節練習題";
								else
									$type_view = "綜合練習題";
								//撈出題庫考題敘述選項
								$sql = "SELECT number,context,A1,A2,A3,A4,answer,point FROM questionBase WHERE subject = '$row[0]' AND type = '$row[1]' AND chapter = '$row[2]' AND number = '$row[3]' ";
								$result = mysql_query($sql);							
								//印出主題資訊
								echo "<div class=\"well info-div\">
										<h2 class=\"text-danger\">練習題瀏覽</h2>
										<p>答題正確標記選項為<green>綠色</green><br/ >答題錯誤標記選項為<red>紅色</red>，並且標記正確選項為<blue>藍色</blue><br/ >未作答的題目僅會標記出<blue>藍色</blue>為正確答案。</p>
										<div class=\"quiz-title\">".$row[0]."</div>
										<div class=\"quiz-title\">".$type_view."</div>
										<div class=\"quiz-title\">Ch. ".$row[2]."</div>
									  </div>";
								//印出考題
								while ($examArray = mysql_fetch_row($result)) {									
									echo "<div class=\"well\">
											<h3>第 ".$examArray[0]." 題（".$examArray[7]." 分）</h3>
											<p>".$examArray[1]."</p>
											<ul class=\"list-group\">";	
											//row[4]為學員答案，examArray[6]為正確答案									  
											for ($i=1; $i <= 4 ; $i++) { 
												if ( $i == $row[4] && $i == $examArray[6] ) {
													echo "<li class=\"list-group-item  list-group-item-success\">".$i.". ".$examArray[$i+1]."</li>";
												}else if ( $i == $row[4] && $i != $examArray[6]) {
													echo "<li class=\"list-group-item  list-group-item-danger\">".$i.". ".$examArray[$i+1]."</li>";
												}else if ( $i != $row[4] && $i == $examArray[6] ) {
													echo "<li class=\"list-group-item  list-group-item-info\">".$i.". ".$examArray[$i+1]."</li>";
												}else {
													echo "<li class=\"list-group-item\">".$i.". ".$examArray[$i+1]."</li>";
												}
											}
											echo "</ul>
										  </div>";
								}
							}
							//由考試紀錄連結到此頁
							else if ( isset($_POST['examID']) && $_POST['examID'] != null) {
								$postID = $_POST['examID'];
								//撈出考試紀錄
								$sql = "SELECT subject,type,chapter,recordAns FROM testGrade WHERE testGradeID = '$postID'";
								$result = mysql_query($sql);
								$row = mysql_fetch_row($result);
								if($row[1] == "chapter")
									$type_view = "章節練習題";
								else
									$type_view = "綜合練習題";
								//把考試答案分割成陣列，一個索引代表一題的答案
								$ansArray = str_split($row[3],1);
								$count = 0; //分割答案陣列索引計數器
								
								//撈出考題選項敘述
								$sql = "SELECT number,context,A1,A2,A3,A4,answer,point FROM questionBase WHERE subject = '$row[0]' AND type = '$row[1]' AND chapter = '$row[2]' ORDER BY CAST(chapter AS UNSIGNED)";
								$result = mysql_query($sql);
								//印出主題資訊
								echo "<div class=\"well info-div\">
										<h2 class=\"text-danger\">練習題瀏覽</h2>
										<p>答題正確標記選項為<green>綠色</green><br/ >答題錯誤標記選項為<red>紅色</red>，並且標記正確選項為<blue>藍色</blue><br/ >未作答的題目僅會標記出<blue>藍色</blue>為正確答案。</p>
										<div class=\"quiz-title\">".$row[0]."</div>
										<div class=\"quiz-title\">".$type_view."</div>
										<div class=\"quiz-title\">Ch. ".$row[2]."</div>
									  </div>";
								//印出考題
								while ($examArray = mysql_fetch_row($result)) {
									echo "<div class=\"well\">
											<h3>第 ".$examArray[0]." 題（".$examArray[7]." 分）</h3>
											<p>".$examArray[1]."</p>
											<ul class=\"list-group\">";	
											//$ans[count]為學員答案，examArray[6]為正確答案									  
											for ($i=1; $i <= 4 ; $i++) { 
												if ( $i == $ansArray[$count] && $i == $examArray[6] ) {
													echo "<li class=\"list-group-item  list-group-item-success\">".$i.". ".$examArray[$i+1]."</li>";
												}else if ( $i == $ansArray[$count] && $i != $examArray[6]) {
													echo "<li class=\"list-group-item  list-group-item-danger\">".$i.". ".$examArray[$i+1]."</li>";
												}else if ( $i != $ansArray[$count] && $i == $examArray[6] ) {
													echo "<li class=\"list-group-item  list-group-item-info\">".$i.". ".$examArray[$i+1]."</li>";
												}else {
													echo "<li class=\"list-group-item\">".$i.". ".$examArray[$i+1]."</li>";
												}
											}
											echo "</ul>						
										  </div>";
									$count++; //分割答案陣列索引計數器+1
								}	
								
							}
						?>
	
						<div class="well well-sm">
							<button class="btn btn-primary" onclick="javascript:location.href='history.php'">回到歷史紀錄頁</button>
						</div>
					</div>
				</div>	
			</div><!--end of Main Content-->
		</div>
	</body>
</html>
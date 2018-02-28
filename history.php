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
		<link rel="stylesheet" href="assets/css/history.css">
		<link rel="stylesheet" href="assets/css/b-to-top.css">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<script type="text/javascript" src="assets/js/history.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
		<script src="assets/js/b-to-top.js"></script>
	</head>
	
	<body id="B" class="full">
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
		<div id="page-content-wrapper">
			<?php
				$name = $_SESSION['account'];
				//取得課程書籤資料
				$bookmarkSql = "SELECT bookMarkID,subject,chapter,page,type,descript FROM bookMark WHERE name = '$name' ORDER BY type,subject,CAST(chapter AS UNSIGNED),CAST(page AS UNSIGNED)";
				$bookmarkconn = mysql_query($bookmarkSql);
				//取得考題書籤資料
				$examMarkSql = "SELECT testMarkId,subject,type,chapter,number,noteType,descript FROM testMark WHERE name = '$name' ORDER BY noteType,subject,type,CAST(chapter AS UNSIGNED),number";
				$examMarkconn = mysql_query($examMarkSql);				
			?>
			<!-- Main Content -->
			<div id="content" class="margin-t-60">
				<div class="container-fluid">			
					<h2 class="text-danger">個人歷史紀錄</h2>
					<div class="row well">				
						<div class="col-md-12">
							<form id="classMarkForm" class="form-horizontal" action="classroom.php" method="post" >
								<div class="form-group">
								    <label for="classMark" class="col-sm-2 control-label">課程書籤</label>
								    <div class="col-sm-10">
								      <select id="classMark" class="form-control" form="classMarkForm" name="classNumber">
								      <?php
								      	while ($classArray = mysql_fetch_row($bookmarkconn)) {
											echo "<option value=\"".$classArray[0]."\">【".$classArray[4]."】".$classArray[1]."：Ch. ".$classArray[2]." ( p. ".$classArray[3]." ) ｜ 敘述： ".$classArray[5]."</option>";  
										}	
								      ?>
								      </select>
								      <div class="well well-sm">
								      	<button class="btn btn-primary" type="button" onclick="checkSubmit('classroom.php','classMarkForm')">前往課程</button>
								        <button class="btn btn-danger" type="button" onclick="checkSubmit('php/classMark-delete.php','classMarkForm')">刪除標籤</button>
								      </div>							      
								    </div>
							    </div>
							</form>
						</div><!--end of classMark div-->
						<div class="col-md-12">
							<form id="examMarkForm" class="form-horizontal" action="" method="post">
								<div class="form-group">
								    <label for="examMark" class="col-sm-2 control-label">考試書籤</label>
								    <div class="col-sm-10">
								      <select id="examMark" class="form-control" form="examMarkForm" name="examNumber" >
								      <?php
								      	while ($examMarkArray = mysql_fetch_row($examMarkconn)) {
								      		//轉換類型的值，轉成中文	
								      		if ($examMarkArray[2] == "mix") {
											    $examMarkArray[2] = "綜合習題";
											}else if ($examMarkArray[2] == "chapter") {
												$examMarkArray[2] = "章節習題";
											}
											echo "<option value=\"".$examMarkArray[0]."\" >【".$examMarkArray[5]."】".$examMarkArray[1]." ".$examMarkArray[2]."：Ch. ".$examMarkArray[3]." 第 ".$examMarkArray[4]." 題。  ｜ 敘述： ".$examMarkArray[6]."</option>";	  
										}
								      ?>
								      </select>	
								      <div class="well well-sm">						      
									      <button class="btn btn-primary" type="button" onclick="checkSubmit('exam-history.php','examMarkForm')" >檢視考題</button>								      
									      <button class="btn btn-danger" type="button" onclick="checkSubmit('php/examMark-delete.php','examMarkForm')">刪除標籤</button>
								   	  </div>
								    </div>
							    </div>
							</form>
						</div><!--end of examMark div-->
					</div>
					<div id="examList" class="row well">
						<div id="exam-header">
							<h2 class="text-primary">歷次考試成績</h2>
							<p>選擇排序方式</p>
							<form target="history-iframe" action="history-iframe.php"  method="post">
								<button class="btn btn-primary" type="submit">主題</button>
								<input name="orderSql" type="hidden" value="ORDER BY subject,type,CAST(chapter AS UNSIGNED)" />
							</form>
							<form target="history-iframe" action="history-iframe.php" method="post">
								<button class="btn btn-primary" type="submit">類型</button>
								<input name="orderSql" type="hidden" value="ORDER BY type,subject,CAST(chapter AS UNSIGNED)" />
							</form>
							<form target="history-iframe" action="history-iframe.php" method="post">
								<button class="btn btn-primary" type="submit">分數</button>
								<input name="orderSql" type="hidden" value="ORDER BY score,subject,type,CAST(chapter AS UNSIGNED)" />
							</form>
							<form target="history-iframe" action="history-iframe.php" method="post">
								<button class="btn btn-primary" type="submit">作答日期</button>
								<input name="orderSql" type="hidden" value="ORDER BY ansDate,subject,type,CAST(chapter AS UNSIGNED)" />
							</form>
						</div>					
						<div id="iframeDiv" class="embed-responsive embed-responsive-16by9">
						  <iframe name="history-iframe" class="embed-responsive-item" src="history-iframe.php"></iframe>
						</div>
						<!-- 子物件控制的檢視考卷表單 -->
						<form id="fatherForm" action="exam-history.php" method="post">
							<input id="fatherInput" name="examID" type="hidden" value="" />
						</form>
					</div><!--end of exam list div-->
				</div><!--end of container-fluid-->
			</div><!--end of Main Content-->
			
			<!-- Footer -->
			<!--<footer>
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
			</footer>-->
		</div>
	</body>
</html>
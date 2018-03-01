<?php
    include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'objects/head.php'; ?>
<script>
	$(document).ready(function() {
		$('.carousel').carousel({
			interval: 5000
		})
	});
</script>
</head>
<body class="full">
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
							<tr onclick="openlink('./index.php')">
								<td><img alt="Brand" class="brand-icon" src="assets/img/newlife_circle.png"></td>
								<td width="150px"><div class="systemname">E-learning System<br/>新生命資訊服務 Co.</div></td>
							</tr>
						</table>
					</div>
				</div>
					
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php include 'objects/outsystem-nav-link.php'; ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="sign-up.php">帳號註冊&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
						<li><a href="forgetPassword.php">忘記密碼&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<!-- Main Content -->
	<div id="content">
		<!--<div class="container-fluid">-->
		<!--<div class="row-fluid">-->
		<!--<div class="span12">-->
		<div class="slideshow">		
			<div class="carousel slide" id="myCarousel">
				<div class="carousel-inner">
		
					<div class="item active">
					
						<div class="bannerImage">
							<a href="#"><img src="assets/img/slide01.png" alt=""></a>
						</div>
						
						<!--<div class="caption row-fluid">
							<div class="span4"><h3>歡迎使用！<br /><br />新生命公司網頁技術學習平台</h3></div>                	
							<div class="span8"><p>本公司員工多數來自於意外受傷後轉介至公司就職,雖然可能具備資訊的智識背景,但沒有很完整的教材可提供傷友學習,因此期望開發學習平台以利人才銜接。透過互動式學習、課程管理、學習紀錄與習題測驗可以有效的追蹤學習成果,達成 anytime、 anywhere、anyone 的友善學習環境。</p></div>
						</div>-->
					</div><!-- /Slide1 -->
		
					<div class="item">
					
						<div align="center" class="bannerImage">
							<a href="#"><img src="assets/img/slide02.png" alt=""></a>
						</div>
						
									
						<!--<div class="caption row-fluid">
							<div class="span4"><h3>新生命 ＆ 中央大學</h3>
								<a class="btn btn-mini" href="#">&raquo; Read More</a>
							</div>                	
							<div class="span8"><p><br />新生命資訊服務公司旨在協助脊髓損傷或其他身心障礙朋友工作就業，以資訊服務為營業範疇，提供網站規劃建置、程式設計、平面設計、專業文件列印、線上客服以及企業進用身心障礙者方案等服務</p></div>
						</div>-->
																
					</div><!-- /Slide2 -->
				</div>
				
				<div class="control-box">                            
					<a data-slide="prev" href="#myCarousel" class="carousel-control left"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
					<a data-slide="next" href="#myCarousel" class="carousel-control right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
				</div><!-- /.control-box -->   
									
			</div><!-- /#myCarousel -->
		</div>	

		
		<form id="form" class="form-signin" name="form" action="php/accountConfirm.php" method="post">
			<h2 class="form-signin-heading">登入</h2>
			<label for="inputAcc" class="sr-only">帳號</label>
			<!--if needed, add-on: required autofocus-->
			<input type="account" name="account" id="inputAcc" class="form-control" placeholder="帳號">
			<p class="signError" id="accountErr"></p>
			<label for="inputPassword" class="sr-only">密碼</label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密碼" required>
			<p class="signError" id="pwdErr"></p>
			<!--<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me">&nbsp;記住我
				</label>
			</div>-->
			<button class="btn btn-lg btn-primary btn-block" type="button" onclick="accountCheck()">登入</button>
		</form>
		<div>
			<?php 
				$sql = "SELECT postID, title, type, context, date_format(DATE,'%x.%c.%d'), date_format(DATE,'%H : %i') FROM bulletin";
				$result = mysql_query($sql);
				echo "<div class=\"notice-board\">";
				echo "<h3>系統公告</h3>";
				echo "<hr />";
				while ($annData = mysql_fetch_row($result)) {
					echo "<div class=\"inner-notice-board\">";
					// echo "<div class=\"notice_ID\">".$annData[0]."</div>";
					echo "<div class=\"notice_date\">".$annData[4]."</div>";
					echo "<div class=\"notice_time\">".$annData[5]."</div>";
					echo "<div class=\"notice_title\">".$annData[1]."</div>";
					// echo "<div class=\"notice_type\">".$annData[2]."</div>";
					echo "<div class=\"notice_context\">".$annData[3]."</div>";
					echo "</div>";
				}
				echo "</div>";
			?>
		</div>
	</div>
	
	<!-- Footer -->
	<?php include 'objects/footer.php'; ?>
</body>
</html>
<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include("php/connection.php");	
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	$getSubject = $_POST['getSubject'];
	$chapterPOST = $_POST['send'];
	$type = $_POST['type'];
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
		<link rel="stylesheet" href="assets/css/exam.css">
		<style>
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<!-- Menu Toggle Script -->
		<script type="text/javascript" src="assets/js/menu-toggled.js"></script>
		<!--<script>
			$(window).scroll(function()
			{
				if ($(window).scrollTop() >= 150)
				{
					$('#clock').addClass('fixed-clock');
				}
				else
				{
					$('#clock').removeClass('fixed-clock');
				}
			});
		</script>-->
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
						<ul class="nav navbar-nav">
							<?php include 'objects/home-btn.php'; ?>
						</ul>
						<?php include 'objects/insystem-nav-link.php'; ?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</header>
		
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<!-- Main Content -->
			<div id="content">
				<!--<div id="clock">
					<p id="timeCounter"></p>
				</div>-->
				<!--<div id="quizHead" class="margin-t-60 margin-b-10">
					<h2>線上考試作答區</h2>
					<div class="q-theme"></div>
					<div class="quiz-info">
						<p><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;作答主題：<?php echo $getSubject; ?><br /><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;作答章節：<?php echo $chapterPOST; ?></p>
						<p><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;作答時間：15&nbsp;分鐘<br /><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>&nbsp;滿分：100</p>
					</div>
					<div id="clock">
						<p id="timeCounter"></p>
					</div>
				</div>-->
				<div id="quizHead" class="margin-t-80">
					<div class="trapezoid">
						<div class="q-title"><?php echo $getSubject; ?> &mdash; Ch. <?php echo $chapterPOST; ?></div>
						<!--<div class="q-ch"></div>-->
					</div>
				</div>
				<div id="clock" class="fixed-clock">
					<p id="timeCounter"></p>
				</div>
				<div id="outerDiv">
				<?php 								
					echo "<form id=\"quiz\" class=\"quizForm\" onsubmit=\"return callSubmit()\" action=\"exam-result.php?getSubject=".$getSubject."&chapterPOST=".$chapterPOST."&type=".$type."\" method=\"post\">";			
					//以selectExam傳來的資料，從資料庫抓取考題
					$sql = "SELECT number, context, A1, A2, A3, A4, point FROM questionBase WHERE subject = '$getSubject' AND type = '$type' AND chapter = '$chapterPOST' ORDER BY number";
				    
					$result = mysql_query($sql);
					while ( $row = mysql_fetch_row($result) ) {
						echo "<div class=\"innerDiv\"><p class=\"quizSubject\">第 ".$row[0]." 題（".$row[6]." 分）</p>";
						echo "<p class=\"quizSubject\">".$row[1]."</p>";
						echo "<ul class=\"list-group\">";
						for ($i=1; $i <= 4 ; $i++) { 
							echo "<li class=\"list-group-item\"><label><input type=\"radio\" name=\"no".$row[0]."\" value=\"$i\" required/>&nbsp;".$row[$i+1]."</label></li>";
						}
						echo "</ul></div>";
					}
					echo "<input id=\"timeField\" type=\"hidden\" name=\"examTime\" value=\"\" />";
					echo "<div id=\"submitDiv\"><input class=\"transparent-input\" type=\"submit\" value=\"提交答案\" /></div></form>";
				?>				
				</div>
			</div>
			
			<!-- Footer -->
			<footer>
				<div class="container">
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
		</div>
		<script src="assets/js/classie.js"></script>
		<script type="text/javascript">			
			//script須放置在body的下方，確保網頁已經載入body element
			var examTime = 900, //考試時間為15分鐘=900秒
				min,//考試剩餘時鐘分針
				sec,//考試剩餘時鐘秒針
				clockTime,//顯示剩餘時間(分針加秒針)
				timeSpend = 0;//紀錄考試花費時間	
			//倒數時鐘內的時間文字變數，<p>element
			var showTime = document.getElementById("timeCounter");
			//儲存作答時間的<input>element
			var timeField = document.getElementById("timeField");																	
			//倒數計時器，每秒呼叫一次
			var counter = setInterval(function(){
				//取得總時間除以六十的商數跟餘數，當作剩餘分鐘跟秒鐘
				min = Math.floor(examTime / 60);
				sec = examTime % 60;
				clockTime  = "考試時間剩下：" + min + " 分 " + sec + " 秒";
				showTime.innerHTML = clockTime;
				examTime--;
				timeSpend++;
				//如果時間到0，則停止倒數
				if( examTime == 0 ) {
					clearInterval(counter);
					timeField.value = timeSpend;
					timeOutSubmit();
				}
			},1000);
			
			//倒數為零時，使儲存考試資料的表單執行submit動作
			function timeOutSubmit() {
				timeField.value = timeSpend;
				 $("#quiz").submit();
			}					
			
			//儲存考試資料的表單submit前執行的動作，會停止倒數計時並且儲存作答時間至<input>的value attribute
			//使用者點擊submit按鈕時會啟動；時間到數為零也會由timeOutSubmit所呼叫
			function callSubmit() {
				clearInterval(counter);
				timeField.value = timeSpend;
				return true;
			}			
		</script>
	</body>
</html>
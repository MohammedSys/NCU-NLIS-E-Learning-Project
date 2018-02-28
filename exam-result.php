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
		<link rel="stylesheet" href="assets/css/sidebar.css" >
		<link rel="stylesheet" href="assets/css/main-menu.css" >
		<link rel="stylesheet" href="assets/css/exam.css">
		<link rel="stylesheet" href="assets/css/exam-result.css">
		<link rel="stylesheet" href="assets/css/dialog.css">
		<style>
		</style>
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		<script type="text/javascript" src="assets/js/Chart.js/Chart.js"></script>
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<script type="text/javascript" src="assets/js/exam-result-submit.js"></script>
		
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
			<div id="content" class="margin-t-60">
				<div id="outerDiv">
					<?php
						$type = $_GET['type'];//網址傳來的考試型別
						if($type == "chapter")
							$type_view = "章節練習題";
						else
							$type_view = "綜合練習題";
						$getSubject = $_GET['getSubject']; //網址傳來的考試主題
						$chapterPOST = $_GET['chapterPOST'];//網址傳來的考試章節
						$examTime = $_POST['examTime']; //學員總作答時間
						$examTime =floor($examTime/60)." 分 ".($examTime%60)." 秒";
						$totalPoint = 0; //計算總分的變數
						$correctAns = 0; //計算答對的題數
						$wrongAns = 0; //計算答錯的題數
						$totalQuest = 0; //計算題目總數
						$noans = 0; //未達題燈號
						$ansArray = array(); //紀錄學員每題作答答案
						//從dataBase取出題號、題目敘述、A1~A4四個選項、正確解答、題目配分
						$sql = "SELECT number, context, A1, A2, A3, A4, answer, point FROM questionBase WHERE subject = '$getSubject' AND type = '$type' AND chapter = '$chapterPOST' ORDER BY number";
						$result = mysql_query($sql);
						
						echo "<div class=\"well\">
								<h3 class=\"text-danger\">作答結果</h3>
								<p>答題正確標記選項為<green>綠色</green><br />答題錯誤標記選項為<red>紅色</red>，並且標記正確選項為<blue>藍色</blue><br />未作答的題目僅會標記出<blue>藍色</blue>為正確答案</p>
								<div class=\"quiz-title\">".$getSubject."</div>
								<div class=\"quiz-title\">".$type_view."</div>
								<div class=\"quiz-title\"> Ch. ".$chapterPOST."</div>
							</div>";
						
						while ( $row = mysql_fetch_row($result) ) {
							$stuAns = "no".$row[0];
							//紀錄學員每題作答答案至陣列ansArray，從index 0開始記錄	
							$ansArray[$totalQuest] = $_POST[$stuAns];
							$totalQuest +=1; //計算總題數	
							//計算每題得分，如果作答答案與正確答案相符，該題分數加總至總分，答錯未達則將相對計數器+1	
							if ( $_POST[$stuAns] == $row[6] ) {
								$totalPoint += $row[7];
								$correctAns += 1;
							} else if ( $_POST[$stuAns] != $row[6] && $_POST[$stuAns] != null) {
								$wrongAns += 1;
							}
								
							//印出題號、配分、題目敘述、標記題目按鈕
							echo "<div class=\"innerDiv\"><p class=\"quizSubject\">第 ".$row[0]." 題（".$row[7]."分）</p>";
							echo "<p class=\"quizSubject\">".$row[1]."</p>";
							echo "<button data-toggle=\"modal\" data-target=\"#examInfo".$row[0]."\" class=\"btn transparent-btn btn-mark\" type=\"button\"/>標記本題</button></hr>";
							echo "<!-- Modal -->
								<div id=\"examInfo".$row[0]."\" class=\"modal fade\" role=\"dialog\">
								  <div class=\"modal-dialog\">	
								    <!-- Modal content-->
								    <div class=\"modal-content\">
								      <div class=\"modal-header\">
								        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
								        <h3 class=\"modal-title\">紀錄考題書籤</h4>
								      </div>
								      <div class=\"modal-body\">
								        <p>請選擇書籤分類與輸入書籤敘述</p>
								        <p>主題：".$getSubject."<br />考題類型：".$type_view."<br />現在章節：Ch. ".$chapterPOST."<br />記錄題目：第 ".$row[0]." 題</p>
								        <form id=\"examForm".$row[0]."\" class=\"examMarkForm\" target=\"_blank\" method=\"post\" action=\"php/addExamMark.php?getSubject=".$getSubject."&chapterPOST=".$chapterPOST."&type=".$type."\" >
							        	    <div class=\"form-group\">
										      <label for=\"classify\">選擇分類</label>
										      <div class=\"margin-t-5 margin-b-5\">
										      	 <button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"markType(this,'classify".$row[0]."')\">不熟</button>
									     	 	 <button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"markType(this,'classify".$row[0]."')\">重點</button>
										     	 <button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"markType(this,'classify".$row[0]."')\">常錯</button>
										      </div>	      
										      <input type=\"text\" class=\"form-control\" id=\"classify".$row[0]."\" name=\"classify\" placeholder=\"自行輸入分類\">
										    </div>
										    <div class=\"form-group\">
										      <label for=\"markDescript\">書籤敘述</label>
										      <textarea maxlength=\"64\" class=\"form-control\" id=\"markDescript\" name=\"markDescript\" placeholder=\"輸入上限為 64 字\" rows=\"3\" required ></textarea>
										    </div>
										    <!--紀錄考試書籤資訊-->
										    <input type=\"hidden\" name=\"ans\" value=\"".$_POST[$stuAns]."\" />
										    <input type=\"hidden\" name=\"questionNum\" value=\"".$row[0]."\" />
										    
								        
								      </div>
								      <div class=\"modal-footer\">
								      	<button type=\"submit\" form=\"examForm".$row[0]."\" class=\"btn btn-success\" onclick=\"markSubmit(".$row[0].")\">紀錄書籤</button>
								        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消紀錄</button>
								      </div>
								      </form>
								    </div>
								  </div>
								</div>";
							$noans = 0;
							echo "<ul class=\"list-group\">";
							//迴圈列印4個題目選項	
							// for ($i=1; $i <= 4; $i++) {										 
							// 	echo "<li class=\"list-group-item\">".$row[$i+1]."</li>";
							// 	//標記學員作答答案
							// 	if ( $_POST[$stuAns] == $i )
							// 	{
							// 		$a='<p class="your-ans">您的答案為 選項 ';
							// 		$b='。</p>';
							// 		echo $a, $i, $b;
							// 		// echo '<p class="your-ans">&#8593 您選的答案為此項。</p>';
							// 		$noans = 1;
							// 	}
								
							// 	//標記正確答案
							// 	if ($row[6] == $i) {
							// 		$a='<p class="correct-ans">正確答案為 選項 ';
							// 		$b=' 。</p>';
							// 		echo $a, $i, $b;
							// 		// echo "<p class=\"correct-ans\">正確答案。</p>";
							// 	}
								
							// 	if( $i == 4 && $noans == 0 )
							// 	{
							// 		echo '<p class="your-ans">本題您沒有作答。</p>';
							// 	}
							// }
																  
							for ($i=1; $i <= 4 ; $i++) { 
								if ( $i == $_POST[$stuAns] && $i == $row[6] ) {
									echo "<li class=\"list-group-item  list-group-item-success\">".$i.". ".$row[$i+1]."</li>";
								}else if ( $i == $_POST[$stuAns] && $i != $row[6] ) {
									echo "<li class=\"list-group-item  list-group-item-danger\">".$i.". ".$row[$i+1]."</li>";
								}else if ( $i != $_POST[$stuAns] && $i == $row[6] ) {
									echo "<li class=\"list-group-item  list-group-item-info\">".$i.". ".$row[$i+1]."</li>";
								}else {
									echo "<li class=\"list-group-item\">".$i.". ".$row[$i+1]."</li>";
								}
							}
							// echo "<ul class=\"optionUL\">";
							echo "</ul></div>";
						}//end of while
						
						//從陣列ansArray中取出所有學員作答答案
						$ans;
						foreach ($ansArray as $value) {
							$ans = $ans.(string)$value;
						}
					?>
					<div id="submitDiv" class="margin-t-20">
						<div class="quiz-info">
							
						</div>
						<div class="quiz-result">&nbsp;作答時間：<?php echo $examTime; ?></div>
						<div class="quiz-result">&nbsp;得分：<?php echo $totalPoint; ?> / 100 分</div>
						<?php
							$left = $totalQuest - $wrongAns - $correctAns;
							echo "<div class=\"chart-box\">
								<canvas id=\"chart-area\" class=\"chart-zone\"></canvas>
								<div class=\"chart-legend\">
									<table>
										<tr><td><div class=\"color-box hl-green\"></div></td><td><div class=\"chart-legend-txt\">正確題數</div></td></tr>
										<tr><td><div class=\"color-box hl-red\"></div></td><td><div class=\"chart-legend-txt\">錯誤題數</div></td></tr>
										<tr><td><div class=\"color-box hl-yellow\"></div></td><td><div class=\"chart-legend-txt\">未作答</div></td></tr>
									</table>
								</div>
								</div>";
							//  Pie Chart
							echo "<script>
									var doughnutData = [
									{
										value: 		".$correctAns.",
										color:		\"#46BFBD\",
										highlight:	\"#5AD3D1\",
										label:		\"正確題數\"
									},
									{
										value:		".$wrongAns.",
										color:		\"#F7464A\",
										highlight:	\"#FF5A5E\",
										label:		\"錯誤題數\"
									},
									{
										value:		".$left.",
										color:		\"#FDB45C\",
										highlight:	\"#FFC870\",
										label:		\"未作答題數\"
									}
									]
									var ctx = document.getElementById(\"chart-area\").getContext(\"2d\");
									var myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
										responsive : true,
										animationEasing: \"easeOutQuart\",
									});
								</script>";
						?>
						<form method="post" action="php/storeExam.php?<?php echo "getSubject=".$getSubject."&chapterPOST=".$chapterPOST."&type=".$type; ?>">
							<input class="transparent-input input-save margin-t-40" type="submit" value="儲存考試結果" />
							<input type="hidden" name="examGrade" value="<?php echo $totalPoint; ?>" />
							<input type="hidden" name="correctAns" value="<?php echo $correctAns; ?>" />
							<input type="hidden" name="wrongAns" value="<?php echo $wrongAns; ?>" />
							<input type="hidden" name="totalQuest" value="<?php echo $totalQuest; ?>" />
							<input type="hidden" name="examTime" value="<?php echo $examTime; ?>" />
							<input type="hidden" name="examOptions" value="<?php echo $ans; ?>" />
						</form>
						<ul class="list-inline text-center">
							<li><a class="transparent-a" href="exam-selection.php">繼續測驗</a></li>
							<li><a class="transparent-a" href="main.php">回到首頁</a></li>
						</ul>
					</div>
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
	</body>
</html>
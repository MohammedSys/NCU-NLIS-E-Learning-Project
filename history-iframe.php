<?php session_start(); ?>
<?php
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
		<link rel="stylesheet" href="assets/css/history-iframe.css">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		<script type="text/javascript" src="assets/js/Chart.js/Chart.js"></script>
		
		<!--Customized JS Code-->
		<script type="text/javascript" src="assets/js/openlink.js"></script>
		<script type="text/javascript" src="assets/js/examSlide.js"></script>
		
	</head>
	<body>
		<div class="table-responsive">
			<form id="examForm">
				<table class="table table-hover">					
					<tr>
						<td align="center">詳細資料</td>
						<td>主題</td>
						<td>類型</td>
						<td>章節</td>
						<td>分數</td>
						<td>作答時間</td>
						<td>作答日期</td>
					</tr>
					<?php
						$name = $_SESSION['account'];		
						//取得考試紀錄
						$examSql = "SELECT testGradeId,subject,type,chapter,score,ansTime,ansDate,ansStatus FROM testGrade WHERE name = '$name'";
						//取得排序方法
						if (!empty($_POST['orderSql'])) {
							$orderSql = $_POST['orderSql'];
							$examSql .= $orderSql;
						}
						$i = 0;
						$examconn = mysql_query($examSql);	
						while ($examArray = mysql_fetch_row($examconn))
						{
							$i++;
							// The data set is like this: 正確題數/錯誤題數/未作答題數/總題數
							$ansStatus = explode("/", $examArray[7]);
							
							$c_percentage = $ansStatus[0] / $ansStatus[3];
							$c_res = $c_percentage * 100;
							$e_percentage = ($ansStatus[1]+$ansStatus[2]) / $ansStatus[3];
							$e_res = $e_percentage * 100;
							
							if($examArray[2] == "chapter")
								$type_view = "章節練習";
							else
								$type_view = "綜合練習";
							
							echo "<tr>";
							// echo "<td><input type=\"checkbox\" onclick=\"checkOne(this)\" name=\"examID\" value=\"".$examArray[0]."\" /></td>";
							echo "<td align=\"center\"><button class=\"btn btn-xs\" type=\"button\" onclick=\"toggle(this)\">分析</button></td>";
							echo "<td>".$examArray[1]."</td>";
							echo "<td>".$type_view."</td>";
							echo "<td>".$examArray[3]."</td>";
							echo "<td>".$examArray[4]."</td>";
							echo "<td>".$examArray[5]."</td>";
							echo "<td>".str_replace("-", ".", $examArray[6])."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td colspan=\"8\" class=\"DIVclose\"><div class=\"exam-slide\">";
							// echo "<p>統計圖表</p>";
							echo "<div class=\"chart-box\">
									<canvas id=\"chart-area".$i."\" class=\"chart-zone\"></canvas>
									<div class=\"chart-legend\">
										<table>
											<tr><td><div class=\"color-box hl-green\"></div></td><td><div class=\"chart-legend-txt\">正確題數</div></td></tr>
											<tr><td><div class=\"color-box hl-red\"></div></td><td><div class=\"chart-legend-txt\">錯誤題數</div></td></tr>
											<tr><td><div class=\"color-box hl-yellow\"></div></td><td><div class=\"chart-legend-txt\">未作答</div></td></tr>
										</table>
									</div>
								  </div>
								  <div class=\"chart-detail\">
								  	<p class=\"chart-detail-title\">關於本次考試</p>
									<p>總題數：".$ansStatus[3]." 題</p>
									<p>分數：".$examArray[4]."</p>
									<p>答題正確率：".$c_res." %</p>
									<p>誤答率：".$e_res." %</p>
									<p><button class=\"btn btn-primary\" type=\"button\" onclick=\"fatherSub(".$examArray[0].")\">查看考卷</button></p>
								  </div>";
							//  Pie Chart
							echo "<script>
									var doughnutData = [
									{
										value: 		".$ansStatus[0].",
										color:		\"#46BFBD\",
										highlight:	\"#5AD3D1\",
										label:		\"正確題數\"
									},
									{
										value:		".$ansStatus[1].",
										color:		\"#F7464A\",
										highlight:	\"#FF5A5E\",
										label:		\"錯誤題數\"
									},
									{
										value:		".$ansStatus[2].",
										color:		\"#FDB45C\",
										highlight:	\"#FFC870\",
										label:		\"未作答題數\"
									}
									]
									var ctx = document.getElementById(\"chart-area".$i."\").getContext(\"2d\");
									var myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
										responsive : true,
										animationEasing: \"easeOutQuart\",
									});
								 </script>";
							echo "</div></td></tr>";
						}
					?>
				</table>
				<!--<div class="well well-sm">
					<input type="hidden" name="userName"  />
					<button class="btn btn-primary" type="button" onclick="fatherSubmit()">查看成績</button>
				</div>-->
			</form>
		</div>
		<script type="text/javascript">
				//讓使用者只能勾選一項，參數select是使用者點擊的checkbox => checkbox使用
				function checkOne(select){
					//先取得同name為account的chekcbox的集合物件
					var checkbox = document.getElementsByName("examID");
					for (i=0; i<checkbox.length; i++){
						//判斷checkbox集合中的i元素是否為被點擊的元素，若否則表示未被點選
						if (checkbox[i] != select) {
							checkbox[i].checked = false;
						}
						//如果是checkbox[i]物件與使用者點擊的checkbox是同一個，則設定i元素的狀態跟使用者點擊的checkbox狀態一樣
						else {
							checkbox[i].checked = select.checked;
						}	
					}
				}
				
				function fatherSub( id )
				{
					var examForm = document.getElementById("examForm"); //本頁checkbox所屬的form
					var submitValue; //儲存本頁被選取的input值
					submitValue = id;
					
					//宣告父視窗中的表單與input物件
					var fatherForm = window.parent.document.getElementById("fatherForm");
					var fatherInput = window.parent.document.getElementById("fatherInput");
					//父視窗的input值以子視窗的input值取代，並且submit父視窗表單
					fatherInput.value = submitValue;
					fatherForm.submit();
				}
				
				function fatherSubmit()
				{
					var examForm = document.getElementById("examForm"); //本頁checkbox所屬的form
					var submitValue; //儲存本頁被選取的input值
					// //如果只有一筆考試紀錄，length不適用，需要用toString()
					// if ( typeof examForm.examID.length === 'undefined') {
					// 	submitValue = examForm.examID.value;
					// }else {
					// 	//瀏覽所有checkbox,將被選取的checkbox value存入submitValue中
					// 	for (var i=0; i<examForm.examID.length; i++) {
					// 		if (examForm.examID[i].checked) {		
					// 			submitValue = examForm.examID[i].value;
					// 			break;
					// 		}	
					// 	}
					// }
					
					//宣告父視窗中的表單與input物件
					var fatherForm = window.parent.document.getElementById("fatherForm");
					var fatherInput = window.parent.document.getElementById("fatherInput");
					//父視窗的input值以子視窗的input值取代，並且submit父視窗表單
					fatherInput.value = submitValue;
					fatherForm.submit();
				}	
		</script>
	</body>
</html>

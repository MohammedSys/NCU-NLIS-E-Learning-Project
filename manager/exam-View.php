<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
?>
<?php

	//如果有接收到新的教材主題按鈕，更新session
	if($_POST['subject'] != null && $_POST['type'] != null && $_POST['chapter'] != null) {
		//將接收到的主題、章節、類型儲存至session	
		$_SESSION['subject'] = $_POST['subject'];
		$_SESSION['type'] = $_POST['type'];
		$_SESSION['chapter'] = $_POST['chapter'];			
	}
	//以session儲存table使用的查詢指令變數
	$subject = $_SESSION['subject'];
	$chapter = $_SESSION['chapter'];
	$type = $_SESSION['type'];
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="NCU ISQ Group 16">
		<meta name="Description" content="The manager interface of New Life Co. E-learning System.">
		<meta name="Creation-Date" content="01-Sep-2015 08:00">		
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<title>E-learning System</title>	
		<!--icon-->
		<link href="../assets/img/newlife_circle.png" rel="SHORTCUT ICON">
		<!--Bootstrap-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-social.css">
		<link rel="stylesheet" href="../assets/css/font-awesome.css">	
		<!--Customized CSS Settings-->
		<link rel="stylesheet" href="assets/css/exam-view.css">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
	</head>

	<body>
		<div>
			<div class="page-header">
				<h2 class="text-primary">考題瀏覽</h2>
				<p>主題：<?php echo $_SESSION['subject']; ?></p>
				<p>類型：<?php echo $_SESSION['type']; ?></p>
				<p>章節：<?php echo $_SESSION['chapter']; ?></p>				
			</div>
			<div class="table-responsive">
				<form id="examForm" method="post" action="">
					<table class="table table-hover">
						<th>
							<td>No.</td>
							<td>敘述</td>
							<td>選項一</td>
							<td>選項二</td>
							<td>選項三</td>
							<td>選項四</td>
							<td>正解</td>
							<td>配分</td>
						</th>
					<?php 
						$sql = "SELECT number, context, A1, A2, A3, A4, answer, point FROM questionBase WHERE subject = '$subject' AND type = '$type' AND chapter = '$chapter' ORDER BY number";
						$result = mysql_query($sql);
						while ($examData = mysql_fetch_row($result)) {
							echo "<tr>";
							echo "<td><input type=\"checkbox\" name=\"number[]\" value=\"".$examData[0]."\" /></td>";
							echo "<td>".$examData[0]."</td>";
							echo "<td>".$examData[1]."</td>";
							echo "<td>".$examData[2]."</td>";
							echo "<td>".$examData[3]."</td>";
							echo "<td>".$examData[4]."</td>";
							echo "<td>".$examData[5]."</td>";
							echo "<td>".$examData[6]."</td>";
							echo "<td>".$examData[7]."</td>";
							echo "</tr>";
						}
					
					?>
					</table>
					
					<div>
						<button class="btn btn-primary" type="button" onclick="changeAction('update')" >修改勾選項目</button>
						<button class="btn btn-danger" type="button" onclick="changeAction('del')" >刪除勾選項目</button>
						<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
						<input type="hidden" name="type" value="<?php echo $type; ?>" />
						<input type="hidden" name="chapter" value="<?php echo $chapter; ?>" />
					</div>
				</form>
				
			</div>
		</div>
		<script type="text/javascript" src="assets/js/exam-View_Button.js"></script>
	</body>
</html>

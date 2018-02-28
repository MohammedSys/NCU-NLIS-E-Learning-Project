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
		<link rel="stylesheet" href="assets/css/material-View.css">
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
	</head>

	<body id="manager-mv">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="text-primary">教材瀏覽</h4>
		    </div>
		    <div class="panel-body">
		    	<form id="materialForm" method="post" action="">
			    	<div class="table-responsive">
			    		<table class="table table-hover table-bordered table-condensed">
			    			<th>
			    				<td>主題</td>
			    				<td>章節</td>
			    				<td>標題</td>
			    				<td>簡介</td>
			    				<td>敘述</td>
			    				<td>講師</td>
			    			</th>
			    			<?php
			    				//如果接收到教材主題按鈕指令，更新session
			    				if ($_POST['subject'] != null) {
									$_SESSION['materialSubject'] = $_POST['subject'];								
								}
								//用session儲存教材sql指令變數
								$subject = $_SESSION['materialSubject'];
								$sql = "SELECT * FROM teachingMaterial WHERE subject = '$subject' ORDER BY CAST(chapter AS UNSIGNED)";
								$result = mysql_query($sql);
								while ( $row = mysql_fetch_row($result) ) {
									echo "<tr>";
									echo "<td><input type=\"checkbox\" name=\"chapter[]\" value=\"".$row[2]."\" /></td>";
									echo "<td>".$row[1]."</td>";
									echo "<td>".$row[2]."</td>";
									echo "<td>".$row[3]."</td>";
									echo "<td>".$row[4]."</td>";
									echo "<td>".$row[5]."</td>";
									echo "<td>".$row[6]."</td>";
									echo "</tr>";
									
								}		    				
			    			?>
			    		</table>			    		
			    	</div>
			    	<div id="submitDiv">
		    			<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
		    			<button class="btn btn-primary" type="button" onclick="changeAction('update')">修改教材資訊</button>
		    			<button class="btn btn-danger" type="button" onclick="changeAction('del')">刪除教材章節</button>
		    		</div>
		    	</form>
		    	<script type="text/javascript" src="assets/js/material-View_Button.js"></script>
		    </div> <!--end of panel body-->
		</div><!--end of panel-->
	</body>
</html>

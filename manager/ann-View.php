<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include("php/connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
?>

<!DOCTYPE html>
<html>
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
		<!-- fixed menu setting -->
		<link href="../assets/css/hippo.css" rel="stylesheet">
		<link href="assets/css/simple-sidebar.css" rel="stylesheet">
		<link href="assets/css/ann-view.css" rel="stylesheet">
		
		<!--JavaScript Library-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	-->
	</head>
<body>
	<div id="wrapper" class="toggled"><!-- Sidebar -->
	<?php include 'manager-menu.php'; ?>
    <?php include 'manager-header.php'; ?>
		<div class="fixed">
			<div class="page-header">
				<h2 class="text-primary">公告瀏覽</h2>
			</div>
					
			<div class="table-responsive">
				<form action="" method="post" id="annForm">
					<table class="table table-hover">
						<th>
							<td>編號</td>
							<td>標題</td>
							<td>類型</td>
							<td>內容</td>
							<td>上傳時間</td>
						</th>
						<?php 
							$sql = "SELECT postID, title, type, context, date_format(DATE,'%x-%c-%d') FROM bulletin";
							$result = mysql_query($sql);
							while ($annData = mysql_fetch_row($result)) {
								echo "<tr>";
								echo "<td><input type=\"checkbox\" name=\"number[]\" value=\"".$annData[0]."\" /></td>";
								echo "<td>".$annData[0]."</td>";
								echo "<td>".$annData[1]."</td>";
								echo "<td>".$annData[2]."</td>";
								echo "<td>".$annData[3]."</td>";
								echo "<td>".$annData[4]."</td>";
								echo "</tr>";
							}
						?>
					</table>
					<div>
						<button class="btn btn-primary" type="button" onclick="changeAction('update')" >修改勾選項目</button>
						<button class="btn btn-danger" type="button" onclick="changeAction('del')" >刪除勾選項目</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /#sidebar-wrapper -->
		
	<!-- Menu Toggle Script -->
	<script type="text/javascript" src="assets/js/menu-trigger.js"></script>
	<script type="text/javascript" src="assets/js/ann-View_Button.js"></script>
</body>
</html>
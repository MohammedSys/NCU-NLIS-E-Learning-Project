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
		
		<link rel="stylesheet" href="assets/css/ann-Upload.css">
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
				<h2 class="text-primary">公告上傳<small> - 請依欄位輸入相關資料</small></h2>
			</div>
			<div>
				<form id="annInfo" class="form-horizontal" action="php/ann-Upload-process.php" method="post">
					<label for="annTitle" class="col-md-2" control-label>公告名稱</label>
					<div class="col-md-10">
						<input id="annTitle" class="form-control" type="text" name="title" required >
					</div>
					<label for="annType" class="col-md-2" control-label>公告類型</label>
					<div class="col-md-10">
						<select id="annType" name="type" form="annInfo" required>
							<option value="一般">一般公告</option>
							<option value="重要">重要公告</option>
						</select>
					</div>
					<label for="annTextArea" class="col-md-2" control-label>公告內容</label>
					<div class="col-md-10">
						<textarea id="annTextArea" class="form-control" name="context" cols="20" rows="10" required></textarea>
					</div>
					<div class="col-md-12">
						<button class="btn btn-primary" type="submit" form="annInfo">發布公告</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /#sidebar-wrapper -->
		
	<!-- Menu Toggle Script -->
    <script type="text/javascript" src="assets/js/menu-trigger.js"></script>
</body>
</html>
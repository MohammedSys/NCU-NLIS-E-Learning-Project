<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>
<!DOCTYPE html>
<html>
<head>
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/ann-Upload.css">
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
	</div> <!-- /#sidebar-wrapper -->
</body>
</html>
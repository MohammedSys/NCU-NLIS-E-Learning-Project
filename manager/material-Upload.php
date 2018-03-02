<?php session_start(); ?>
<?php require 'php/permission.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<!--Customized CSS Settings-->
<link href="assets/css/material-upload.css" rel="stylesheet">
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<!--Customized JacaScript-->
<script type="text/javascript" src="assets/js/manager-submitCheck.js"></script>
</head>
<body>
	<div id="wrapper" class="toggled"><!-- Sidebar -->
		<?php include 'manager-menu.php'; ?>
		<?php include 'manager-header.php'; ?>
		<div class="fixed">
			<div class="page-header">
				<h2 class="text-primary">教材上傳 <small>請依欄位輸入相關資料</small></h2>
			</div>
			<div>
				<form id="materialForm" class="form-horizontal" method="post" enctype="multipart/form-data" action="php/material-Upload-process.php">
					<div class="form-group">
						<label for="subjectInput" class="col-md-2 control-label">教材主題名稱</label>
						<div class="col-md-10">
							<input id="subjectInput" class="form-control" type="text" name="subject" required />
							<span class="help-block">請輸入教材主題。例如：CSS</span>
						</div>
					</div>
					<div class="form-group">
						<label for="chapterInput" class="col-md-2 control-label">教材章節</label>
						<div class="col-md-10">
							<input id="chapterInput" class="form-control" min="0" type="number" name="chapter" required />
							<span class="help-block">請輸入教材章節，請輸入純數字。</span>
						</div>
					</div>
					<div class="form-group">
						<label for="titleInput" class="col-md-2 control-label">教材標題</label>
						<div class="col-md-10">
							<input id="titleInput" class="form-control" type="text" name="title" required />
							<span class="help-block">請輸入教材標題，無須包含章節與主題。</span>
						</div>
					</div>
					<div class="form-group">
						<label for="introInput" class="col-md-2 control-label">教材簡介</label>
						<div class="col-md-10">
							<input id="introInput" class="form-control" type="text" name="intro" required />
							<span class="help-block">請輸入簡短的教材簡介，將用於首頁的教材介紹。</span>
						</div>
					</div>
					<div class="form-group">
						<label for="descriptInput" class="col-md-2 control-label">教材敘述</label>
						<div class="col-md-10">
							<textarea id="descriptInput" class="form-control m-descirption" form="materialForm" name="descript" required ></textarea>
							<span class="help-block">請輸入教材敘述，敘述這個章節大致的學習內容，將用於搜尋頁面。</span>
						</div>
					</div>
					<div class="form-group">
						<label for="teacherInput" class="col-md-2 control-label">教材講師</label>
						<div class="col-md-10">
							<input id="teacherInput" class="form-control" type="text" name="teacher" required />
							<span class="help-block">請輸入講師名稱，用來區別同主題不同講師的教材。</span>
						</div>
					</div>
					<div class="form-group">
						<label for="fileInput" class="col-md-2 control-label">教材檔案</label>
						<div class="col-md-10">
							<input id="fileInput" type="file" name="material_file" required />
							<span class="help-block">請選擇上傳檔案，必須為 .pdf 格式檔案。</span>
						</div>
					</div>
					<div>
						<button class="btn btn-primary" type="button" onclick="material_UploadCheck()">上傳</button>
						<button class="btn btn-danger" type="button" onclick="javascript:location.href='material-Select.php" >取消上傳</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Modal Message -->
		<?php include '../objects/modal.php'; ?>

	</div><!-- /#sidebar-wrapper -->
</body>
</html>

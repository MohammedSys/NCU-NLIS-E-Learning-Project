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
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link href="assets/css/ann-view.css" rel="stylesheet">
</head>
<body>
	<div id="wrapper" class="toggled"><!-- Sidebar -->
        <?php include 'manager-menu.php'; ?>
        <?php include 'manager-header.php'; ?>
		<div class="fixed">
			<div class="page-header">
				<h2 class="text-primary">修改公告 <small>請依欄位輸入相關資料</small></h2>
			</div>
			
			<form id="formEdit" class="form-horizontal" action="php/ann-Update-process.php" method="post">
				<?php    
					$numberArray = $_POST['number'];
					foreach ($numberArray as $number){
						$number = (int)($number);
						$sql = "SELECT title,type,context,postID FROM bulletin WHERE postID='$number'";
						$result = mysql_query($sql);
						$row = mysql_fetch_row($result);
					}			
				?>
				<label for="annTitle" class="col-md-2" control-label >公告名稱：</label>
				<div class="col-md-10">
					<input id="annTitle" class="form-control" name="title" type="text" value="<?php echo $row[0]; ?>" required/>
				</div>
				<label for="annType" class="col-md-2" control-label >公告類型：</label>
				<div class="col-md-10">
					<select  id="annType" class="form-control" name="type" form="formEdit" required >
						<?php 
							if($row[1]=="一般"){
								echo "<option value=\"一般\" selected>一般公告</option>";
								echo "<option value=\"重要\">重要公告</option>";
							}else{
								echo "<option value=\"一般\" >一般公告</option>";
								echo "<option value=\"重要\" selected>重要公告</option>";
							}
						 ?>
					</select>
				</div>
				<label for="annTextArea" class="col-md-2" control-label >公告內容：</label>
				<div class="col-md-10">
					<textarea id="annTextArea" class="form-control" name="context" form="formEdit" cols="30" rows="10" required ><?php echo $row[2]; ?></textarea><br>
				</div>				
				<div>
					<input class="btn btn-default" type="submit" value="送出更新資料" />
					<button class="btn btn-sucess" type="button" onclick="javascript:location.href='ann-View.php'">取消更新</button>
					<input type="hidden" name="postID" value="<?php echo $row[3]; ?>" />
				</div>			
			</form>
		</div>
	</div> <!-- /#sidebar-wrapper -->
</body>
</html>
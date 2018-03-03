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
<!--Customized CSS Settings-->
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link href="assets/css/ann-view.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/view-button.js"></script>
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
						<tr><th></th><th>編號</th><th>標題</th><th>類型</th><th>內容</th><th>上傳時間</th></tr>
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
						<button class="btn btn-primary" type="button" onclick="changeAction( 2, 'annForm', 'number[]', 'update' )" >修改勾選項目</button>
						<button class="btn btn-danger" type="button" onclick="changeAction( 2, 'annForm', 'number[]', 'del' )" >刪除勾選項目</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /#sidebar-wrapper -->

	<!-- Modal Message -->
	<?php include '../objects/modal.php'; ?>

</body>
</html>
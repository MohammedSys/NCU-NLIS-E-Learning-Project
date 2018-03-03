<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<!--Customized CSS Settings-->
<link rel="stylesheet" href="assets/css/material-View.css">
<script type="text/javascript" src="assets/js/view-button.js"></script>
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
						<tr><th></th><th>主題</th><th>章節</th><th>標題</th><th>簡介</th><th>敘述</th><th>講師</th></tr>
						<?php
							// 如果接收到教材主題按鈕指令，更新 session
							if ($_POST['subject'] != null) {
								$_SESSION['materialSubject'] = $_POST['subject'];								
							}
							// 用 session 儲存教材 sql 指令變數
							$subject = $_SESSION['materialSubject'];
							$sql = "SELECT * FROM teachingMaterial WHERE subject = '$subject' ORDER BY CAST(chapter AS UNSIGNED)";
							$result = mysql_query($sql);
							while ( $row = mysql_fetch_row($result) )
							{
								echo "<tr><td><input type=\"checkbox\" name=\"chapter[]\" value=\"".$row[3]."\" /></td>";
								echo "<td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td>";
								echo "<td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[1]."</td></tr>";
							}		    				
						?>
					</table>			    		
				</div>
				<div id="submitDiv">
					<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
					<button class="btn btn-primary" type="button" onclick="changeAction( 0, 'materialForm', 'chapter[]', 'update' );">修改教材資訊</button>
					<button class="btn btn-danger" type="button" onclick="changeAction( 0, 'materialForm', 'chapter[]', 'del' );">刪除教材章節</button>
				</div>
			</form>
		</div> <!--end of panel body-->
	</div> <!--end of panel-->

	<!-- Modal Message -->
	<?php include '../objects/modal.php'; ?>

</body>
</html>

<?php session_start(); ?>
<?php 
	require 'php/permission.php';
	include( "php/connection.php" );
	//設定編碼，避免中文字出現亂碼
	mysql_query( "set names 'utf8'" );

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
<?php include '../objects/head-meta.php'; ?>
<?php include '../objects/head-link-sub.php'; ?>
<!--Customized CSS Settings-->
<link rel="stylesheet" href="assets/css/exam-view.css">
<script type="text/javascript" src="assets/js/view-button.js"></script>
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
					<tr><th></th><th>No</th><th>敘述</th>
						<th>選項一</th><th>選項二</th><th>選項三</th><th>選項四</th>
						<th>正解</th><th>配分</th>
					</tr>
				<?php 
					$sql = "SELECT number, context, A1, A2, A3, A4, answer, point FROM questionBase WHERE subject = '$subject' AND type = '$type' AND chapter = '$chapter' ORDER BY number";
					$result = mysql_query($sql);
					while ($examData = @mysql_fetch_row($result))
					{
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
					<button class="btn btn-primary" type="button" onclick="changeAction( 1, 'examForm', 'number[]', 'update' )" >修改勾選項目</button>
					<button class="btn btn-danger" type="button" onclick="changeAction( 1, 'examForm', 'number[]', 'del' )" >刪除勾選項目</button>
					<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
					<input type="hidden" name="type" value="<?php echo $type; ?>" />
					<input type="hidden" name="chapter" value="<?php echo $chapter; ?>" />
				</div>
			</form>
		</div>
	</div>

	<!-- Modal Message -->
	<?php include '../objects/modal.php'; ?>

</body>
</html>

<?php
	include("connection.php");
	//設定編碼，避免中文字出現亂碼
	mysql_query("set names 'utf8'");
	$examMarkID = $_POST['examNumber'];
	$sql = "DELETE FROM testMark WHERE testMarkID = '$examMarkID'";
	if (mysql_query($sql)) {
		$message = "考題書籤刪除成功!";
		
	}else {
		$error = mysql_error();
		$message = "考題書籤刪除失敗!錯誤訊息:".$error;
	}
	echo '<script type="text/javascript">alert("'.$message.'");</script>';
	echo "<meta http-equiv=REFRESH CONTENT=0;url=../history.php>";
	
?>